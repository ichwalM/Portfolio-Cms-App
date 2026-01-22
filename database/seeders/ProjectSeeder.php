<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => 'E-Commerce Platform',
                'slug' => 'e-commerce-platform',
                'description' => 'A fully featured e-commerce platform built with Laravel and React. Features include stripe payment integration, real-time inventory management, and a custom admin dashboard.',
                'thumbnail' => null,
                'tech_stack' => ['Laravel', 'React', 'MySQL', 'Stripe', 'Redis'],
                'demo_url' => 'https://demo.ecommerce.com',
                'github_url' => 'https://github.com/ichwal/ecommerce',
                'published_at' => now()->subMonths(2),
            ],
            [
                'title' => 'Task Management SaaS',
                'slug' => 'task-management-saas',
                'description' => 'A productivity tool for teams to manage tasks and projects. Includes real-time collaboration with WebSockets, drag-and-drop kanban boards, and team analytics.',
                'thumbnail' => null,
                'tech_stack' => ['Vue.js', 'Firebase', 'Tailwind CSS', 'Node.js'],
                'demo_url' => 'https://tasks.app',
                'github_url' => 'https://github.com/ichwal/tasks',
                'published_at' => now()->subMonths(5),
            ],
            [
                'title' => 'AI Image Generator',
                'slug' => 'ai-image-generator',
                'description' => 'An application that interfaces with OpenAI DALL-E 3 API to generate images from text prompts. Features a community gallery and prompt engineering tools.',
                'thumbnail' => null,
                'tech_stack' => ['Next.js', 'OpenAI API', 'PostgreSQL', 'Prisma'],
                'demo_url' => 'https://ai-gen.art',
                'github_url' => 'https://github.com/ichwal/ai-gen',
                'published_at' => now()->subMonth(),
            ],
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(['slug' => $project['slug']], $project);
        }
    }
}
