<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\OfficeSetting;

class OfficeSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        OfficeSetting::create([
            'app_name' => 'My Office',
            'app_logo' => null,
            'app_favicon' => null,
            'contact_email' => 'info@example.com',
            'contact_phone' => '123-456-7890',
            'address' => '123 Main St, City, Country',
            'footer_text' => '© 2024 My Office. All rights reserved.',
            'timezone' => 'UTC',
            'details' => 'Welcome to My Office Management System.', 
        ]);
    }
}
