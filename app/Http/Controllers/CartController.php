<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = auth()->user()->carts()->with('menu')->get();
        return view('customer.cart.index', compact('carts'));
    }

    public function store(Request $request, $menuId)
    {
        $menu = Menu::findOrFail($menuId);

        $cart = auth()->user()->carts()->where('menu_id', $menu->id)->first();

        if ($cart) {
            if ($request->has('operator') && $request->operator == '+') {
                $cart->increment('quantity');
            } elseif ($request->has('operator') && $request->operator == '-') {
                $cart->decrement('quantity');
                if ($cart->quantity == 0) {
                    $cart->delete();
                    return redirect()->route('customer.cart.index')->with('success', 'Menu berhasil dihapus dari keranjang.');
                }
            } else {
                $cart->increment('quantity');
            }
        } else {
            auth()->user()->carts()->create([
                'menu_id' => $menu->id,
                'quantity' => $request->quantity ?? 1,
            ]);
        }

        $message = 'Menu berhasil ' . ($request->has('operator') && $request->operator == '-' ? 'dikurangi' : 'ditambahkan') . '.';
        return redirect()->route('customer.cart.index')->with('success', $message);
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->update(['quantity' => $request->quantity]);

        return redirect()->route('customer.cart.index')->with('success', 'Jumlah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->route('customer.cart.index')->with('success', 'Menu berhasil dihapus dari keranjang.');
    }
}
