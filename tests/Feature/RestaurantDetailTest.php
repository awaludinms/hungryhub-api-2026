<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class RestaurantDetailTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_get_restaurant_detail_200(): void
    {
        $this->seed();

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->getJson('/restaurants/1');
        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
                $json->has('data', 1)
                    ->has('data.0', fn (AssertableJson $json) =>
                    $json->where('id', 1)
                        ->where('name', 'Restoran Nasi Padang')
                        ->etc()
                    )
        );
    }
}
