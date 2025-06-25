<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
  public function index()
  {
    $orders = Order::with(['user', 'products'])->latest()->get();

    return view('admin.orders.index', compact('orders'));
  }

  public function updateStatus(Request $request, Order $order)
  {
    $request->validate([
      'status' => 'required|in:pending,reject,approved,completed',
    ]);

    $order->status = $request->status;
    $order->save();

    return redirect()->back()->with('success', 'Status pesanan diperbarui.');
  }
  public function cancel(Order $order)
  {
    if ($order->status !== 'pending') {
      return back()->with('error', 'Pesanan tidak bisa dibatalkan.');
    }

    $order->status = 'cancelled';
    $order->save();

    return back()->with('success', 'Pesanan berhasil dibatalkan.');
  }
}
