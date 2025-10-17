<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UpdateExistingTeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update existing teachers with credentials
        $teachers = [
            [
                'id' => 1,
                'email' => 'cristiano.ronaldo@teachers.gmail.com',
                'password' => 'cr7@2024',
            ],
            [
                'id' => 2,
                'email' => 'neymar.junior@teachers.gmail.com',
                'password' => 'neymar@2024',
            ],
        ];

        foreach ($teachers as $teacherData) {
            $teacher = Teacher::find($teacherData['id']);
            if ($teacher) {
                $teacher->update([
                    'email' => $teacherData['email'],
                    'password' => Hash::make($teacherData['password']),
                ]);
                
                $this->command->info("Updated: {$teacher->name}");
                $this->command->info("  Email: {$teacherData['email']}");
                $this->command->info("  Password: {$teacherData['password']}");
                $this->command->newLine();
            }
        }

        $this->command->info('========================================');
        $this->command->info('TEACHER CREDENTIALS SUMMARY:');
        $this->command->info('========================================');
        $this->command->newLine();
        
        $this->command->info('Teacher 1:');
        $this->command->info('  Name: Cristiano Ronaldo CR7');
        $this->command->info('  Email: cristiano.ronaldo@teachers.gmail.com');
        $this->command->info('  Password: cr7@2024');
        $this->command->newLine();
        
        $this->command->info('Teacher 2:');
        $this->command->info('  Name: Neymar Jr');
        $this->command->info('  Email: neymar.junior@teachers.gmail.com');
        $this->command->info('  Password: neymar@2024');
        $this->command->newLine();
        
        $this->command->info('========================================');
        $this->command->info('Teachers can now login at: /teacher/login');
        $this->command->info('========================================');
    }
}
