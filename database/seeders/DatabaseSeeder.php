<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed a default admin credential and the curated teacher catalogue.
        $this->call([
            AdminSeeder::class,
            TeacherSeeder::class,
        ]);
    }
}
