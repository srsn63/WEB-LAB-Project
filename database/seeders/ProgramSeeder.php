<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\ProgramOutcome;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create B.Sc. CSE Program
        $program = Program::create([
            'name' => 'Bachelor of Science in Computer Science and Engineering',
            'short_name' => 'B.Sc. in CSE',
            'degree_type' => 'undergraduate',
            'duration' => '4 Years',
            'total_credits' => 162,
            'description' => 'The Bachelor of Science in Computer Science and Engineering program at KUET is designed to produce highly skilled graduates capable of addressing contemporary challenges in computing and engineering. Established in 1999, our department has been at the forefront of computer science education in Bangladesh. The program emphasizes both theoretical foundations and practical applications, integrating cutting-edge technologies with traditional computer science principles. Students engage in hands-on learning through laboratory work, projects, and internships, preparing them for successful careers in software development, system design, data science, artificial intelligence, cybersecurity, and related fields. Our curriculum is regularly updated to reflect industry trends and technological advancements, ensuring our graduates remain competitive in the global job market.',
            'objectives' => "• Develop strong analytical and problem-solving skills to tackle complex computational challenges
• Master programming languages, algorithms, and data structures with emphasis on efficient code development
• Understand software engineering principles, system design patterns, and software development lifecycle
• Gain comprehensive expertise in emerging technologies including Artificial Intelligence, Machine Learning, Internet of Things, and Cloud Computing
• Build proficiency in database management systems, computer networks, and cybersecurity
• Cultivate effective teamwork, communication, and leadership abilities for collaborative software development
• Apply ethical principles in computing and engineering practice, understanding social and professional responsibilities
• Develop research skills and innovation mindset to contribute to technological advancement
• Understand the impact of computing solutions in global, economic, environmental, and societal contexts",
            'career_prospects' => "Graduates of the B.Sc. in CSE program from KUET have excellent career prospects both nationally and internationally. Our alumni are successfully employed in leading technology companies worldwide.

**Industry Roles:**
• Software Engineer/Developer - Design, develop, and maintain software applications
• Data Scientist/Data Engineer - Analyze large datasets and build data-driven solutions
• Machine Learning Engineer/AI Specialist - Develop intelligent systems and algorithms
• Full-Stack Web Developer - Create dynamic web applications and services
• Mobile Application Developer - Build iOS and Android applications
• System Architect/DevOps Engineer - Design scalable systems and automate deployment
• Cybersecurity Specialist/Ethical Hacker - Protect systems and networks from threats
• Database Administrator/Engineer - Design and manage database systems
• Cloud Solutions Architect - Implement cloud-based infrastructure
• IT Consultant/Technical Lead - Provide expert technical guidance

**Top Recruiters:**
Google, Microsoft, Amazon, Facebook, Samsung, Huawei, bKash, Pathao, Chaldal, Brain Station 23, Therap BD, SSL Wireless, and many multinational corporations.

**Higher Studies Opportunities:**
• M.Sc./Ph.D. in Computer Science from top universities (MIT, Stanford, CMU, etc.)
• Specialized Masters in AI, Data Science, Cybersecurity, Software Engineering
• MBA in Technology Management

**Entrepreneurship:**
Many graduates have successfully founded their own tech startups in areas like fintech, e-commerce, healthcare IT, and educational technology.

**Average Salary Range:**
• Fresh Graduates: 40,000 - 80,000 BDT/month (Bangladesh)
• 2-3 Years Experience: 80,000 - 150,000 BDT/month
• International Opportunities: $60,000 - $120,000 annually",
            'admission_requirements' => "**Eligibility Criteria:**
• Minimum GPA 3.5 in both SSC and HSC examinations (including additional subjects)
• Must have studied Mathematics and Physics in HSC
• Must pass KUET Undergraduate Admission Test

**Admission Test Structure:**
• **Mathematics (60%)** - Higher secondary level mathematics including calculus, algebra, geometry, trigonometry, vectors, and probability
• **Physics (20%)** - Mechanics, electricity, magnetism, modern physics, thermodynamics
• **Chemistry (10%)** - Physical chemistry, organic chemistry, inorganic chemistry
• **English (10%)** - Comprehension, grammar, vocabulary

**Exam Format:**
• Multiple Choice Questions (MCQ) format
• Total Duration: 2 hours
• Negative marking: 0.25 marks deducted for each wrong answer

**Merit List Preparation:**
• Combined merit based on admission test score and HSC results
• Admission test carries more weight in final merit calculation
• Approximately 120 students admitted each year

**Key Dates (2025-26 Academic Session):**
• Application Period: November - December 2025
• Application Fee: 800 BDT (online payment)
• Admission Test Date: January 2026
• Result Publication: February 2026
• Admission & Counseling: February - March 2026
• Classes Begin: March 2026

**How to Apply:**
1. Visit KUET official admission portal: www.kuet.ac.bd
2. Create an account and fill out the online application form
3. Upload required documents (SSC & HSC certificates, photograph, signature)
4. Pay application fee through online banking/mobile banking
5. Download admit card 7 days before the exam

**Required Documents:**
• SSC & HSC mark sheets and certificates
• Recent passport-size photographs (digital)
• National ID card or Birth Certificate
• Payment receipt

**Contact for Admission Queries:**
Undergraduate Admission Office
Khulna University of Engineering & Technology (KUET)
Khulna-9203, Bangladesh
Email: admission@kuet.ac.bd
Phone: +880-41-769468-79 (Ext: 111)

**Scholarship Opportunities:**
• Merit-based scholarships for top performers
• Need-based financial assistance
• Research assistantships for high CGPA students",
            'program_coordinator_id' => null, // You can update this later with a teacher ID
            'is_active' => true,
            'order' => 1,
        ]);

        // Add Program Learning Outcomes
        $outcomes = [
            'Apply knowledge of mathematics, science, computing fundamentals, and engineering principles to solve complex computing problems',
            'Analyze problems, identify and define computing requirements, and design, implement, and evaluate computer-based systems, processes, components, or programs to meet desired needs',
            'Design and conduct experiments as well as analyze and interpret data to improve software development processes',
            'Function effectively on multidisciplinary teams and demonstrate strong interpersonal and communication skills',
            'Understand professional, ethical, legal, security, and social issues and responsibilities in the field of computing',
            'Recognize the need for and engage in continuing professional development and lifelong learning in rapidly evolving technology',
            'Apply current techniques, skills, and modern software engineering tools necessary for computing practice',
            'Use the techniques, skills, and modern engineering tools necessary for engineering practice in software development',
            'Demonstrate entrepreneurial mindset and ability to create innovative technological solutions',
            'Understand the impact of computing solutions in global, economic, environmental, and societal contexts',
            'Manage computing projects and work effectively in team environments with demonstrated leadership qualities',
            'Communicate effectively with a range of audiences through written, oral, and visual presentations',
        ];

        foreach ($outcomes as $index => $outcomeText) {
            ProgramOutcome::create([
                'program_id' => $program->id,
                'outcome_text' => $outcomeText,
                'order' => $index + 1,
            ]);
        }

        echo "\n✅ B.Sc. CSE Program created successfully!\n";
        echo "   Program ID: {$program->id}\n";
        echo "   Program Name: {$program->name}\n";
        echo "   Total Credits: {$program->total_credits}\n";
        echo "   Learning Outcomes: " . count($outcomes) . "\n\n";
        echo "🎓 You can now view the program at: http://127.0.0.1:8000/programs\n";
        echo "⚙️  Manage from admin panel: http://127.0.0.1:8000/admin/programs\n\n";
    }
}
