<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static status()
 * @method static where(string $string, mixed $province_id)
 * @method static create(array $array)
 * @method static latest()
 * @method static whereDoesntHave(string $string, \Closure $param)
 * @method static find(mixed $coupon)
 */
class Table extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "tables";
    protected $guarded = [];

    public function scopeStatus($query): void
    {
        $query->where('status', 1);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
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
}
