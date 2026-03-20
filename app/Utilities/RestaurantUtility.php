<?php

namespace App\Utilities;

class RestaurantUtility
{
    /**
     * Create a new class instance.
     */
    public function list($restaurant)
    {
        //
        return($restaurant->list());
    }

    public function store($restaurant, $request)
    {
        //
        return($restaurant->store($request));
    }
}
