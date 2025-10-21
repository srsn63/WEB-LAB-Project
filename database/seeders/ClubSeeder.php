<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Club;
use Carbon\Carbon;

class ClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clubs = [
            [
                'name' => 'Special Group Interested in Programming Contest',
                'short_name' => 'SGIPC',
                'description' => 'SGIPC is a competitive programming club dedicated to developing problem-solving skills and preparing students for national and international programming contests. We organize regular training sessions, mock contests, and workshops to help students excel in competitive programming.',
                'mission' => 'To foster a culture of competitive programming and algorithmic thinking among students, preparing them for prestigious contests like ICPC, Google Code Jam, and Facebook Hacker Cup.',
                'vision' => 'To establish KUET CSE as a leading hub for competitive programming in Bangladesh and produce world-class problem solvers.',
                'founded_date' => Carbon::parse('2010-01-15'),
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Hardware Acceleration Club of KUET',
                'short_name' => 'HACK',
                'description' => 'HACK focuses on hardware design, embedded systems, and hardware acceleration technologies. We work on projects involving FPGA, microcontrollers, IoT devices, and custom hardware solutions. Our members participate in robotics competitions and hardware hackathons.',
                'mission' => 'To promote hands-on learning in hardware engineering and bridge the gap between theoretical knowledge and practical implementation in embedded systems and hardware design.',
                'vision' => 'To create innovative hardware solutions and contribute to the advancement of hardware technology through research and development.',
                'founded_date' => Carbon::parse('2015-06-20'),
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Software Research and Development Community of KUET',
                'short_name' => 'Bit 2 Byte',
                'description' => 'Bit 2 Byte is a software development and research community that focuses on modern software engineering practices, web development, mobile app development, machine learning, and emerging technologies. We organize workshops, hackathons, and collaborative projects to enhance practical software development skills.',
                'mission' => 'To empower students with cutting-edge software development skills and create a collaborative environment for building innovative software solutions.',
                'vision' => 'To be the premier software development community in Bangladesh, producing industry-ready software engineers and contributing to open-source projects.',
                'founded_date' => Carbon::parse('2012-09-10'),
                'is_active' => true,
                'order' => 3,
            ],
        ];

        foreach ($clubs as $clubData) {
            Club::create($clubData);
        }
    }
}
