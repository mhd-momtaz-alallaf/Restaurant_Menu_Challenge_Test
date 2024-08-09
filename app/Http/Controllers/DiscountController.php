<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscountRequest;
use App\Models\Discount;

class DiscountController extends Controller
{
    public function store(DiscountRequest $request)
    {
        $discount = Discount::create($request->all());

        return response()->json([
            'message' => 'Discount created successfully!',
            'data' => $discount,
        ], 201);
    }
}
