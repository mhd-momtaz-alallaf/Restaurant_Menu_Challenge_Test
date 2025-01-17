<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->decimal('discount_value', 5, 2);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->morphs('discountable');

            // Adding a unique constraint on discountable_type and discountable_id together.
            $table->unique(['discountable_type', 'discountable_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
