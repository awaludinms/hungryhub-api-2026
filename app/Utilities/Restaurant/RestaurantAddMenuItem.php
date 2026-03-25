<?php

namespace App\Utilities\Restaurant;

use App\Http\Resources\FailedResource;
use App\Http\Resources\SuccessResource;
use App\Models\MenuItem;
use App\Models\Restaurant;
use App\Traits\CommonResponse;

class RestaurantAddMenuItem
{
    use CommonResponse;
    /**
     * Create a new class instance.
     */
    public function add_menu($request, $id)
    {
        $validated = $request->validated();
        $validated['created_at'] = date('Y-m-d');

        if (Restaurant::where('id', $id)->exists()) {
            $validated['restaurant_id'] = $id;
            $validated['is_available'] = isset($validated['is_available']) ? $validated['is_available'] : 1;

            try {
                $id = MenuItem::insertGetId($validated);

                return $this->success('Menu Item success saved', $validated, $id);

            } catch (\Exception $e) {
                return $this->failed('Menu Item fail to save', $e, $validated);
            }

        } else {
            return $this->page404("Resaurant Id=$id is not exists.");
        }
    }
}
