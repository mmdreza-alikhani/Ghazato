<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(array $array)
 * @method static unanswered()
 * @method static where(string $string, string $string1, string $string2)
 */
class Feedback extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "feedback";
    protected $guarded = [];

    public function scopeUnanswered($query): void
    {
        $query->where('response', '=', null)->where('admin_id', '=', null);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
