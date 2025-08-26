<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $totalUsers = User::count();
        $totalRoles = Role::count();
        $latestUsers = User::latest()->take(5)->get();

        return view('dashboard', compact('totalUsers', 'totalRoles', 'latestUsers'));
    }
}
