<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(CategoryRequest $request)
    {
        $parent = Category::find($request['parent_id']);
        $level = $parent ? $parent->level + 1 : 1;

        Category::create([
            'name' => $request['name'],
            'parent_id' => $request['parent_id'],
            'level' => $level,
        ]);

        return response()->json([
            'message' => 'Category created successfully'
        ], 201);
    }
}
