<?php

namespace App\Utilities;

class RestaurantUtility
{
    /**
     * Create a new class instance.
     */
    public function list($restaurants)
    {
        //
        return($restaurants->list());
    }

    public function store($restaurants, $request)
    {
        //
        return($restaurants->store($request));
    }

    public function update($restaurants, $request, $id)
    {
        //
        return($restaurants->update($request, $id));
    }

    public function detail($restaurants, $id)
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
    public function addMenu($restaurants, $request, $id)
    {
        //
        return($restaurants->addMenu($request, $id));
    }
}
