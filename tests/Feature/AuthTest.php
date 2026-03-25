<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    // use DatabaseMigrations;

    /**
     * A basic feature test example.
     */
    public function test_unauthorized_access_on_restaurants_without_token_got_401(): void
    {

        $response = $this->getJson('/restaurants/');
        $response->assertStatus(401);
    }

    public function test_unauthorized_access_on_restaurant_details_without_token_got_401(): void
    {
        $this->seed();

        $response = $this->getJson('/restaurants/1');
        $response->assertStatus(401);

    }

    public function test_unauthorized_access_on_restaurant_menu_items_without_token_got_401(): void
    {
        $this->seed();

        $response = $this->getJson('/restaurants/1/menu_items');
        $response->assertStatus(401);

    }

    public function test_access_restaurant_with_token(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->getJson('/restaurants/');
        $response->assertStatus(200);

    }
}
