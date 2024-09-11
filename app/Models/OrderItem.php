<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "order_items";
    protected $guarded = [];

    public function food(): BelongsTo
    {
        return $this->belongsTo(Food::class);
    }
}
