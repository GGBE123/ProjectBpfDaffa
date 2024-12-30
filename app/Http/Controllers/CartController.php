<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\order;
use App\Models\orderitem;
use App\Models\user;

class CartController extends Controller
{
    // Display cart items
    public function index()
    {
        $cart = session()->get('cart', []); // Fetch cart items from session
        $total = array_sum(array_column($cart, 'subtotal'));
        return view('cart.index', compact('cart', 'total'));
    }

    // Add a product to the cart
    public function add(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'subtotal' => $product->price,
            ];
        }

        $cart[$product->id]['subtotal'] = $cart[$product->id]['quantity'] * $product->price;

        session()->put('cart', $cart); // Update session
        return redirect()->back()->with('success', 'Product added to cart!');
    }

    // Update cart item quantity
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            $cart[$id]['subtotal'] = $cart[$id]['quantity'] * $cart[$id]['price'];
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated!');
    }

    // Remove item from the cart
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index')->with('success', 'Product removed!');
    }

    // Checkout logic
    // Checkout logic
    public function checkout()
    {
        // Retrieve cart from session
        $cart = session()->get('cart', []);

        // If cart is empty, redirect back with an error
        if (empty($cart)) {
            return redirect()->route('store.index')->with('error', 'Your cart is empty.');
        }

        // Calculate the total price
        $totalPrice = array_sum(array_column($cart, 'subtotal'));

        // Create the order
        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        // Create the order items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Clear the cart
        session()->forget('cart');

        // Pass checkout data to the session for use in the bank transfer view
        session()->put('checkoutData', [
            'order_id' => $order->id,
            'items' => $cart,
            'total' => $totalPrice,
        ]);

        // Redirect to the bank transfer page
        return redirect()->route('cart.bank_transfer');
    }

    public function bankTransfer()
    {
        $checkoutData = session('checkoutData');

        if (!$checkoutData) {
            return redirect()->route('store.index')->with('error', 'No order data found.');
        }

        return view('Cart.bank_transfer', compact('checkoutData'));
    }
}
