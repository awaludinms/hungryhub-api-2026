<?php

use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('restaurants', RestaurantController::class)->except(['create','edit']);
Route::post('restaurants/{restaurant}/menu_items', [RestaurantController::class, 'menu_item']);
Route::get('restaurants/{restaurant}/menu_items', [RestaurantController::class, 'menu_item_list']);

Route::put('menu_items/{menu_item}', [MenuItemController::class, 'update']);
Route::delete('menu_items/{menu_item}', [MenuItemController::class, 'destroy']);