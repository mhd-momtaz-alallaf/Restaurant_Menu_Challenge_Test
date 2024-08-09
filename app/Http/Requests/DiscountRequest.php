<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DiscountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'discount_value' => 'required|numeric|min:0|max:100',
            'user_id' => 'required|exists:users,id',
            'discountable_type' => [
                'required',
                'string',
                Rule::in([Category::class, Item::class]),
            ],
            'discountable_id' => [
                'required',
                'integer',
                // ensuring the combination of discountable_type and discountable_id is unique.
                Rule::unique('discounts')->where(function ($query) {
                    return $query->where('discountable_type', $this->discountable_type)
                                ->where('discountable_id', $this->discountable_id);
                }),
            ],
        ];
    }
}
