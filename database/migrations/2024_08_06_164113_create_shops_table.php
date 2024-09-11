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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('user_id');
            $table->string('address');
            $table->string('telephone');
            $table->string('telephone2');
            $table->string('primary_image');
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
            $table->foreignId('province_id');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreignId('city_id');
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->text('description');
            $table->string('type');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->SoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
