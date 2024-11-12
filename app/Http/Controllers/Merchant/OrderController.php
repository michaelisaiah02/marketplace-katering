<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $merchantId = auth()->user()->id;
        $orders = Order::with(['customer', 'menu'])
            ->whereHas('menu', function ($query) use ($merchantId) {
                $query->where('merchant_id', $merchantId);
            })
            ->orderBy('delivery_date', 'asc')
            ->get();

        return view('merchant.orders.index', compact('orders'));
    }

    public function showInvoice($id)
    {
        $order = Order::with(['customer', 'menu'])->findOrFail($id);

        // Pastikan hanya merchant terkait yang dapat melihat invoice ini
        if ($order->menu->merchant_id !== auth()->user()->id) {
            abort(403);
        }

        return view('merchant.orders.invoice', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui');
    }
}
