<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class RestaurantCreateTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_unauthorized_create_restaurant_with_name_address(): void
    {
        $response = $this->postJson('/restaurants', [
            'name' => 'Restaurant 1',
            'address' => 'Yogyakarta'
        ]);

        $response->assertStatus(401);
    }

    public function test_create_restaurant_without_name_status_get_error_code_422(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->postJson('/restaurants', [
            ''
        ]);

        $response->assertStatus(422);
    }

    public function test_create_restaurant_without_address_status_get_error_code_422(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->postJson('/restaurants', [
            'name' => 'Restaurant 1'
        ]);

        $response->assertStatus(422);
    }

    public function test_create_restaurant_with_name_address_status_code_200_and_success_true(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->postJson('/restaurants', [
            'name' => 'Restaurant 1',
            'address' => 'Yogyakarta'
        ]);

        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
                $json
                    ->where('success', true)
                    ->etc()
        );
    }
}
