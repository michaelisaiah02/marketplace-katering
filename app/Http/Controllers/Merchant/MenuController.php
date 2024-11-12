<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MenuController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $menus = Menu::where('merchant_id', Auth::id())->get(); // Hanya menu milik merchant yang login
        return view('merchant.menu.index', compact('menus'));
    }

    public function create()
    {
        return view('merchant.menu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'price' => 'required|numeric|min:0',
        ]);

        // Upload foto
        $photoPath = $request->file('photo')->store('menu_photos', 'public');

        Menu::create([
            'merchant_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'photo' => $photoPath,
            'price' => $request->price,
        ]);

        return redirect()->route('merchant.menus.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function edit(Menu $menu)
    {
        $this->authorize('update', $menu);
        return view('merchant.menu.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $this->authorize('update', $menu);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'price' => 'required|numeric|min:0',
        ]);

        if ($request->hasFile('photo')) {
            // Upload foto baru
            $photoPath = $request->file('photo')->store('menu_photos', 'public');
            $menu->photo = $photoPath;
        }

        $menu->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('merchant.menus.index')->with('success', 'Menu berhasil diperbarui!');
    }

    public function destroy(Menu $menu)
    {
        $this->authorize('delete', $menu);
        $menu->delete();

        return redirect()->route('merchant.menus.index')->with('success', 'Menu berhasil dihapus!');
    }
}
