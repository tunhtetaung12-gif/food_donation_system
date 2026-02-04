<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\SupportRequest;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    public function index()
    {
        $donors = User::role('donor')->get();
        $volunteers = User::role('volunteer')->get();
        $members = User::role('member')->get();

        $recentUsers = User::latest()->take(5)->get();
        $totalUsers = User::count();
        $pendingRequestsCount = SupportRequest::where('status', 'pending')->count();
        $recentRequests = SupportRequest::with('user')->latest()->take(5)->get();
        $donorCount = $donors->count();
        $volunteerCount = $volunteers->count();
        $memberCount = $members->count();

        return view('admin.dashboard', compact(
            'donors',
            'volunteers',
            'recentUsers',
            'totalUsers',
            'donorCount',
            'memberCount',
            'volunteerCount',
            'pendingRequestsCount',
            'recentRequests'

        ));
    }

    public function manageUsers()
    {
        $users = User::with('roles')->paginate(5);
        return view('admin.users.index', compact('users'));
    }

    public function editUser(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        if (Auth::id() === $user->id) {
            return back()->with('status', 'You cannot delete your own account.');
        }

        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('status', 'Member successfully removed.');
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

        $donation = Donation::findOrFail($id);
        $volunteer = User::findOrFail($request->volunteer_id);

        $donation->update([
            'volunteer_id' => $request->volunteer_id,
            'status' => 'assigned'
        ]);

        return back()->with('success', "Volunteer {$volunteer->name} has been successfully assigned to collect {$donation->food_name}.");
    }

    public function manageSupportRequests()
    {

        $requests = SupportRequest::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.support_requests.index', compact('requests'));
    }

    public function updateRequestStatus(Request $request, $id)
    {
        $supportRequest = SupportRequest::findOrFail($id);

        $supportRequest->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Request status updated successfully!');
    }
}
