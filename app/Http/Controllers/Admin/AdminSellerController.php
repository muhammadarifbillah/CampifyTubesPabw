<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seller;

class AdminSellerController extends Controller
{
    public function index()
    {
        $sellers = Seller::latest()->get();
        $totals = [
            'sellers' => $sellers->count(),
            'verified_sellers' => $sellers->where('status', 'verified')->count(),
            'pending_sellers' => $sellers->filter(function (Seller $seller) {
                return ($seller->status ?? 'pending') === 'pending';
            })->count(),
        ];

        return view('admin.sellers.index', compact('sellers', 'totals'));
    }

    public function create()
    {
        return view('admin.sellers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|string|max:255|unique:sellers,user_id',
            'store_name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'email' => 'required|email|unique:sellers,email',
            'store_description' => 'required|string',
            'status' => 'nullable|in:pending,verified,rejected',
        ]);

        $data = $validated;
        $data['status'] = $validated['status'] ?? 'pending';

        Seller::create($data);

        return redirect()
            ->route('admin.sellers.index')
            ->with('success', 'Seller created');
    }

    public function show(Seller $seller)
    {
        return redirect()->route('admin.sellers.edit', $seller);
    }

    public function edit(Seller $seller)
    {
        return view('admin.sellers.edit', compact('seller'));
    }

    public function update(Request $request, Seller $seller)
    {
        $validated = $request->validate([
            'user_id' => 'required|string|max:255|unique:sellers,user_id,' . $seller->id,
            'store_name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'email' => 'required|email|unique:sellers,email,' . $seller->id,
            'store_description' => 'nullable|string',
            'status' => 'nullable|in:pending,verified,rejected',
        ]);

        $data = $validated;
        if (!array_key_exists('status', $data) || $data['status'] === null) {
            $data['status'] = $seller->status ?? 'pending';
        }

        $seller->update($data);

        return redirect()
            ->route('admin.sellers.index')
            ->with('success', 'Seller updated');
    }

    public function destroy(Seller $seller)
    {
        $seller->delete();

        return redirect()
            ->route('admin.sellers.index')
            ->with('success', 'Seller deleted');
    }

    public function activate(Seller $seller)
    {
        $seller->update(['status' => 'verified']);

        return redirect()
            ->route('admin.sellers.index')
            ->with('success', 'Seller activated');
    }
}
