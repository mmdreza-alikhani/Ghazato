<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

/**
 * @method static latest()
 * @method static create(array $array)
 * @method static where(string $string, string $string1, string $string2)
 */
class Ingredient extends Model
{
    use HasFactory;
    protected $table = "ingredients";
    protected $guarded = [];

    protected static function boot(): void
    {
        parent::boot();

        static::deleting(function ($ingredient) {
            FoodIngredient::where('ingredient_id', $ingredient->id)->delete();
        });
    }
}
