<?php

namespace App\Utilities\MenuItem;

use App\Models\MenuItem;
use App\Traits\CommonResponse;

class MenuItemDelete
{
    use CommonResponse;
    /**
     * Create a new class instance.
     */
    public function destroy($id)
    {
        //
        try {
            if (MenuItem::where('id', $id)->exists()) {
                MenuItem::find($id)->delete();
                return $this->success("MenuItem is successfully removed", [], $id);
            } else {
                return $this->page404("Id=$id is not valid Menu Item");
            }
        } catch (\Exception $e) {
            return $this->failed("Failed to remove Menu Item id=$id", $e);

        }
    }
}
