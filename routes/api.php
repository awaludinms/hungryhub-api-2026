<?php

use App\Http\Controllers\RestaurantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::resource('restaurants', RestaurantController::class)->except(['create','edit']);
Route::post('restaurants/{restaurant}/menu_items', [RestaurantController::class, 'menu_item']);
Route::get('restaurants/{restaurant}/menu_items', [RestaurantController::class, 'menu_item_list']);