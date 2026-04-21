<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use Illuminate\Support\Facades\File;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        // Path ke file JSON
        $jsonPath = database_path('seeders/data/projects.json');

        // Cek apakah file JSON ada
        if (!File::exists($jsonPath)) {
            $this->command->warn("File projects.json tidak ditemukan di {$jsonPath}");
            return;
        }

        // Baca file JSON
        $jsonContent = File::get($jsonPath);
        $projects = json_decode($jsonContent, true);

        // Validasi JSON
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->command->error('Error parsing projects.json: ' . json_last_error_msg());
            return;
        }

        // Loop dan insert/update data
        $createdCount = 0;
        $updatedCount = 0;

        foreach ($projects as $project) {
            // Skip jika tidak ada slug
            if (empty($project['slug'])) {
                continue;
            }

            // Format data untuk database
            $data = [
                'title' => $project['title'] ?? '',
                'slug' => $project['slug'],
                'description' => $project['description'] ?? '',
                'content' => $project['content'] ?? '',
                'thumbnail' => $project['thumbnail'] ?? null,
                'tech_stack' => is_array($project['tech_stack']) ? $project['tech_stack'] : [],
                'github_url' => $project['github_url'] ?? null,
                'live_url' => $project['live_url'] ?? null,
                'published_at' => $project['published_at'] ?? now(),
            ];

            // Update atau create
            $result = Project::updateOrCreate(
                ['slug' => $project['slug']],
                $data
            );

            // Track updates
            if ($result->wasRecentlyCreated) {
                $createdCount++;
            } else {
                $updatedCount++;
            }
        }

        // Output summary
        $this->command->info("✓ Projects seeded successfully!");
        $this->command->info("  Created: {$createdCount}");
        $this->command->info("  Updated: {$updatedCount}");
    }
}
