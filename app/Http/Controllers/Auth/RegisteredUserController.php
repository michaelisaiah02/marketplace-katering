<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => ['required', 'string'],
            'contact' => ['required', 'string'],
            'role' => ['required', 'in:merchant,customer'],
            'description' => ['nullable', 'string'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'contact' => $request->contact,
            'role' => $request->role,
            'description' => $request->description,
        ]);

        Auth::login($user);

        // Redirect berdasarkan role
        return redirect()->intended(
            $user->role === 'merchant'
                ? route('merchant.dashboard')
                : route('customer.dashboard')
        );
    }
}
