<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SellerProfileController extends Controller
{
    public function dashboard()
    {
        // show summary statistics (read-only)
        // For demo we fetch seller profile if authenticated
        $seller = Seller::where('email', Auth::user()->email ?? '')->first() ?? Seller::first();
        return view('seller.dashboard', compact('seller'));
    }

    public function profile()
    {
        $seller = Seller::where('email', Auth::user()->email ?? '')->first() ?? Seller::first();
        return view('seller.profile', compact('seller'));
    }

    public function update(Request $request)
    {
        $seller = Seller::where('email', Auth::user()->email ?? '')->first() ?? Seller::first();
        if (!$seller) {
            return redirect()->back()->with('error', 'Seller profile not found');
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

        // handle file uploads
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('sellers', 'public');
            $data['logo'] = $path;
        }

        if ($request->hasFile('banner')) {
            $path = $request->file('banner')->store('sellers', 'public');
            $data['banner'] = $path;
        }

        if ($request->hasFile('photos')) {
            $existing = $seller->photos ?? [];
            $files = $request->file('photos');
            foreach ($files as $file) {
                if (count($existing) >= 5)
                    break;
                $existing[] = $file->store('sellers', 'public');
            }
            $data['photos'] = $existing;
        }

        $seller->fill($data);
        $seller->save();

        return redirect()->route('seller.profile')->with('success', 'Profile updated');
    }
}
