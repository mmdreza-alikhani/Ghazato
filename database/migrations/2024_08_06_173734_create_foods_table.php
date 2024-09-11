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
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignId('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreignId('shop_id');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->unsignedInteger('price');
            $table->string('sku');
            $table->unsignedInteger('discounted_price')->nullable();
            $table->Integer('discounted_quantity')->nullable();
            $table->timestamp('date_on_sale_from')->nullable();
            $table->timestamp('date_on_sale_to')->nullable();
            $table->string('primary_image');
            $table->text('description');
            $table->tinyInteger('status')->default(1);
            $table->boolean('is_vegan');
            $table->timestamps();
            $table->SoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods');
    }
};
