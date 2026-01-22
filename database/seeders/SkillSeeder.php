<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            // Backend
            ['name' => 'Laravel', 'category' => 'Backend', 'proficiency' => 95],
            ['name' => 'PHP', 'category' => 'Backend', 'proficiency' => 90],
            ['name' => 'Node.js', 'category' => 'Backend', 'proficiency' => 85],
            ['name' => 'Go', 'category' => 'Backend', 'proficiency' => 70],
            
            // Frontend
            ['name' => 'React', 'category' => 'Frontend', 'proficiency' => 90],
            ['name' => 'Vue.js', 'category' => 'Frontend', 'proficiency' => 80],
            ['name' => 'Tailwind CSS', 'category' => 'Frontend', 'proficiency' => 95],
            ['name' => 'TypeScript', 'category' => 'Frontend', 'proficiency' => 85],

            // DevOps
            ['name' => 'Docker', 'category' => 'DevOps', 'proficiency' => 80],
            ['name' => 'AWS', 'category' => 'DevOps', 'proficiency' => 75],
            ['name' => 'CI/CD', 'category' => 'DevOps', 'proficiency' => 85],

            // Tools
            ['name' => 'Git', 'category' => 'Tools', 'proficiency' => 95],
            ['name' => 'Figma', 'category' => 'Design', 'proficiency' => 60],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(['name' => $skill['name']], $skill);
        }
    }
}
