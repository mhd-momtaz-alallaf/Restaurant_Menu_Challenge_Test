<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'category_id',
        'user_id',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // the polymorphic relation to handle discounts.
    public function discounts(): MorphMany
    {
        return $this->morphMany(Discount::class, 'discountable');
    }

    // the helper methods -------------------------------------------------
    public function getClosestDiscount()
    {
        if ($this->discount) {
            return $this->discount->discount_value;
        }

        return $this->category->getClosestDiscount();
    }
}
