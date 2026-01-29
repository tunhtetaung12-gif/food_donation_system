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
            'description' => 'nullable|string',
        ]);

        // Capture the created donation in a variable
        $donation = Donation::create([
            'user_id' => Auth::id(),
            'food_name' => $request->food_name,
            'quantity' => $request->quantity,
            'expiry_date' => $request->expiry_date,
            'pickup_location' => $request->pickup_location,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        // Redirect to the success page instead of the dashboard
        return redirect()->route('donations.success', $donation->id);
    }

    /**
     * Display the success page after a donation is posted.
     */
    public function success($id)
    {
        $donation = Donation::findOrFail($id);

        // Security check: Ensure the user can only see their own success page
        if ($donation->user_id !== Auth::id()) {
            abort(403);
        }

        return view('donor.donations.success', compact('donation'));
    }
}
