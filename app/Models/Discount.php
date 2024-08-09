<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'discount_value',
        'user_id',
        'discountable_id',
        'discountable_type'
    ];

    public function discountable(): MorphTo
    {
        return $this->morphTo();
    }
}
