<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function categories()
    {
        $categories = Category::all();
        return response()->json([
            "message"    => "Categories are found",
            "categories" => $categories,
        ]);
    }

    public function createCategory(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        $category = Category::create($validated);

        return response()->json([
            "message"  => "Category created successfully",
            "category" => $category,
        ], 201);
    }

    public function getCategory($id)
    {
        $category = Category::find($id);

        if (! $category) {
            return response()->json(["message" => "Category not found"], 404);
        }

        return response()->json([
            "message"  => "Category found",
            "category" => $category,
        ]);
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::find($id);

        if (! $category) {
            return response()->json(["message" => "Category not found"], 404);
        }

        $validated = $request->validate([
            'name'        => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return response()->json([
            "message"  => "Category updated successfully",
            "category" => $category,
        ]);
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);

        if (! $category) {
            return response()->json(["message" => "Category not found"], 404);
        }

        $category->delete();

        return response()->json([
            "message" => "Category deleted successfully",
        ]);
    }
}
