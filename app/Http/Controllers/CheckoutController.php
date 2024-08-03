<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderNotification;

class CheckoutController extends Controller
{
    public function showCheckoutForm()
    {
        return view('users.products.checkout');
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        $cart = session('cart');
        $user = Auth::user();

        $order = Order::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'products' => json_encode($cart),
            'order_status' => 'waiting',
        ]);

        // Notify admin
        $admin = User::where('role', 'admin')->first();
        $admin->notify(new OrderNotification($order, 'A new order has been placed.'));

        // Clear the cart
        session()->forget('cart');

        return redirect('/')->with('success', 'Order placed successfully!');
    }
}
