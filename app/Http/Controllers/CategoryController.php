<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::ofUser($request->user()->id)
            ->with(['children', 'items']) // Load relationships recursively
            ->get();

        return response()->json($categories);
    }

    public function store(CategoryRequest $request)
    {
        $parent = Category::find($request->parent_id);

        if ($parent) {
            // ensuring the maximum level 4 is not exceeded.
            if ($parent->level() >= 3) { // 3 because the current category will be level 4
                return response()->json([
                    'message' => 'Maximum subcategory level of 4 exceeded!'
                ], 422);
            }

            // ensuring no mixed children.
            if ($parent->hasItems()) {
                return response()->json([
                    'message' => 'Cannot add subcategory or item to a category with mixed children!'
                ], 422);
            }
        }

        $category = Category::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'user_id' => $request->user_id
        ]);

        return response()->json([
            'message' => $request->parent_id ? 'Subcategory created successfully!' : 'Category created successfully!',
            'data' => $category,
        ], 201);
    }
}
