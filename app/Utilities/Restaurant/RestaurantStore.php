<?php

namespace App\Utilities\Restaurant;

use App\Http\Resources\FailedResource;
use App\Http\Resources\SuccessResource;
use App\Models\Restaurant;
use App\Traits\CommonResponse;

class RestaurantStore
{
    use CommonResponse;
    /**
     * Create a new class instance.
     */
    public function store($request)
    {
        //
        $validated = $request->validated();
        $validated['created_at'] = date('Y-m-d');

        try {
            $id = Restaurant::insertGetId($validated);

            return $this->success('Restaurant success saved', $validated, $id);

        } catch (\Exception $e) {
            return $this->failed('Restaurant fail to save', $e, $validated);
        }
    }
}
