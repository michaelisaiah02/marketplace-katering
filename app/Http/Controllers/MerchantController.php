<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class MerchantController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Statistik pesanan
        $newOrdersCount = $user->orders()->where('status', 'new')->count();
        $completedOrdersCount = $user->orders()->where('status', 'completed')->count();

        // Total pendapatan
        $totalRevenue = $user->orders()->where('status', 'completed')->sum('total_price');

        return view('merchant.dashboard', [
            'newOrdersCount' => $newOrdersCount,
            'completedOrdersCount' => $completedOrdersCount,
            'totalRevenue' => $totalRevenue,
        ]);
    }
}
