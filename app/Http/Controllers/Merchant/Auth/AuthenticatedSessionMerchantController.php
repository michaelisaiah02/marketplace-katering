<?php

namespace App\Http\Controllers\Merchant\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionMerchantController extends Controller
{
    public function create()
    {
        return view('merchant.auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('merchant')->attempt($request->only('email', 'password'))) {
            return redirect()->intended('/merchant/dashboard')->with('success', 'Login berhasil.');
        }

        return back()->withErrors([
            'email' => 'Email tidak cocok.',
        ]);
    }

    public function destroy(Request $request)
    {
        Auth::guard('merchant')->logout();
        return redirect()->route('merchant.login');
    }
}
