<?php

namespace App\Http\Controllers;

use App\Http\Requests\Restaurant\RestaurantAddMenuRequest;
use App\Http\Requests\Restaurant\RestaurantStoreRequest;
use App\Http\Requests\Restaurant\RestaurantUpdateRequest;

use App\Utilities\Restaurant\RestaurantAddMenuItem;
use App\Utilities\Restaurant\RestaurantDelete;
use App\Utilities\Restaurant\RestaurantDetail;
use App\Utilities\Restaurant\RestaurantMenuItemList;
use App\Utilities\Restaurant\RestaurantUpdate;
use App\Utilities\RestaurantUtility;
use App\Utilities\Restaurant\RestaurantList;
use App\Utilities\Restaurant\RestaurantStore;

use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param RestaurantUtility $utility
     * @param RestaurantList $restaurants
     * @return \App\Http\Resources\RestaurantResource
     */
    public function index(RestaurantUtility $utility, RestaurantList $restaurants)
    {
        //
        return $utility->list($restaurants);

    }

    /**
     * Store a newly created resource in storage.
     * @param RestaurantUtility $utility
     * @param RestaurantStore $restaurants
     * @param RestaurantStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RestaurantUtility $utility, RestaurantStore $restaurants, RestaurantStoreRequest $request)
    {
        return $utility->store($restaurants, $request);
    }

    /**
     * Display the specified restaurant data with related menu item
     * @param RestaurantUtility $utility
     * @param RestaurantDetail $restaurants
     * @param int $restaurant
     * @return \App\Http\Resources\RestaurantResource|\Illuminate\Http\JsonResponse
     */
    public function show(RestaurantUtility $utility, RestaurantDetail $restaurants, int $restaurant)
    {
        //
        return $utility->detail($restaurants, $restaurant);
    }

    /**
     * Update the specified resource in storage.
     * @param RestaurantUtility $utility
     * @param RestaurantUpdate $restaurants
     * @param RestaurantUpdateRequest $request
     * @param int $restaurant
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RestaurantUtility $utility, RestaurantUpdate $restaurants, RestaurantUpdateRequest $request, int $restaurant)
    {
        return $utility->update($restaurants, $request, $restaurant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RestaurantUtility $utility, RestaurantDelete $restaurants, int $restaurant)
    {
        return $utility->destroy($restaurants, $restaurant);
    }

    /**
     * Summary of menu_item
     * @param RestaurantUtility $utility
     * @param RestaurantAddMenuItem $restaurants
     * @param RestaurantAddMenuRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function menu_item(RestaurantUtility $utility, RestaurantAddMenuItem $restaurants, RestaurantAddMenuRequest $request, int $id)
    {
        return $utility->add_menu($restaurants, $request, $id);
    }

    /**
     *
     * List Menu Item
     * @param RestaurantUtility $utility
     * @param RestaurantMenuItemList $restaurants
     * @param int $id
     * @return \App\Http\Resources\RestaurantResource|\Illuminate\Http\JsonResponse
     */
    public function menu_item_list(RestaurantUtility $utility, RestaurantMenuItemList $restaurants, Request $request, int $id)
    {
        return $utility->menu_list_item($restaurants, $request, $id);
    }
}
