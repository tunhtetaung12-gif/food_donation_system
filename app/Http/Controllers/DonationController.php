<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{

    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $donations = $user->donations()
            ->with('volunteer')
            ->latest()
            ->paginate(5);

        return view('donor.donations.index', compact('donations'));
    }
    public function create()
    {
        return view('donor.donations.create');
    }

    public function edit(Donation $donation)
    {
        if ($donation->user_id !== Auth::id()) {
            abort(403);
        }

        return view('donor.donations.edit', compact('donation'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'food_name' => 'required|string|max:255',
            'quantity' => 'required|string',
            'expiry_date' => 'required|date|after:now',
            'pickup_location' => 'required|string',
            'place'           => 'required|string',
            'description' => 'nullable|string',
        ]);

        $donation = Donation::create([
            'user_id' => Auth::id(),
            'food_name' => $request->food_name,
            'quantity' => $request->quantity,
            'expiry_date' => $request->expiry_date,
            'pickup_location' => $request->pickup_location,
            'place' => $request->place,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        return redirect()->route('donations.success', $donation->id);
    }

    public function update(Request $request, Donation $donation)
    {
        if ($donation->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'food_name' => 'required|string|max:255',
            'quantity' => 'required|string',
            'expiry_date' => 'required|date',
            'pickup_location' => 'required|string',
            'place'           => 'required|string',
            'description' => 'nullable|string',
        ]);

        $donation->update($validated);

        return redirect()->route('donations.index')->with('success', 'Donation updated successfully!');
    }

    public function success($id)
    {
        $donation = Donation::findOrFail($id);

        if ($donation->user_id !== Auth::id()) {
            abort(403);
        }

        return view('donor.donations.success', compact('donation'));
    }
}
