<?php

namespace App\Utilities;

use App\Http\Requests\MenuItem\MenuItemUpdateRequest;
use App\Utilities\MenuItem\MenuItemDelete;
use App\Utilities\MenuItem\MenuItemUpdate;

class MenuItemUtility
{
    /**
     * Create a new class instance.
     */
    public function update(MenuItemUpdate $menu_items, MenuItemUpdateRequest $request, int $id)
    {
        return $menu_items->update($request, $id);
    }

    public function destroy(MenuItemDelete $menu_items, int $id)
    {
        return $menu_items->destroy($id);
    }
}
