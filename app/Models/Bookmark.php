<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bookmark extends Model
{
    use HasFactory;
    protected $table = "bookmark";
    protected $guarded = [];

    public function food(): BelongsTo
    {
        return $this->belongsTo(Food::class);
    }
}
