<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static where(string $string, $id)
 * @method static create(array $array)
 */
class Cart extends Model
{
    use HasFactory;

    protected $table = "carts";
    protected $guarded = [];

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function calculateTotalPrice(): float|int
    {
        $totalPrice = 0;

        foreach ($this->items as $item) {
            $totalPrice += $item->price * $item->quantity;
        }

        return $totalPrice;
    }

}
