<?php

namespace App\Utilities\MenuItem;

use App\Models\MenuItem;
use App\Traits\CommonResponse;

class MenuItemUpdate
{
    use CommonResponse;
    /**
     * Create a new class instance.
     */
    public function update($request, $id)
    {
        $validated = $request->validated();
        $validated['updated_at'] = date('Y-m-d');

        try {
            if (MenuItem::where('id', $id)->exists()) {
                MenuItem::where('id', $id)
                    ->update($validated);

                return $this->success('Menu Item success update', $validated, $id);
            } else {
                return $this->page404("Menu Item ID=$id is not exists");
            }
        } catch (\Exception $e) {
            return $this->failed('Menu Item fail to update', $e, $validated);
        }
    }
}
