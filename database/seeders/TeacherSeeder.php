<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Seed an initial catalogue of teachers with rich profile data.
     */
    public function run(): void
    {
        $teachers = [
            [
                'name' => 'Dr. Md. Aziz Hasan',
                'slug' => 'md-aziz-hasan',
                'designation' => 'Professor & Head',
                'department' => 'Department of Computer Science & Engineering',
                'email' => 'aziz.hasan@cse.kuet.ac.bd',
                'phone' => '+880-41-000000',
                'office_room' => 'Room 303, Academic Building',
                'website_url' => 'https://www.kuet.ac.bd/cse/azhasan',
                'profile_image' => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=600&q=80',
                'short_bio' => 'Dr. Hasan leads the Department of Computer Science & Engineering with a focus on advanced microprocessor design and VLSI systems.',
                'research_interests' => 'Microprocessors, VLSI, Embedded Systems, Parallel Computing',
                'education' => [
                    'Ph.D. in Computer Engineering, Kyung Hee University, 2010',
                    'M.Sc. in Computer Science & Engineering, KUET, 2004',
                    'B.Sc. in Computer Science & Engineering, KUET, 2001',
                ],
                'honors' => [
                    'Recipient of the Korean Government Scholarship (KGSP)',
                    'Best Paper Award, International Conference on VLSI 2012',
                ],
                'courses' => [
                    'Digital Logic Design',
                    'Advanced Microprocessor Architecture',
                    'VLSI System Design',
                ],
                'publications' => 'Has published over 50 peer-reviewed articles covering microarchitecture optimisations, embedded systems, and high-performance VLSI design.',
            ],
            [
                'name' => 'Dr. Jane Smith',
                'slug' => 'jane-smith',
                'designation' => 'Associate Professor',
                'department' => 'Department of Computer Science & Engineering',
                'email' => 'jane.smith@cse.kuet.ac.bd',
                'phone' => '+880-41-000210',
                'office_room' => 'Room 214, Academic Building',
                'website_url' => null,
                'profile_image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=600&q=80',
                'short_bio' => 'Data science enthusiast driving innovation in large-scale analytics and academic-industry collaboration.',
                'research_interests' => 'Big Data Analytics, Machine Learning, Data Mining',
                'education' => [
                    'Ph.D. in Computer Science, National University of Singapore, 2012',
                    'B.Sc. in Computer Science & Engineering, KUET, 2005',
                ],
                'honors' => [
                    'National ICT Award 2018',
                ],
                'courses' => [
                    'Data Mining',
                    'Machine Learning',
                    'Big Data Analytics',
                ],
                'publications' => 'Led collaborative analytics projects with government agencies and authored numerous articles on societal-scale data systems.',
            ],
            [
                'name' => 'Dr. Rahul Sheikh',
                'slug' => 'rahul-sheikh',
                'designation' => 'Assistant Professor',
                'department' => 'Department of Computer Science & Engineering',
                'email' => 'rahul.sheikh@cse.kuet.ac.bd',
                'phone' => '+880-41-000312',
                'office_room' => 'Room 118, Academic Building',
                'website_url' => null,
                'profile_image' => 'https://images.unsplash.com/photo-1544723795-3fb6469f5b39?auto=format&fit=crop&w=600&q=80',
                'short_bio' => 'Cybersecurity researcher focusing on resilient network infrastructures and privacy-first system design.',
                'research_interests' => 'Network Security, Cyber Defense, Privacy Preserving Systems',
                'education' => [
                    'Ph.D. in Computer Science, University of Melbourne, 2018',
                    'M.Sc. in Information Security, KUET, 2013',
                    'B.Sc. in Computer Science & Engineering, KUET, 2010',
                ],
                'honors' => [
                    'Australian Government Research Training Program Scholarship',
                ],
                'courses' => [
                    'Computer Networks',
                    'Cybersecurity Fundamentals',
                    'Advanced Network Defense',
                ],
                'publications' => 'Regularly contributes to IEEE security conferences with a focus on proactive intrusion detection and secure communication frameworks.',
            ],
        ];

        // Upsert keeps the seed idempotent while letting us iterate on teacher content safely.
        Teacher::upsert($teachers, ['slug']);
    }
}
