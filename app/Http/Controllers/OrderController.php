<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

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
        return redirect()->back()->with('success', 'Order approved.');
    }

    public function updateStatus(Request $request, $orderId, $status)
    {
        $order = Order::findOrFail($orderId);

        // Valid statuses as per the database schema
        $validStatuses = ['shipped', 'completed'];

        if (!in_array($status, $validStatuses)) {
            return redirect()->back()->with('error', 'Invalid status');
        }

        $order->status = $status;
        $order->save();

        return redirect()->back()->with('success', "Order status updated to {$status}");
    }

    public function salesReport(Request $request)
    {
        // Get the time period selected by the user (default to last 30 days)
        $startDate = $request->start_date ?? Carbon::now()->subDays(30);
        $endDate = $request->end_date ?? Carbon::now();

        // Query for total sales (sum of order totals)
        $totalSales = Order::whereBetween('created_at', [$startDate, $endDate])
                            ->sum('total_price');

        // Query for sales by product
        $salesByProduct = OrderItem::with('product')
            ->whereHas('order', function($query) use ($startDate, $endDate) {
                $query->whereBetween('orders.created_at', [$startDate, $endDate]);
            })
            ->selectRaw('product_id, sum(quantity) as total_quantity, sum(quantity * price) as total_revenue')
            ->groupBy('product_id')
            ->get();

        // Sales by category (based on products)
        $salesByCategory = Product::with('category')
            ->whereHas('orderItems', function($query) use ($startDate, $endDate) {
                $query->whereHas('order', function($q) use ($startDate, $endDate) {
                    $q->whereBetween('orders.created_at', [$startDate, $endDate]);
                });
            })
            ->selectRaw('category_id, sum(order_items.quantity * order_items.price) as total_revenue')
            ->groupBy('category_id')
            ->get();

        return view('sales.report', compact('totalSales', 'salesByProduct', 'salesByCategory', 'startDate', 'endDate'));
    }
}
