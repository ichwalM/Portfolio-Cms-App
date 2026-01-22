<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Experience;

class ExperienceSeeder extends Seeder
{
    public function run(): void
    {
        $experiences = [
            [
                'company' => 'Tech Solutions Inc.',
                'role' => 'Senior Full Stack Developer',
                'start_date' => '2023-01-01',
                'end_date' => null, // Present
                'description' => "Leading a team of 5 developers in building scalable web applications.\n- Architected a microservices-based backend handling 10k+ concurrent users.\n- Reduced cloud infrastructure costs by 30% through optimization.\n- Mentored junior developers and implemented code review best practices.",
            ],
            [
                'company' => 'Creative Digital Agency',
                'role' => 'Web Developer',
                'start_date' => '2021-03-01',
                'end_date' => '2022-12-31',
                'description' => "Developed custom websites and e-commerce solutions for various clients.\n- Collaborated with designers to implement pixel-perfect user interfaces.\n- Optimized website performance, achieving 90+ Google Lighthouse scores.\n- Integrated third-party APIs for payments, shipping, and CRM.",
            ],
            [
                'company' => 'StartUp Hub',
                'role' => 'Junior Developer',
                'start_date' => '2019-06-01',
                'end_date' => '2021-02-28',
                'description' => "Assisted in the development of the company's core product.\n- Fixed bugs and improved existing codebase.\n- Wrote unit and feature tests to ensure application stability.\n- Participated in daily stand-ups and agile sprint planning.",
            ],
        ];

        foreach ($experiences as $experience) {
            Experience::updateOrCreate(['company' => $experience['company'], 'role' => $experience['role']], $experience);
        }
    }
}
