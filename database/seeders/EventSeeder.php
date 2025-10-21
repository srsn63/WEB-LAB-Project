<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'Annual Tech Fest 2025',
                'description' => 'Join us for the biggest tech festival of the year! Featuring workshops, competitions, tech talks, and networking opportunities with industry professionals. Showcase your projects, learn new technologies, and connect with fellow tech enthusiasts.',
                'event_type' => 'Conference',
                'venue' => 'Central Auditorium, KUET',
                'event_date' => Carbon::now()->addDays(15)->setTime(9, 0),
                'end_date' => Carbon::now()->addDays(17)->setTime(17, 0),
                'organizer' => 'Department of CSE',
                'contact_email' => 'cse@kuet.ac.bd',
                'registration_link' => 'https://forms.google.com/techfest2025',
                'max_participants' => 500,
                'is_featured' => true,
                'is_active' => true,
                'order' => 1
            ],
            [
                'title' => 'Machine Learning Workshop',
                'description' => 'Hands-on workshop on Machine Learning fundamentals and applications. Learn about supervised and unsupervised learning, neural networks, and implement real-world ML projects. Perfect for beginners and intermediate learners.',
                'event_type' => 'Workshop',
                'venue' => 'Computer Lab 2',
                'event_date' => Carbon::now()->addDays(10)->setTime(14, 0),
                'end_date' => Carbon::now()->addDays(10)->setTime(17, 0),
                'organizer' => 'AI Research Group',
                'contact_email' => 'ai.research@kuet.ac.bd',
                'registration_link' => 'https://forms.google.com/ml-workshop',
                'max_participants' => 50,
                'is_featured' => true,
                'is_active' => true,
                'order' => 2
            ],
            [
                'title' => 'Hackathon 2025: Code for Change',
                'description' => 'A 48-hour hackathon focused on creating innovative solutions for social problems. Team up with fellow students, work on real-world challenges, and compete for exciting prizes. Mentorship and resources provided throughout the event.',
                'event_type' => 'Competition',
                'venue' => 'Innovation Hub, KUET',
                'event_date' => Carbon::now()->addDays(20)->setTime(10, 0),
                'end_date' => Carbon::now()->addDays(22)->setTime(18, 0),
                'organizer' => 'SGIPC',
                'contact_email' => 'sgipc@kuet.ac.bd',
                'registration_link' => 'https://forms.google.com/hackathon2025',
                'max_participants' => 100,
                'is_featured' => true,
                'is_active' => true,
                'order' => 3
            ],
            [
                'title' => 'Web Development Bootcamp',
                'description' => 'Comprehensive bootcamp covering modern web development technologies including HTML, CSS, JavaScript, React, and Node.js. Build real projects and deploy them live. Suitable for beginners with basic programming knowledge.',
                'event_type' => 'Workshop',
                'venue' => 'Computer Lab 3',
                'event_date' => Carbon::now()->addDays(25)->setTime(10, 0),
                'end_date' => Carbon::now()->addDays(25)->setTime(16, 0),
                'organizer' => 'Bit 2 Byte Club',
                'contact_email' => 'bit2byte@kuet.ac.bd',
                'registration_link' => 'https://forms.google.com/webdev-bootcamp',
                'max_participants' => 60,
                'is_featured' => false,
                'is_active' => true,
                'order' => 4
            ],
            [
                'title' => 'Cybersecurity Awareness Seminar',
                'description' => 'Learn about the latest cybersecurity threats and how to protect yourself online. Topics include password security, phishing attacks, social engineering, and best practices for online safety. Open to all students.',
                'event_type' => 'Seminar',
                'venue' => 'Seminar Room 1',
                'event_date' => Carbon::now()->addDays(30)->setTime(15, 0),
                'end_date' => Carbon::now()->addDays(30)->setTime(17, 0),
                'organizer' => 'HACK Club',
                'contact_email' => 'hack@kuet.ac.bd',
                'registration_link' => 'https://forms.google.com/cybersecurity-seminar',
                'max_participants' => 150,
                'is_featured' => false,
                'is_active' => true,
                'order' => 5
            ],
            [
                'title' => 'Career Fair 2025',
                'description' => 'Meet with top tech companies and explore career opportunities in software development, data science, AI, and more. Bring your resumes and portfolios for on-the-spot interviews. Network with alumni and industry professionals.',
                'event_type' => 'Academic',
                'venue' => 'University Ground',
                'event_date' => Carbon::now()->addDays(35)->setTime(9, 0),
                'end_date' => Carbon::now()->addDays(35)->setTime(18, 0),
                'organizer' => 'Career Development Center',
                'contact_email' => 'careers@kuet.ac.bd',
                'registration_link' => 'https://forms.google.com/career-fair-2025',
                'max_participants' => 300,
                'is_featured' => false,
                'is_active' => true,
                'order' => 6
            ],
            [
                'title' => 'Alumni Meetup & Tech Talk',
                'description' => 'Meet successful alumni working in leading tech companies worldwide. Hear their career journeys, get advice on breaking into the industry, and network with professionals. Q&A session included.',
                'event_type' => 'Social',
                'venue' => 'Conference Hall',
                'event_date' => Carbon::now()->addDays(40)->setTime(16, 0),
                'end_date' => Carbon::now()->addDays(40)->setTime(19, 0),
                'organizer' => 'Alumni Association',
                'contact_email' => 'alumni@kuet.ac.bd',
                'max_participants' => 200,
                'is_featured' => false,
                'is_active' => true,
                'order' => 7
            ],
        ];

        foreach ($events as $eventData) {
            Event::create($eventData);
        }
    }
}
