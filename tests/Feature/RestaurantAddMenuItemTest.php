<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class RestaurantAddMenuItemTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_add_menu_item_with_name_and_price_got_error_422(): void
    {
        $this->seed();

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->postJson('/restaurants/1/menu_items', [
            'category' => 'main'
        ]);

        $response->assertStatus(422);
    }

     public function test_add_menu_item(): void
    {
        $this->seed();

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->postJson('/restaurants/1/menu_items', [
            'name' => 'Nasi Goreng Pedas',
            'price' => '30000',
            'category' => 'main'
        ]);

        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
            $json->where('success', true)
            ->etc()
        );
    }
}
