<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $donors = User::role('donor')->get();
        $volunteers = User::role('volunteer')->get();
        $recentUsers = User::latest()->take(5)->get();

        $totalUsers = User::count();
        $donorCount = $donors->count();
        $volunteerCount = $volunteers->count();

        return view('admin.dashboard', compact(
            'donors',
            'volunteers',
            'recentUsers',
            'totalUsers',
            'donorCount',
            'volunteerCount'
        ));
    }

    public function manageUsers()
    {
        $users = User::with('roles')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function editUser(User $user)
    {
        $roles = Role::all();
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

    public function manageDonations()
    {
        $donors = User::whereHas('roles', function ($q) {
            $q->where('name', 'donor');
        })->get();

        $donations = Donation::with('user', 'volunteer')->get();

        $volunteers = User::whereHas('roles', function ($q) {
            $q->where('name', 'volunteer');
        })->get();

        return view('admin.donations.index', compact('donations', 'volunteers', 'donors'));
    }


    public function assignVolunteer(Request $request, $id)
    {

        $request->validate([
            'volunteer_id' => 'required|exists:users,id',
        ]);

        $donation = \App\Models\Donation::findOrFail($id);

        $donation->update([
            'volunteer_id' => $request->volunteer_id,
            'status' => 'assigned'
        ]);

        return back()->with('success', 'Volunteer successfully assigned to ' . $donation->food_name);
    }
}
