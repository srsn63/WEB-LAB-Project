<?php

namespace Database\Seeders;

use App\Models\Notice;
use Illuminate\Database\Seeder;

class NoticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Notice::create([
            'title' => 'Midterm Examination Schedule Released',
            'content' => 'The schedule for the Fall 2025 midterm examinations has been published. Please check the academic portal for detailed information about exam dates, times, and rooms. All students are advised to prepare accordingly and follow the examination guidelines strictly. Contact the academic office for any queries regarding the examination schedule.',
        ]);

        Notice::create([
            'title' => 'Seminar on Artificial Intelligence',
            'content' => 'The Department of Computer Science & Engineering is organizing a seminar on "Recent Advances in Artificial Intelligence" by Dr. Jane Smith on October 25, 2025. The seminar will cover machine learning, deep learning, and their applications in various fields. All students and faculty members are invited to attend this informative session.',
        ]);

        Notice::create([
            'title' => 'Lab Assignment Deadline Extended',
            'content' => 'The deadline for Data Structures lab assignments has been extended to October 20, 2025. Students who need additional time to complete their assignments can take advantage of this extension. Please submit your completed assignments to the course instructor or upload them to the online portal.',
        ]);

        Notice::create([
            'title' => 'New Course Registration Opens',
            'content' => 'Registration for Spring 2026 semester courses will begin on November 1, 2025. Students are advised to review the course catalog and plan their academic schedule accordingly. Please contact the academic advisor for guidance on course selection and registration procedures.',
        ]);

        Notice::create([
            'title' => 'Short Notice',
            'content' => 'This is a shorter notice that should not show a read more link.',
        ]);
    }
}