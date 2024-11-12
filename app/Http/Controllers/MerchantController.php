<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    public function show(Merchant $merchant)
    {
        return view('customer.merchants.show', compact('merchant'));
    }
}
