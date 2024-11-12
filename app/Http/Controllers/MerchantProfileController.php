<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merchant;
use Illuminate\Support\Facades\Auth;

class MerchantProfileController extends Controller
{
    public function edit()
    {
        $merchant = Auth::guard('merchant')->user();
        return view('merchant.profile.edit', compact('merchant'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'address' => 'required|string',
            'contact' => 'required|string|max:20',
            'description' => 'nullable|string',
        ]);

        $merchant = Auth::guard('merchant')->user();
        $merchant->update($request->only('company_name', 'address', 'contact', 'description'));

        return redirect()->route('merchant.profile.edit')->with('success', 'Profile updated successfully.');
    }
}
