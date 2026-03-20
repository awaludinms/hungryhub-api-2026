<?php

namespace App\Utilities\Restaurant;

use App\Http\Resources\RestaurantResource;
use App\Models\Restaurant;


class RestaurantList
{
    public function list()
    {
        return new RestaurantResource(Restaurant::paginate(10));
    }
}
