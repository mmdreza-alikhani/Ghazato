<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static where(string $string, int|string|null $id)
 * @method static user($id)
 */
class Bookmark extends Model
{
    use HasFactory;
    protected $table = "bookmarks";
    protected $guarded = [];

    public function scopeUser($query, $user_id): void
    {
        $query->where('user_id', $user_id);
    }

    public function food(): BelongsTo
    {
        return $this->belongsTo(Food::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
