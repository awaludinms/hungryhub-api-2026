<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuItem\MenuItemUpdateRequest;
use App\Utilities\MenuItem\MenuItemDelete;
use App\Utilities\MenuItem\MenuItemUpdate;
use App\Utilities\MenuItemUtility;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    /**
     *
     * Update Menu Item
     * @param MenuItemUtility $utility
     * @param MenuItemUpdate $menu_items
     * @param MenuItemUpdateRequest $request
     * @param int $menu_item
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(MenuItemUtility $utility, MenuItemUpdate $menu_items, MenuItemUpdateRequest $request, int $menu_item)
    {
        return $utility->update($menu_items, $request, $menu_item);
    }

    public function destroy(MenuItemUtility $utility, MenuItemDelete $menu_items, int $menu_item)
    {
        return $utility->destroy($menu_items, $menu_item);
    }
}
