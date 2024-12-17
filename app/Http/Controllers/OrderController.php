<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // User Checkout
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        $totalPrice = 0;

        // Calculate total price and validate stock
        foreach ($cart as $id => $details) {
            $product = Product::findOrFail($id);
            if ($product->stock < $details['quantity']) {
                return redirect()->back()->with('error', "Not enough stock for {$product->name}.");
            }
            $totalPrice += $details['price'] * $details['quantity'];
        }

        // Create Order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        // Create Order Items and Update Stock
        foreach ($cart as $id => $details) {
            $product = Product::findOrFail($id);
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);

            // Reduce product stock
            $product->decrement('stock', $details['quantity']);
        }

        // Clear Cart
        session()->forget('cart');

        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }

    // User's Orders
    public function userOrders()
    {
        $orders = Order::where('user_id', Auth::id())->with('orderItems.product')->get();
        return view('orders.index', compact('orders'));
    }

    // Admin - Manage Orders
    public function manageOrders()
    {
        $orders = Order::with('user', 'orderItems.product')->get();
        return view('admin.orders.index', compact('orders'));
    }

    // Admin - Approve Order
    public function approveOrder(Order $order)
    {
        $order->update(['status' => 'paid']);
        return redirect()->back()->with('success', 'Order approved and marked as paid.');
    }
}
