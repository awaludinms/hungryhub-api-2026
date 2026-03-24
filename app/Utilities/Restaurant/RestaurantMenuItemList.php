<?php

namespace App\Utilities\Restaurant;

use App\Http\Resources\RestaurantResource;
use App\Models\MenuItem;
use App\Models\Restaurant;
use App\Traits\CommonResponse;


class RestaurantMenuItemList
{
    use CommonResponse;
    public function menu_item_list($request, $id)
    {
        if (Restaurant::where('id', $id)->exists()) {
            return new RestaurantResource(MenuItem::where('restaurant_id', $id)
                ->where(function($query) use ($request) {
                    if ($request->has('category')) {
                        $query->whereCategory($request->category);
                    }
                    if ($request->has('name')) {
                        $query->whereLike('name', '%' . $request->name . '%');
                    }
                })
                ->paginate(10));
        } else {
            return $this->page404("Id=$id is not Valid Restaurant Id");
        }
    }
}
