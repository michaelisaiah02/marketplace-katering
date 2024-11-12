<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('customer_id', Auth::id())->with('menu')->get();
        return view('customer.orders.index', compact('orders'));
    }

    public function create(Menu $menu)
    {
        return view('customer.orders.create', compact('menu'));
    }

    public function store(Request $request, Menu $menu)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'delivery_date' => 'required|date|after:today',
        ]);

        $totalPrice = $menu->price * $request->quantity;

        Order::create([
            'customer_id' => Auth::id(),
            'menu_id' => $menu->id,
            'quantity' => $request->quantity,
            'delivery_date' => $request->delivery_date,
            'total_price' => $totalPrice,
        ]);

        return redirect()->route('customer.orders.index')->with('success', 'Pesanan berhasil dibuat!');
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui');
    }
}
