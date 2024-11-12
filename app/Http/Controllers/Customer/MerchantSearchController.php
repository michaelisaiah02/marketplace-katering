<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use Illuminate\Http\Request;

class MerchantSearchController extends Controller
{
    public function index(Request $request)
    {
        $query = Merchant::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('address')) {
            $query->where('address', 'like', '%' . $request->address . '%');
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        if ($request->filled('food_type')) {
            $query->where('food_type', 'like', '%' . $request->food_type . '%');
        }

        $merchants = $query->paginate(10); // Hasil pencarian dengan paginasi

        return view('customer.merchants.search', compact('merchants'));
    }
}
