<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\OfficeSetting;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    //
    public function index()
    {   
        $totalUsers = User::count();
        $totalRoles = Role::count();
        $latestUsers = User::latest()->take(5)->get();
        $officeSettings = OfficeSetting::first();

        $widgets = [
            'totalUsers' => $totalUsers,
            'totalRoles' => $totalRoles,
            'latestUsers' => $latestUsers,
            'officeSettings' => $officeSettings,
        ];

        // For debugging


        return view('dashboard', compact('widgets'));
    }
}
