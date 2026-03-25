<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class RestaurantDeleteTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_unauthorized_update_restaurant(): void
    {

        $response = $this->deleteJson('/restaurants/1');

        $response->assertStatus(401);
    }


    public function test_update_restaurant_status_code_500_when_there_is_still_menu_exists_on_this_restaurant(): void
    {
        $this->seed();

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->deleteJson('/restaurants/1');

        $response->assertStatus(500);
    }
}
