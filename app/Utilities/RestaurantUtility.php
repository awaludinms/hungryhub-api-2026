<?php

namespace App\Utilities;

use App\Utilities\Restaurant\RestaurantAddMenuItem;
use App\Utilities\Restaurant\RestaurantDelete;
use App\Utilities\Restaurant\RestaurantDetail;
use App\Utilities\Restaurant\RestaurantList;
use App\Utilities\Restaurant\RestaurantMenuItemList;
use App\Utilities\Restaurant\RestaurantStore;
use App\Utilities\Restaurant\RestaurantUpdate;

class RestaurantUtility
{
    /**
     * Create a new class instance.
     */
    public function list(RestaurantList $restaurants)
    {
        //
        return($restaurants->list());
    }

    public function store(RestaurantStore $restaurants, $request)
    {
        //
        return($restaurants->store($request));
    }

    public function update(RestaurantUpdate $restaurants, $request, $id)
    {
        //
        return($restaurants->update($request, $id));
    }

    public function detail(RestaurantDetail $restaurants, $id)
    {
        //
        return($restaurants->detail($id));
    }

    public function destroy(RestaurantDelete $restaurants, $id)
    {
        return ($restaurants->destroy($id));
    }

    /**
     * Add Menu in restaurant
     *
     * @param mixed $restaurants
     * @param mixed $id
     */
    public function add_menu(RestaurantAddMenuItem $restaurants, $request, $id)
    {
        //
        return($restaurants->add_menu($request, $id));
    }

    public function menu_list_item(RestaurantMenuItemList $restaurants, $request, $id)
    {
        return $restaurants->menu_item_list($request, $id);
    }
}
