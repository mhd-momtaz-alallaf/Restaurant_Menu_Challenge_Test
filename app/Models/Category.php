<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
        'user_id',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    // the polymorphic relation to handle discounts.
    public function discounts(): MorphMany
    {
        return $this->morphMany(Discount::class, 'discountable');
    }

    // the helper methods -------------------------------------------------
    public function hasSubcategories()
    {
        return $this->children()->exists();
    }

    public function hasItems()
    {
        return $this->items()->exists();
    }

    public function level()
    {
        $level = 0;
        $parent = $this->parent;
        while ($parent) {
            $level++;
            $parent = $parent->parent;
        }
        return $level;
    }

    public function getClosestDiscount()
    {
        if ($this->discount) {
            return $this->discount->discount_value;
        }

        if ($this->parent) {
            return $this->parent->getClosestDiscount();
        }

        return null;
    }
}
