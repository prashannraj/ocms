<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfficeSetting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OfficeSettingController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $settings = OfficeSetting::first();
        return view('office_setting.index', compact('settings'));
    }

    public function edit()
    {
        $this->authorize('manage', OfficeSetting::class);
        $officeSetting = OfficeSetting::first();
        return view('office_settings.edit', compact('officeSetting'));
    }

    public function update(Request $request)
    {
        $this->authorize('manage', OfficeSetting::class);

        $data = $request->validate([
            'app_name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'contact_phone' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email|max:255',
            'app_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'app_favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,ico|max:1024',
            'footer_text' => 'nullable|string|max:255',
            'timezone' => 'required|string|max:100',
            'details' => 'nullable|string',
        ]);

        $officeSetting = OfficeSetting::first();

        // ✅ Handle app_logo upload using 'public' disk
        if ($request->hasFile('app_logo')) {
            if ($officeSetting && $officeSetting->app_logo) {
                Storage::disk('public')->delete($officeSetting->app_logo);
            }

            $logoPath = $request->file('app_logo')->store('office_setting', 'public');
            $data['app_logo'] = $logoPath;
        }

        // ✅ Handle app_favicon upload using 'public' disk
        if ($request->hasFile('app_favicon')) {
            if ($officeSetting && $officeSetting->app_favicon) {
                Storage::disk('public')->delete($officeSetting->app_favicon);
            }

            $faviconPath = $request->file('app_favicon')->store('office_setting', 'public');
            $data['app_favicon'] = $faviconPath;
        }

        if ($officeSetting) {
            $officeSetting->update($data);
        } else {
            OfficeSetting::create($data);
        }

        return redirect()->route('office_settings.edit')->with('success', 'Office settings updated successfully.');
    }
}
