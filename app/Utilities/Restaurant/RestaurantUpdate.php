<?php

namespace App\Utilities\Restaurant;

use App\Http\Resources\FailedResource;
use App\Http\Resources\SuccessResource;
use App\Models\Restaurant;
use App\Traits\CommonResponse;

class RestaurantUpdate
{
    use CommonResponse;
    /**
     * Create a new class instance.
     */
    public function update($request, $id)
    {
        //
        $validated = $request->validated();
        $validated['updated_at'] = date('Y-m-d');

        try {
            if (Restaurant::where('id', $id)->exists()) {
                Restaurant::where('id', $id)
                    ->update($validated);

                return $this->success('Restaurant success update', $validated, $id);
            } else {
                return $this->page404("Restaurant ID=$id is not exists");
            }
        } catch (\Exception $e) {
            return $this->failed('Restaurant fail to update', $e, $validated);
        }
    }
}
