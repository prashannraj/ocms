<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\OfficeSetting;
use App\Models\EnquiryForm;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [];

        // Total users and roles count
        $data['totalUsers'] = User::count();
        $data['totalRoles'] = Role::count();
        $data['totalEnquiryForms'] = EnquiryForm::count();

        // Latest 5 users
        $data['latestUsers'] = User::latest()->take(5)->get();

        // Office settings (assuming singleton)
        $data['officeSettings'] = OfficeSetting::first();

        // Users registered in different periods (last 30 days, 3 months, 6 months, 1 year)
        $userCounts = [];
        $userCounts[] = User::where('created_at', '>=', Carbon::now()->subDays(30))->count();
        $userCounts[] = User::where('created_at', '>=', Carbon::now()->subMonths(3))->count();
        $userCounts[] = User::where('created_at', '>=', Carbon::now()->subMonths(6))->count();
        $userCounts[] = User::where('created_at', '>=', Carbon::now()->subYear(1))->count();
        $data['userRegistrations'] = collect($userCounts);

        // Roles and number of users in each role
        $roles = Role::withCount('users')->get();
        $data['rolesWithUserCount'] = $roles;

        // Example: Group users by their roles (for a pie chart or similar)
        $roleUserCounts = [];
        foreach ($roles as $role) {
            $roleUserCounts[$role->name] = $role->users_count;
        }
        $data['roleUserCounts'] = $roleUserCounts;

        // Optional: Some other statistics - e.g., users created today
        $data['usersToday'] = User::whereDate('created_at', Carbon::today())->count();

        // Debug example (uncomment if needed)
        // dd($data);
        // EnquiryForms rgistered in different periods (last 30 days, 3 months, 6 months, 1 year)
        $enquiryCounts = [];
        $enquiryCounts[] = EnquiryForm::where('created_at', '>=', Carbon::now()->subDays(30))->count();
        $enquiryCounts[] = EnquiryForm::where('created_at', '>=', Carbon::now()->subMonths(3))->count();
        $enquiryCounts[] = EnquiryForm::where('created_at', '>=', Carbon::now()->subMonths(6))->count();
        $enquiryCounts[] = EnquiryForm::where('created_at', '>=', Carbon::now()->subYear(1))->count();
        $data['enquiryRegistrations'] = collect($enquiryCounts);
        


        return view('dashboard', compact('data'));
    }
}
