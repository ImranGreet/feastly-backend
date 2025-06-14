<?php
namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Support\Facades\Request;

class MenuItemController extends Controller
{
    public function getMenuItems()
    {
        $menuItems = MenuItem::all();

        if (! $menuItems) {
            return response()->json([
                "message" => "Menu Items Not Found",
            ]);
        }

        return response()->json([
            'message'   => 'Menu Items Found',
            'menuItems' => $menuItems,
        ]);
    }

    public function createMenuItem(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
            'price'       => 'float',
            'category'    => 'string|string|max:255',

        ]);
    }

    public function getSpecificMenuItem($id)
    {
        $menuItem = MenuItem::find($id);

        if (! $menuItem) {
            return response()->json([
                'message' => 'Menu Item not found',
            ]);
        }
        return response()->json([
            'message'   => 'Menu Item Found',
            'menu Item' => $menuItem,
        ]);
    }

    public function updateMenuItem($id)
    {
        $menuItem = MenuItem::find($id);

        if (! $menuItem) {
            return response()->json([
                'message' => 'Menu Item not found',
            ]);
        }
    }

    public function deleteMenu($id)
    {
        $menuItem = MenuItem::find($id);

        if (! $menuItem) {
            return response()->json([
                'message' => 'Menu Item not found',
            ]);
        }
        $menuItem->delete();
        return response()->json([
            "message" => 'Menu Item deleted successfully',
        ]);

    }

    

}
