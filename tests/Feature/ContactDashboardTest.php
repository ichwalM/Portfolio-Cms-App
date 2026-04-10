<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_contact_messages_page(): void
    {
        $this->get(route('dashboard.contacts.index'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_view_contact_messages_page(): void
    {
        $user = User::factory()->create();

        ContactMessage::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'subject' => 'Kolaborasi',
            'message' => 'Halo, saya tertarik untuk kerja sama proyek.',
            'status' => 'unread',
        ]);

        $this->actingAs($user)
            ->get(route('dashboard.contacts.index'))
            ->assertOk()
            ->assertSee('Budi Santoso')
            ->assertSee('budi@example.com')
            ->assertSee('Kolaborasi');
    }

    public function test_authenticated_user_can_delete_contact_message(): void
    {
        $user = User::factory()->create();

        $message = ContactMessage::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'subject' => null,
            'message' => 'Halo, ini pesan tes.',
            'status' => 'unread',
        ]);

        $this->actingAs($user)
            ->delete(route('dashboard.contacts.destroy', $message))
            ->assertRedirect()
            ->assertSessionHas('success', 'Message deleted successfully!');

        $this->assertDatabaseMissing('contact_messages', [
            'id' => $message->id,
        ]);
    }
}
