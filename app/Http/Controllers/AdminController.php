<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the Admin Dashboard.
     */
    public function index()
    {
        // 1. Get all Donors for the Assignment Table
        $donors = \App\Models\User::role('donor')->get();

        // 2. Get all Volunteers for the Dropdown menus
        $volunteers = \App\Models\User::role('volunteer')->get();

        // 3. Get the 5 most recent registrations (the variable that was missing!)
        $recentUsers = \App\Models\User::latest()->take(5)->get();

        // 4. Calculate Stats
        $totalUsers = \App\Models\User::count();
        $donorCount = \App\Models\User::role('donor')->count();
        $volunteerCount = \App\Models\User::role('volunteer')->count();

        // Pass everything to the view
        return view('admin.dashboard', compact(
            'donors',
            'volunteers',
            'recentUsers',
            'totalUsers',
            'donorCount',
            'volunteerCount'
        ));
    }

    public function assignVolunteer(Request $request)
    {
        $donor = \App\Models\User::findOrFail($request->donor_id);
        $donor->update(['assigned_to' => $request->volunteer_id]);

        return back()->with('status', 'Volunteer assigned successfully!');
    }

    // Add these to your AdminController
    public function manageUsers()
    {
        $users = \App\Models\User::with('roles')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function editUser(\App\Models\User $user)
    {
        $roles = \Spatie\Permission\Models\Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required'
        ]);

        $user->update($request->only('name', 'email'));
        $user->syncRoles($request->role);

        return redirect()->route('admin.users.index')->with('status', 'User updated!');
    }
}
