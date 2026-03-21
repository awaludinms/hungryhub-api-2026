<?php

namespace App\Http\Controllers;

use App\Http\Requests\Restaurant\RestaurantStoreRequest;
use App\Http\Requests\Restaurant\RestaurantUpdateRequest;

use App\Utilities\Restaurant\RestaurantAddMenuItem;
use App\Utilities\Restaurant\RestaurantDetail;
use App\Utilities\Restaurant\RestaurantUpdate;
use App\Utilities\RestaurantUtility;
use App\Utilities\Restaurant\RestaurantList;
use App\Utilities\Restaurant\RestaurantStore;

use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RestaurantUtility $utility, RestaurantList $restaurants)
    {
        //
        return $utility->list($restaurants);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RestaurantUtility $utility, RestaurantStore $restaurants, RestaurantStoreRequest $request)
    {
        return $utility->store($restaurants, $request);
    }

    /**
     * Display the specified resource.
     */
    public function show(RestaurantUtility $utility, RestaurantDetail $restaurants, int $restaurant)
    {
        //
        return $utility->detail($restaurants, $restaurant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RestaurantUtility $utility, RestaurantUpdate $restaurants, RestaurantUpdateRequest $request, int $restaurant)
    {
        return $utility->update($restaurants, $request, $restaurant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
    }

    /**
     * Add restaurant menu item
     * @param int $id
     * @return void
     */
    public function menu_item(RestaurantUtility $utility, RestaurantAddMenuItem $restaurants, Request $request, int $id)
    {
        // TODO: Add restaurant menu Item
        return $utility->addMenu($restaurants, $request, $id);
    }

    /**
     * List Menu Item
     * @param int $id
     * @return void
     */
    public function menu_item_list(int $id)
    {
        // TODO: List Menu Item support filter by category
    }
}
