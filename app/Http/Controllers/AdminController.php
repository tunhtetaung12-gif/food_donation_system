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
        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'recentUsers' => User::latest()->take(5)->get()
        ]);
    }
}
