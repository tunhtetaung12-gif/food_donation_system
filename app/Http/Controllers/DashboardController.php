<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $assignedDonations = Donation::where('volunteer_id', $user->id)
            ->where('status', '!=', 'completed')
            ->with('user')
            ->latest()
            ->get();

        $myDonations = Donation::where('user_id', $user->id)
            ->latest()
            ->get();

        return view('dashboard', compact('assignedDonations', 'myDonations'));
    }

    // public function complete($id)
    // {
    //     $donation = Donation::findOrFail($id);
    //     $currentUserId = Auth::id();

    //     if ($donation->volunteer_id == $currentUserId) {
    //         $donation->update([
    //             'status' => 'completed'
    //         ]);
    //         return back()->with('success', 'Pickup completed successfully!');
    //     }

    //     return back()->with('error', 'Unauthorized action.');
    // }

    public function complete($id)
    {
        $donation = Donation::findOrFail($id);

        $donation->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        return back()->with('success', Auth::user()->name . ', you have successfully marked ' . $donation->food_name . ' as picked up!');
    }
}
