<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantAndMenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $restaurant_id = Restaurant::insertGetId([
            'name' => 'Restoran Nasi Padang',
            'address' => 'Jl. Kaliurang Yogyakarta',
            'phone' => '081309290249',
            'opening_hours' => '08:00-16:00 WIB',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        MenuItem::insert([
            'name' => 'Nasi Rendang Sapi Balado',
            'price' => '25000.00',
            'description' => 'Nasi dengan lauk rendang sapi dengan sambal balado khas palembang',
            'category' => 'main',
            'is_available' => true,
            'restaurant_id' => $restaurant_id,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        MenuItem::insert([
            'name' => 'Nasi Kuah Ayam Sayur Sambal Ijo',
            'price' => '15000.00',
            'description' => 'Nasi dengan lauk ayam gulai dengan sambal ijo khas padang',
            'category' => 'main',
            'is_available' => true,
            'restaurant_id' => $restaurant_id,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        MenuItem::insert([
            'name' => 'Nasi Babat Sambal ijo',
            'price' => '23000.00',
            'description' => 'Nasi dengan lauk babat sapi dengan sambal ijo khas padang',
            'category' => 'main',
            'is_available' => true,
            'restaurant_id' => $restaurant_id,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        MenuItem::insert([
            'name' => 'Teh Manis Dingin',
            'price' => '5000.00',
            'description' => 'Es teh dingin segar',
            'category' => 'drink',
            'is_available' => true,
            'restaurant_id' => $restaurant_id,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        MenuItem::insert([
            'name' => 'Es Jeruk Limau',
            'price' => '7000.00',
            'description' => 'Es Jeruk Limau Manis dan Segar',
            'category' => 'drink',
            'is_available' => true,
            'restaurant_id' => $restaurant_id,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $restaurant_id = Restaurant::insertGetId([
            'name' => 'Mie Ayam Bakso Pak Awal',
            'address' => 'Jl. Bantul Yogyakarta',
            'phone' => '0813092909000',
            'opening_hours' => '09:00-21:00 WIB',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        MenuItem::insert([
            'name' => 'Bakso Special Daging',
            'price' => '35000.00',
            'description' => 'Bakso dengan daging Sapi Asli Solo',
            'category' => 'main',
            'is_available' => true,
            'restaurant_id' => $restaurant_id,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        MenuItem::insert([
            'name' => 'Bakso Special Babat',
            'price' => '40000.00',
            'description' => 'Bakso sapi dengan campuran babat',
            'category' => 'main',
            'is_available' => true,
            'restaurant_id' => $restaurant_id,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        MenuItem::insert([
            'name' => 'Mie Ayam pangsit',
            'price' => '23000.00',
            'description' => 'Mie Ayam dengan toping pangsit',
            'category' => 'main',
            'is_available' => true,
            'restaurant_id' => $restaurant_id,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        MenuItem::insert([
            'name' => 'Teh Manis Dingin',
            'price' => '6000.00',
            'description' => 'Es teh dingin segar',
            'category' => 'drink',
            'is_available' => true,
            'restaurant_id' => $restaurant_id,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        MenuItem::insert([
            'name' => 'Es Jeruk Limau',
            'price' => '8000.00',
            'description' => 'Es Jeruk Limau Manis dan Segar',
            'category' => 'drink',
            'is_available' => true,
            'restaurant_id' => $restaurant_id,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }


}
