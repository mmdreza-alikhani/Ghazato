<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class FoodImage extends Model
{
    use HasFactory;
    protected $table = "food_image";
    protected $guarded = [];
}
