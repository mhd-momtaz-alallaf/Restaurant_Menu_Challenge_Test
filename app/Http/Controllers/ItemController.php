<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function store(ItemRequest $request)
    {
        $category = Category::find($request->category_id);

        // ensuring no mixed children.
        if ($category->hasSubcategories()) {
            return response()->json([
                'message' => 'Cannot add items on the same level of subcategories!'
            ], 422);
        }

        $item = Item::create([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id
        ]);

        return response()->json([
            'message' => 'Item created successfully!',
            'data' => $item,
        ], 201);
    }
}
