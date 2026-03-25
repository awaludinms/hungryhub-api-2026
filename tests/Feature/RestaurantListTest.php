<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class RestaurantListTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_restaurant_list(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->getJson("/restaurants");
        $response->assertStatus(200);
    }

    public function test_restaurant_check_data_and_pagging_structure(): void
    {
        $this->seed();

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->getJson("/restaurants");

        $response
            ->assertJson(fn (AssertableJson $json) =>
                $json->has('data', 2)
                    ->has('data.0', fn (AssertableJson $json) =>
                    $json->where('id', 1)
                        ->where('name', 'Restoran Nasi Padang')
                        ->etc()
                    )
                    ->has('data.1', fn (AssertableJson $json) =>
                    $json->where('id', 2)
                        ->where('name', 'Mie Ayam Bakso Pak Awal')
                        ->etc()
                    )
                ->has('current_page')
                ->has('first_page_url')
                ->has('from')
                ->has('last_page')
                ->has('last_page_url')
                ->has('links')
                ->has('next_page_url')
                ->has('path')
                ->has('per_page')
                ->has('prev_page_url')
                ->has('to')
                ->has('total')
            );
    }

}
