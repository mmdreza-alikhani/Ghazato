<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(array $array)
 * @method static latest()
 */
class Coupon extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "coupons";
    protected $guarded = [];

    public function getTypeAttribute($type): string
    {
        return $type == 'amount' ? 'مبلغی' : 'درصدی';
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
            case '2' :
                $status = 'منقضی';
                break;
        }
        return $status;
    }

}
