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

    public function showProfile(Request $request)
    {
        $user = $request->user();
        $seller = $user ? Seller::where('email', $user->email)->first() : null;

        if (!$seller) {
            $seller = Seller::first();
        }

        if (!$seller) {
            return response()->json(['message' => 'Seller profile not found'], 404);
        }

        return response()->json(['data' => $seller], 200);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();
        $seller = $user ? Seller::where('email', $user->email)->first() : null;

        if (!$seller) {
            $seller = Seller::first();
        }

        if (!$seller) {
            return response()->json(['message' => 'Seller profile not found'], 404);
        }

        $data = $request->validate([
            'store_name' => 'required|string',
            'store_description' => 'nullable|string',
            'owner_name' => 'nullable|string',
            'email' => 'nullable|email',
            'logo' => 'nullable|image|max:2048',
            'banner' => 'nullable|image|max:4096',
            'photos.*' => 'nullable|image|max:2048',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'province' => 'nullable|string',
            'postal_code' => 'nullable|string',
            'open_time' => 'nullable|string',
            'close_time' => 'nullable|string',
            'operational_days' => 'nullable|string',
            'shipping_estimate' => 'nullable|string',
            'slogan' => 'nullable|string',
            'theme_color' => 'nullable|string',
            'instagram' => 'nullable|string',
            'facebook' => 'nullable|string',
            'tiktok' => 'nullable|string',
            'website' => 'nullable|url',
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('sellers', 'public');
        }

        if ($request->hasFile('banner')) {
            $data['banner'] = $request->file('banner')->store('sellers', 'public');
        }

        if ($request->hasFile('photos')) {
            $existing = $seller->photos ?? [];
            $files = $request->file('photos');
            foreach ($files as $file) {
                if (count($existing) >= 5) {
                    break;
                }
                $existing[] = $file->store('sellers', 'public');
            }
            $data['photos'] = $existing;
        }

        $seller->fill($data);
        $seller->save();

        return response()->json(['data' => $seller], 200);
    }
}
