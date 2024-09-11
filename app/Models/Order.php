<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static latest()
 * @method static where(string $string, string $string1, string $string2)
 */
class Order extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $guarded = [];

    public function address(): BelongsTo
    {
        return $this->belongsTo(UserAddress::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class);
    }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatusAttribute($status): string
    {
        return $status ? 'پرداخت شده' : 'پرداخت نشده';
    }

    public function getPaymentTypeAttribute($payment_type): string
    {
        switch ($payment_type){
            case 'online' :
                $payment_type = 'انلاین';
                break;
            case 'cash' :
                $payment_type = 'نقد';
                break;
        }
        return $payment_type;
    }
}
