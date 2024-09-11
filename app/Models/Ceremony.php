<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static status()
 * @method static latest()
 * @method static where(string $string, string $string1, string $string2)
 * @method static create(array $array)
 */
class Ceremony extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "ceremonies";
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
}
