<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static where(string $string, mixed $province_id)
 */
class City extends Model
{
    use HasFactory;
    protected $table = "cities";
    protected $guarded = [];
}
