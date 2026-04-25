<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Experience;

class ExperienceSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil data dari file JSON
        $jsonPath = database_path('seeders/data/experiences.json');
        $experiences = json_decode(file_get_contents($jsonPath), true);

        // Hapus data lama agar tidak duplikat
        Experience::truncate();

        foreach ($experiences as $data) {
            Experience::create([
                'company'     => $data['company'],
                'role'        => $data['role'],
                'start_date'  => $data['start_date'],
                'end_date'    => $data['end_date'] ?? null,
                'description' => $data['description'] ?? null,
            ]);
        }
    }
}
