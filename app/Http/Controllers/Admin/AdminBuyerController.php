<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AdminBuyerController extends Controller
{
    public function index()
    {
        $buyers = Buyer::latest()->get();
        $buyers->each(function (Buyer $buyer) {
            $attributes = $buyer->getAttributes();
            if (array_key_exists('is_active', $attributes)) {
                $buyer->is_active = (bool) $buyer->is_active;
                return;
            }
            if (array_key_exists('status', $attributes)) {
                $buyer->is_active = ($buyer->status ?? 'active') === 'active';
                return;
            }
            $buyer->is_active = true;
        });

        $total = $buyers->count();
        $active = $buyers->where('is_active', true)->count();
        $totals = [
            'buyers' => $total,
            'active_buyers' => $active,
            'inactive_buyers' => $total - $active,
        ];

        return view('admin.buyers.index', compact('buyers', 'totals'));
    }

    public function create()
    {
        return view('admin.buyers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:buyers,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:buyer,seller,admin',
            'status' => 'nullable|in:active,inactive',
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
        ];
        $data['password'] = Hash::make($validated['password']);

        if (Schema::hasColumn('buyers', 'status') && array_key_exists('status', $validated)) {
            $data['status'] = $validated['status'];
        }

        if (Schema::hasColumn('buyers', 'is_active') && array_key_exists('status', $validated)) {
            $data['is_active'] = $validated['status'] === 'active';
        }

        Buyer::create($data);

        return redirect()
            ->route('admin.buyers.index')
            ->with('success', 'Buyer created');
    }

    public function show(Buyer $buyer)
    {
        return redirect()->route('admin.buyers.edit', $buyer);
    }

    public function edit(Buyer $buyer)
    {
        return view('admin.buyers.edit', compact('buyer'));
    }

    public function update(Request $request, Buyer $buyer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:buyers,email,' . $buyer->id,
            'password' => 'nullable|string|min:6',
            'role' => 'required|in:buyer,seller,admin',
            'status' => 'nullable|in:active,inactive',
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        if (Schema::hasColumn('buyers', 'status') && array_key_exists('status', $validated)) {
            $data['status'] = $validated['status'];
        }

        if (Schema::hasColumn('buyers', 'is_active') && array_key_exists('status', $validated)) {
            $data['is_active'] = $validated['status'] === 'active';
        }

        $buyer->update($data);

        return redirect()
            ->route('admin.buyers.index')
            ->with('success', 'Buyer updated');
    }

    public function destroy(Buyer $buyer)
    {
        $buyer->delete();

        return redirect()
            ->route('admin.buyers.index')
            ->with('success', 'Buyer deleted');
    }
}
