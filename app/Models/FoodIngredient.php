<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, $id)
 */
class FoodIngredient extends Model
{
    use HasFactory;
    protected $table = "food_ingredient";
    protected $guarded = [];
}
