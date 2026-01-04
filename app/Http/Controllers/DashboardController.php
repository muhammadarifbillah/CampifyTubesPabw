<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buyer;
use App\Models\Seller;

class DashboardController extends Controller
{
    public function admin()
    {
        $totals = [
            'buyers' => Buyer::count(),
            'sellers' => Seller::count(),
            'transactions' => 5678, // demo placeholder
            'revenue_label' => 'Rp 45.2M'
        ];

        $recentBuyers = Buyer::orderBy('created_at', 'desc')->limit(4)->get();
        $recentSellers = Seller::orderBy('created_at', 'desc')->limit(4)->get();

        return view('admin.dashboard', compact('totals', 'recentBuyers', 'recentSellers'));
    }

    public function seller()
    {
        $seller = Seller::first();
        // For demo: static stats
        $stats = [
            'rating' => 4.8,
            'total_sales' => 1234,
            'total_products' => 87,
            'total_reviews' => 456,
        ];
        return view('seller.dashboard', compact('seller', 'stats'));
    }
}
