<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        // Ambil query dari request, jika kosong berarti tampilkan semua
        $query = $request->input('search');

        // Query menus, jika ada search tampilkan hasil, jika tidak tampilkan semua
        $menus = Menu::with('merchant')
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('name', 'LIKE', '%' . $query . '%');
            })
            ->get();

        // Return ke view dashboard
        return view('customer.dashboard', [
            'menus' => $menus,
            'query' => $query, // Untuk mengisi kembali input search
        ]);
    }
}
