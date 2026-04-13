<?php

namespace Tests\Feature;

use App\Models\Certificate;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CertificateApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_get_certificates_from_v1_endpoint(): void
    {
        User::factory()->create([
            'api_key' => 'certificate-api-key',
        ]);

        Certificate::create([
            'title' => 'Cisco Certified Network Associate (CCNA)',
            'issuer' => 'Cisco Systems',
            'issue_date' => '2022-10-01',
            'credential_id' => 'CSCO123abc',
            'credential_url' => 'https://www.credly.com/badges/ccna',
            'image' => null,
        ]);

        Certificate::create([
            'title' => 'AWS Certified Solutions Architect - Associate',
            'issuer' => 'Amazon Web Services',
            'issue_date' => '2024-05-12',
            'credential_id' => 'AWS-12345XYZ',
            'credential_url' => 'https://www.credly.com/badges/aws',
            'image' => 'certificates/aws.webp',
        ]);

        $response = $this->getJson('/api/v1/certificates?api_key=certificate-api-key');

        $response
            ->assertOk()
            ->assertJsonCount(2)
            ->assertJsonPath('0.title', 'AWS Certified Solutions Architect - Associate')
            ->assertJsonPath('0.issue_date', '2024-05-12')
            ->assertJsonPath('0.image', asset('storage/certificates/aws.webp'))
            ->assertJsonPath('1.title', 'Cisco Certified Network Associate (CCNA)')
            ->assertJsonPath('1.image', null);
    }

    public function test_it_rejects_certificate_endpoint_without_valid_api_key(): void
    {
        $response = $this->getJson('/api/v1/certificates?api_key=wrong-key');

        $response
            ->assertStatus(401)
            ->assertJson([
                'message' => 'API Key check failed: Invalid Key',
            ]);
    }
}
