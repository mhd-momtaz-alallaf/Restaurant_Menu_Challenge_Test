<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\AutoFixDiscountService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $autoFixDiscountService;

    public function __construct(AutoFixDiscountService $autoFixDiscountService)
    {
        $this->autoFixDiscountService = $autoFixDiscountService;
    }

    public function finalizeMenu(Request $request)
    {
        $this->autoFixDiscountService->applyClosestDiscounts($request->user()->id);
        return response()->json([
            'message' => 'Menu finalized and discounts applied!',
        ], 200);
    }

    public function index(Request $request)
    {
        $categories = Category::ofUser($request->user()->id)
            ->with(['children', 'items.discounts', 'discounts']) // Load relationships recursively
            ->get();

        return response()->json($categories);
    }
}
