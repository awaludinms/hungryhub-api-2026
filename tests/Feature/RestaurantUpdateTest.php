<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class RestaurantUpdateTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_unauthorized_update_restaurant(): void
    {

        $response = $this->putJson('/restaurants/1', [
            'name' => 'Restaurant 1',
            'address' => 'Yogyakarta'
        ]);

        $response->assertStatus(401);
    }


    public function test_update_restaurant_status_code_200_and_success_true(): void
    {
        $this->seed();

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->putJson('/restaurants/1', [
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
