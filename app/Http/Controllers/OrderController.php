<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OrderController extends Controller
{
    use AuthorizesRequests;
    // Membuat pesanan dari keranjang
    public function store(Request $request)
    {
        // Validasi tanggal pengiriman
        $request->validate([
            'delivery_date' => 'required|date|after:today',
        ]);

        $deliveryDate = $request->delivery_date;

        $user = auth()->user();

        // Ambil semua item di keranjang
        $carts = $user->carts()->with('menu')->get();

        if ($carts->isEmpty()) {
            return redirect()->route('customer.cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        DB::transaction(function () use ($carts, $user, $deliveryDate) {
            // Kelompokkan item berdasarkan merchant
            $groupedCarts = $carts->groupBy(function ($cart) {
                return $cart->menu->user_id; // Merchant ID
            });

            foreach ($groupedCarts as $merchantId => $cartItems) {
                $totalPrice = $cartItems->sum(function ($cart) {
                    return $cart->menu->price * $cart->quantity;
                });

                // Buat pesanan baru
                $order = Order::create([
                    'customer_id' => $user->id,
                    'merchant_id' => $merchantId,
                    'status' => 'pending',
                    'total_price' => $totalPrice,
                    'delivery_date' => $deliveryDate,
                ]);

                // Tambahkan detail pesanan
                foreach ($cartItems as $cart) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'menu_id' => $cart->menu_id,
                        'quantity' => $cart->quantity,
                        'price' => $cart->menu->price,
                    ]);
                }

                // Hapus item dari keranjang
                $cartItems->each->delete();
            }
        });

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat.');
    }

    // Menampilkan daftar pesanan customer
    public function index()
    {
        $user = auth()->user();

        if ($user->isMerchant()) {
            $orders = Order::where('merchant_id', $user->id)->with('customer')->get();
        } else { // Customer
            $orders = Order::where('customer_id', $user->id)->with('merchant')->get();
        }

        return view('orders.index', compact('orders'));
    }


    // Menampilkan detail pesanan
    public function show($id)
    {
        $order = Order::with(['merchant', 'items.menu'])->where('customer_id', Auth::id())->findOrFail($id);
        return view('customer.orders.show', compact('order'));
    }

    // Menampilkan daftar pesanan untuk merchant
    public function merchantOrders()
    {
        $user = auth()->user();
        $orders = $user->orders()->with(['customer', 'items.menu'])->orderBy('created_at', 'desc')->get();
        return view('merchant.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        // $this->authorize('update', $order); // Pastikan merchant hanya bisa mengubah status pesanannya.

        $currentStatus = $order->status;
        $newStatus = $request->input('status');

        // Validasi alur status
        $validTransitions = [
            'pending' => ['confirmed', 'cancelled'],
            'confirmed' => ['in_progress'],
            'in_progress' => ['completed'],
            'completed' => [], // Tidak bisa diubah
            'cancelled' => [], // Tidak bisa diubah
        ];

        if (!in_array($newStatus, $validTransitions[$currentStatus])) {
            return back()->with('error', 'Perubahan status tidak valid.');
        }

        $order->status = $newStatus;
        $order->save();

        return back()->with('success', 'Status berhasil diperbarui.');
    }



    public function showInvoice(Order $order)
    {
        return view('orders.invoice', compact('order'));
    }
}
