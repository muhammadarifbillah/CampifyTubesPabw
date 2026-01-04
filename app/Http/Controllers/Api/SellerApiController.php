<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seller;

class SellerApiController extends Controller
{
    public function index()
    {
        $sellers = Seller::orderBy('created_at', 'desc')->get();
        return response()->json(['data' => $sellers], 200);
    }

    public function show(Seller $seller)
    {
        return response()->json(['data' => $seller], 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|unique:sellers,user_id',
            'store_name' => 'required|string',
            'owner_name' => 'required|string',
            'email' => 'required|email|unique:sellers,email',
            'status' => 'nullable|in:pending,verified,rejected'
        ]);

        $seller = Seller::create($data + [
            'store_description' => $request->input('store_description'),
        ]);

        return response()->json(['data' => $seller], 201);
    }

    public function update(Request $request, Seller $seller)
    {
        $data = $request->validate([
            'user_id' => 'required',
            'store_name' => 'required|string',
            'owner_name' => 'required|string',
            'email' => 'required|email',
            'status' => 'nullable|in:pending,verified,rejected'
        ]);

        $seller->update($data + ['store_description' => $request->input('store_description')]);

        return response()->json(['data' => $seller], 200);
    }

    public function destroy(Seller $seller)
    {
        $seller->delete();
        return response()->json(null, 204);
    }

    public function activate(Seller $seller)
    {
        $seller->update(['status' => 'verified']);
        return response()->json(['data' => $seller], 200);
    }
}
