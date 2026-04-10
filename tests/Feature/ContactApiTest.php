<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_store_contact_message(): void
    {
        User::factory()->create([
            'api_key' => 'valid-contact-key',
        ]);

        $payload = [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'subject' => 'Project collaboration',
            'message' => 'Halo, saya tertarik untuk berkolaborasi pada proyek web.',
        ];

        $response = $this->postJson('/api/contact?api_key=valid-contact-key', $payload);

        $response
            ->assertOk()
            ->assertJson([
                'success' => true,
                'message' => 'Your message has been sent successfully.',
            ]);

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'subject' => 'Project collaboration',
            'message' => 'Halo, saya tertarik untuk berkolaborasi pada proyek web.',
            'status' => 'unread',
        ]);
    }

    public function test_it_returns_validation_errors_for_invalid_contact_payload(): void
    {
        User::factory()->create([
            'api_key' => 'valid-contact-key',
        ]);

        $response = $this->postJson('/api/contact?api_key=valid-contact-key', [
            'name' => '',
            'email' => 'invalid-email',
            'message' => '',
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonPath('success', false)
            ->assertJsonPath('message', 'The given data was invalid.')
            ->assertJsonValidationErrors(['name', 'email', 'message']);
    }

    public function test_it_rejects_request_with_invalid_api_key(): void
    {
        $response = $this->postJson('/api/contact?api_key=invalid-key', [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'message' => 'Test message',
        ]);

        $response
            ->assertStatus(401)
            ->assertJson([
                'message' => 'API Key check failed: Invalid Key',
            ]);
    }
}
