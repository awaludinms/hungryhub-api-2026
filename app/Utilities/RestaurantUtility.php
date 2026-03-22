<?php

namespace App\Utilities;

use App\Utilities\Restaurant\RestaurantAddMenuItem;
use App\Utilities\Restaurant\RestaurantDetail;
use App\Utilities\Restaurant\RestaurantList;
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

    /**
     * Add Menu in restaurant
     *
     * @param mixed $restaurants
     * @param mixed $id
     */
    public function addMenu(RestaurantAddMenuItem $restaurants, $request, $id)
    {
        //
        return($restaurants->addMenu($request, $id));
    }
}
