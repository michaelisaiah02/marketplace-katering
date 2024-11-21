<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        // Pastikan hanya customer yang bisa mengakses
        if (Auth::user()->role !== 'customer') {
            abort(403, 'Unauthorized action.');
        }

        return view('customer.dashboard');
    }
}
