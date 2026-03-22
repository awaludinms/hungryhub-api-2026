<?php

namespace App\Utilities\Restaurant;

use App\Http\Resources\RestaurantResource;
use App\Models\Restaurant;
use App\Traits\CommonResponse;


class RestaurantDetail
{
    use CommonResponse;
    public function detail($id)
    {
        if (Restaurant::where('id', $id)->exists()) {
            return new RestaurantResource(Restaurant::with('menuItem')->where('id', $id)->get());
        } else {
            return $this->page404("Id=$id is not Valid Restaurant Id");
        }
    }
}
