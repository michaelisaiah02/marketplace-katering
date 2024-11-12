<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionCustomerController extends Controller
{
    public function create()
    {
        return view('customer.auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::guard('customer')->attempt($request->only('email', 'password'))) {
            return redirect()->intended('/customer/dashboard')->with('success', 'Login berhasil.');
        }
        // dd($request->all());

        $request->session()->regenerate();

        return back()->withErrors([
            'email' => 'Email tidak cocok.',
        ]);
    }

    public function destroy(Request $request)
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('customer.login'); // Redirect ke login page
    }
}
