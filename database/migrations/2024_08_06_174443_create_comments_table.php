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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('food_id')->nullable();
            $table->foreign('food_id')->references('id')->on('foods')->onDelete('cascade');
            $table->unsignedInteger('reply_of')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->text('reason_for_rejection')->nullable();
            $table->foreignId('rejected_by')->nullable();
            $table->foreign('rejected_by')->references('id')->on('users')->onDelete('cascade');
            $table->text('text');
            $table->timestamps();
            $table->SoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
