<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderNotification;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'order_status' => 'required|in:accepted,waiting,rejected',
        ]);

        $order->update(['order_status' => $request->order_status]);

        // Notify the user
        $user = $order->user;
        $user->notify(new OrderNotification($order, 'Your order status has been updated to: ' . $request->order_status));

        return redirect()->route('admin.orders')->with('success', 'Order status updated successfully.');
    }
}
