<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Item;

class AutoFixDiscountService
{
    public function applyClosestDiscounts($userId)
    {
        // Apply discounts to items first (leaf nodes)
        $items = Item::where('user_id', $userId)->get();
        foreach ($items as $item) {
            if (!$item->discounts) {
                $closestDiscount = $item->getClosestDiscount();
                if ($closestDiscount !== null) {
                    $item->discounts()->create([
                        'discount_value' => $closestDiscount,
                        'user_id' => $userId,
                        'discountable_type' => Item::class,
                        'discountable_id' => $item->id,
                    ]);
                }
            }
        }

        // Apply discounts to categories (subcategories)
        $categories = Category::where('user_id', $userId)->get();
        foreach ($categories as $category) {
            if (!$category->discounts) {
                $closestDiscount = $category->getClosestDiscount();
                if ($closestDiscount !== null) {
                    $category->discounts()->create([
                        'discount_value' => $closestDiscount,
                        'user_id' => $userId,
                        'discountable_type' => Category::class,
                        'discountable_id' => $category->id,
                    ]);
                }
            }
        }
    }
}
