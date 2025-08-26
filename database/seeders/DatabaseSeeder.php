<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// Import गर्न आवश्यक seeder हरु
use Database\Seeders\RoleSeeder;
use Database\Seeders\SuperAdminSeeder;
use Database\Seeders\OfficeSettingSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            SuperAdminSeeder::class,
            OfficeSettingSeeder::class,
        ]);
    }
}
