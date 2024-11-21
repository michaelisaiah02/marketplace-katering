<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    // Menampilkan daftar menu
    public function index()
    {
        $menus = Menu::where('user_id', Auth::id())->get(); // Mengambil menu milik merchant saat ini
        return view('merchant.menus.index', compact('menus'));
    }

    // Menampilkan form untuk menambah menu baru
    public function create()
    {
        return view('merchant.menus.create');
    }

    // Menyimpan menu baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $menu = new Menu();
        $menu->user_id = Auth::id();
        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->price = $request->price;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('menus', 'public');
            $menu->image_path = $photoPath;
        }

        $menu->save();

        return redirect()->route('merchant.menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit menu
    public function edit(Menu $menu)
    {
        $this->authorizeMenu($menu);

        return view('merchant.menus.edit', compact('menu'));
    }

    // Memperbarui data menu di database
    public function update(Request $request, Menu $menu)
    {
        $this->authorizeMenu($menu);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->price = $request->price;

        if ($request->hasFile('photo')) {
            // Cek apakah ada foto sebelumnya jika ada maka hapus foto sebelumnya
            if ($menu->image_path) {
                Storage::disk('public')->delete($menu->image_path);
            }
            $photoPath = $request->file('photo')->store('menus', 'public');
            $menu->image_path = $photoPath;
        }

        $menu->save();

        return redirect()->route('merchant.menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    // Menghapus menu dari database
    public function destroy(Menu $menu)
    {
        $this->authorizeMenu($menu);

        if ($menu->image_path) {
            Storage::disk('public')->delete($menu->image_path);
        }

        $menu->delete();

        return redirect()->route('merchant.menus.index')->with('success', 'Menu berhasil dihapus.');
    }

    // Mengecek apakah menu milik merchant saat ini
    private function authorizeMenu(Menu $menu)
    {
        if ($menu->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk menu ini.');
        }
    }
}
