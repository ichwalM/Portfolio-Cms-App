<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectSlugEndpointTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_get_published_project_by_slug_on_v1_endpoint(): void
    {
        User::factory()->create([
            'api_key' => 'project-endpoint-key',
        ]);

        Project::create([
            'title' => 'Portfolio CMS',
            'slug' => 'portfolio-cms',
            'description' => 'Project description',
            'tech_stack' => ['Laravel', 'Tailwind'],
            'demo_url' => 'https://example.com',
            'github_url' => 'https://github.com/example/repo',
            'published_at' => now(),
        ]);

        $response = $this->getJson('/api/v1/projects/portfolio-cms?api_key=project-endpoint-key');

        $response
            ->assertOk()
            ->assertJsonPath('slug', 'portfolio-cms')
            ->assertJsonPath('title', 'Portfolio CMS');
    }

    public function test_it_returns_not_found_for_unpublished_project(): void
    {
        User::factory()->create([
            'api_key' => 'project-endpoint-key',
        ]);

        Project::create([
            'title' => 'Draft Project',
            'slug' => 'draft-project',
            'description' => 'Draft',
            'tech_stack' => ['Laravel'],
            'published_at' => null,
        ]);

        $response = $this->getJson('/api/v1/projects/draft-project?api_key=project-endpoint-key');

        $response->assertNotFound();
    }

    public function test_it_rejects_project_endpoint_without_valid_api_key(): void
    {
        $response = $this->getJson('/api/v1/projects/portfolio-cms?api_key=wrong-key');

        $response
            ->assertStatus(401)
            ->assertJson([
                'message' => 'API Key check failed: Invalid Key',
            ]);
    }
}
