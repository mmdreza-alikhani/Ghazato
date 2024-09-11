<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(array $array)
 * @method static where(string $string, string $string1, int $int)
 * @method static latest()
 * @method static undecided()
 */
class Comment extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "comments";
    protected $guarded = [];

    public function scopeUndecided($query): void
    {
        $query->where('status', 0);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function food(): BelongsTo
    {
        return $this->belongsTo(Food::class);
    }

    public function rates(): BelongsTo
    {
        return $this->belongsTo(FoodRate::class);
    }

    public function getStatusAttribute($status): string
    {
        switch ($status){
            case '0' :
                $status = 'تعلبق';
                break;
            case '1' :
                $status = 'فعال';
                break;
            case '2' :
                $status = 'رد شده';
                break;
        }
        return $status;
    }

    public function getIsReplyAttribute($is_reply): string
    {
        switch ($is_reply){
            case '0' :
                $is_reply = 'خیر';
                break;
            default:
                $is_reply = 'بله';
                break;
        }
        return $is_reply;
    }

    public function replyOf(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'replyOf');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'reply_of')->where('status', '1');
    }

}
