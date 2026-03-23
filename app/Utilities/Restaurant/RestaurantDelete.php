<?php

namespace App\Utilities\Restaurant;

use App\Models\Restaurant;
use App\Traits\CommonResponse;

class RestaurantDelete
{
    use CommonResponse;
    /**
     * Create a new class instance.
     */
    public function destroy($id)
    {
        //
        try {
            if (Restaurant::where('id', $id)->exists()) {
                Restaurant::find($id)->delete();
                return $this->success("Restaurant is successfully removed", [], $id);
            } else {
                return $this->page404("Id=$id is not valid Restaurant");
            }
        } catch (\Exception $e) {
            return $this->failed("Failed to remove restaurant id=$id", $e);

        }
    }
}
