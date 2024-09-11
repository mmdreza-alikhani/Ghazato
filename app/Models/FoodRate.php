<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class FoodRate extends Model
{
    use HasFactory;
    protected $table = "food_rates";
    protected $guarded = [];
}
