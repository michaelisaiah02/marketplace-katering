<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class MerchantController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Statistik pesanan
        $newOrders = $user->orders()->where('status', 'new')->count();
        $completedOrders = $user->orders()->where('status', 'completed')->count();

        // Total pendapatan
        $totalRevenue = $user->orders()->where('status', 'completed')->sum('total_price');

        return view('merchant.dashboard', [
            'newOrders' => $newOrders,
            'completedOrders' => $completedOrders,
            'totalRevenue' => $totalRevenue,
        ]);
    }
}
