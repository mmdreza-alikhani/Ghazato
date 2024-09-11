<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static latest()
 * @method static where(string $string, string $string1, string $string2)
 */
class Reservation extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "reservations";
    protected $guarded = [];

    public function scopeStatus($query): void
    {
        $query->where('status', 1);
    }

    public function getStatusAttribute($status): string
    {
        switch ($status){
            case '0' :
                $status = 'غیرفعال';
                break;
            case '1' :
                $status = 'فعال';
                break;
        }
        return $status;
    }

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class);
    }

    public function ceremony(): belongsTo
    {
        return $this->belongsTo(Ceremony::class);
    }
}
