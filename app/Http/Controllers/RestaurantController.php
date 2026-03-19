<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestaurantStoreRequest;
use App\Http\Resources\RestaurantResource;
use App\Models\Restaurant;

use App\Utilities\RestaurantUtility;
use App\Utilities\Restaurant\RestaurantList;
use App\Utilities\Restaurant\RestaurantStore;

use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RestaurantUtility $utility, RestaurantList $restaurant)
    {
        //
        return $utility->list($restaurant);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RestaurantUtility $utility, RestaurantStore $restaurant, RestaurantStoreRequest $request)
    {
        return $utility->store($restaurant, $request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Add restaurant menu item
     * @param string $id
     * @return void
     */
    public function menu_item(string $id)
    {
        // TODO: Add restaurant menu Item

    }

    /**
     * List Menu Item
     * @param string $id
     * @return void
     */
    public function menu_item_list(string $id)
    {
        // TODO: List Menu Item support filter by category
    }
}
