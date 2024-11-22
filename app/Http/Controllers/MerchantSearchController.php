<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MerchantSearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $merchants = User::where('role', 'merchant')
            ->when($query, function ($q) use ($query) {
                return $q->where('name', 'like', '%' . $query . '%');
            })
            ->paginate(10);

        return view('customer.merchants.search', compact('merchants', 'query'));
    }

    public function show($id)
    {
        $merchant = User::where('role', 'merchant')->findOrFail($id);
        $menus = $merchant->menus()->get();

        return view('customer.merchants.show', compact('merchant', 'menus'));
    }
}
