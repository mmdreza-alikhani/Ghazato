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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->foreignId('table_id');
            $table->foreign('table_id')->references('id')->on('tables')->onDelete('cascade');
            $table->foreignId('ceremony_id');
            $table->foreign('ceremony_id')->references('id')->on('ceremonies')->onDelete('cascade');
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('phone_number');
            $table->text('description')->nullable();
            $table->unsignedInteger('paying_price');
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
