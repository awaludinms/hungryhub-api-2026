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

        $validated['phone'] = $request->has('phone') ? $validated['phone'] : '';
        $validated['opening_hours'] = $request->has('opening_hours') ? $validated['opening_hours'] : '';
        $validated['created_at'] = date('Y-m-d');

        try {
            Restaurant::where('id', $id)
                ->update($validated);

            return $this->success('Restaurant success update', $validated);

        } catch (\Exception $e) {
            return $this->failed('Restaurant fail to update', $e, $validated);
        }
    }
}
