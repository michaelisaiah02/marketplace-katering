<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $customer = Auth::user();
        return view('customer.profile.edit', compact('customer'));
    }

    public function update(Request $request)
    {
        $customer = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        $customer->name = $request->name;
        $customer->email = $request->email;

        if ($request->filled('password')) {
            $customer->password = Hash::make($request->password);
        }

        $customer->save();

        return redirect()->route('customer.profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }
}
