<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    public function create()
    {
        return view('donor.donations.create');
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

    /**
     * Display the success page after a donation is posted.
     */
    public function success($id)
    {
        $donation = Donation::findOrFail($id);

        if ($donation->user_id !== Auth::id()) {
            abort(403);
        }

        return view('donor.donations.success', compact('donation'));
    }

    public function updateVoluntter(Request $request, $id)
    {
        $donation = Donation::where('id', $id)->first();

        $donation->update([
            'user_id' => $donation->user_id,
            'food_name' => $donation->food_name,
            'quantity' => $donation->quantity,
            'expiry_date' => $donation->expiry_date,
            'pickup_location' => $donation->pickup_location,
            'place' => $donation->place,
            'description' => $donation->description,
            'status' => $donation->status,
            'volunteer_id' => $request->volunteer_id,
        ]);
    }
}
