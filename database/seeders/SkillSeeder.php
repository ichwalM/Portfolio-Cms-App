<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil data dari file JSON (format: { "Category": [ { name, proficiency } ] })
        $jsonPath = database_path('seeders/data/skills.json');
        $grouped = json_decode(file_get_contents($jsonPath), true);

        // Hapus data lama agar tidak duplikat
        Skill::truncate();

        foreach ($grouped as $category => $skills) {
            foreach ($skills as $skill) {
                Skill::create([
                    'name'        => $skill['name'],
                    'category'    => $category,
                    'proficiency' => $skill['proficiency'],
                    'icon'        => null, // bisa diupload manual lewat dashboard
                ]);
            }
        }
    }
}
