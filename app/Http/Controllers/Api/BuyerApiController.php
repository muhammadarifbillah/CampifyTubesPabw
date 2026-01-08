<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buyer;

class BuyerApiController extends Controller
{
    public function index()
    {
        $buyers = Buyer::orderBy('created_at', 'desc')->get();
        return response()->json(['data' => $buyers], 200);
    }

    public function show(Buyer $buyer)
    {
        return response()->json(['data' => $buyer], 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:buyers,email',
            'password' => 'required|string|min:8',
            'role' => 'nullable|string|in:buyer',
        ]);

        $data['password'] = bcrypt($data['password']);
        $data['role'] = $data['role'] ?? 'buyer';

        $buyer = Buyer::create($data);

        return response()->json(['data' => $buyer], 201);
    }

    public function update(Request $request, Buyer $buyer)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:buyers,email,' . $buyer->id,
            'password' => 'nullable|string|min:8',
            'role' => 'nullable|string|in:buyer',
        ]);

        if ($request->filled('password')) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $buyer->update($data);

        return response()->json(['data' => $buyer], 200);
    }

    public function destroy(Buyer $buyer)
    {
        $buyer->delete();
        return response()->json(null, 204);
    }
}
