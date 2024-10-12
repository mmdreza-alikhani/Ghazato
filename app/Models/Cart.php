<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;

    protected $table = "carts";
    protected $guarded = [];

    public function items(): HasMany
    {
        return $this->hasMany(CartItems::class);
    }

}
