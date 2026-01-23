<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        Profile::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Ichwal',
                'email' => 'ichwal@example.com',
                'bio' => 'Passionate Full Stack Developer with 5+ years of experience in building scalable web applications. I specialize in Laravel, React, and Modern Cloud Architecture.',
                'hero_image' => null, // User can upload later
                'resume_link' => 'https://example.com/resume.pdf',
                'social_links' => [
                    'github' => 'https://github.com/ichwal',
                    'linkedin' => 'https://linkedin.com/in/ichwal',
                    'instagram' => 'https://instagram.com/ichwal',
                    'twitter' => 'https://twitter.com/ichwal',
                ],
            ]
        );
    }
}
