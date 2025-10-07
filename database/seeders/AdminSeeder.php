<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Seed the application's admin accounts.
     */
    public function run(): void
    {
        // Ensure any legacy admin email is migrated to the new address.
        Admin::where('email', 'admin@kuet.ac.bd')
            ->update(['email' => 'admin@gmai.com']);

        Admin::updateOrCreate(
            ['email' => 'admin@gmai.com'],
            [
                'name' => 'Site Administrator',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}
