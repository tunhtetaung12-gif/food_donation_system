<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SupportRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportRequestController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $requests = $user->supportRequests()->latest()->get();

        return view('member.requests.index', compact('requests'));
    }

    public function create()
    {
        return view('member.requests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'reason' => 'required|string|max:500',
            'items_needed' => 'required|string|max:255',
            'address' => 'required',
            'urgency' => 'required|in:low,medium,high',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $user->supportRequests()->create([
            'reason' => $request->reason,
            'items_needed' => $request->items_needed,
            'address' => $request->address,
            'urgency' => $request->urgency,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Support request submitted!');
    }
}
