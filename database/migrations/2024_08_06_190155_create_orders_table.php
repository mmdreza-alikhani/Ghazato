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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('address_id');
            $table->foreign('address_id')->references('id')->on('user_addresses')->onDelete('cascade');
            $table->foreignId('shop_id');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->foreignId('coupon_id');
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');
            $table->tinyInteger('status')->default(0);
            $table->unsignedInteger('total_amount');
            $table->unsignedInteger('delivery_amount');
            $table->unsignedInteger('coupon_amount')->default(0);
            $table->unsignedInteger('paying_amount');
            $table->enum('payment_type' , ['cash' , 'online']);
            $table->tinyInteger('payment_status')->default(0);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->SoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
