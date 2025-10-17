<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class UpdateAdminCredentialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Admin::first();
        if ($admin) {
            $admin->update([
                'email' => 'name@admin.gmail.com',
                'password' => Hash::make('admin123'),
            ]);
            $this->command->info('Admin credentials updated successfully!');
            $this->command->info('Email: name@admin.gmail.com');
            $this->command->info('Password: admin123');
        }
    }
}
