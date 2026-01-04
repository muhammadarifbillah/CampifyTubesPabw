<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seller;

class AdminSellerController extends Controller
{
    public function show(Request $request)
    {
        return response()->json(
            $request->user()->seller
        );
    }

    public function update(Request $request)
    {
        $seller = $request->user()->seller;

        $seller->update(
            $request->only(['store_name', 'store_description', 'phone', 'address'])
        );

        return response()->json([
            'message' => 'Profile updated',
            'data' => $seller
        ]);
    }
}
