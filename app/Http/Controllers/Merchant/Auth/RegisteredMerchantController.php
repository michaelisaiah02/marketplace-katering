<?php

namespace App\Http\Controllers\Merchant\Auth;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisteredMerchantController extends Controller
{
    public function create()
    {
        return view('merchant.auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:merchants',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Merchant::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('merchant.login')->with('status', 'Registrasi berhasil. Silahkan login.');
    }
}
