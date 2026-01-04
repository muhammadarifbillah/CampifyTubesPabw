<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminBuyerController extends Controller
{
    public function index()
    {
        $buyers = Buyer::latest()->get();

        return response()->json([
            'total' => $buyers->count(),
            'active' => $buyers->where('is_active', 1)->count(),
            'inactive' => $buyers->where('is_active', 0)->count(),
            'data' => $buyers
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:buyers',
            'password' => 'required|min:6'
        ]);

        $data['password'] = Hash::make($data['password']);

        $buyer = Buyer::create($data);

        return response()->json([
            'message' => 'Buyer created',
            'data' => $buyer
        ], 201);
    }

    public function destroy(Buyer $buyer)
    {
        $buyer->delete();

        return response()->json([
            'message' => 'Buyer deleted'
        ]);
    }
}
