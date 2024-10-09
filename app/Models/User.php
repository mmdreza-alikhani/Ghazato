<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @method static latest()
 * @method static create(array $array)
 * @method static where(string $string, string $string1, string $string2)
 * @method static status()
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $guarded = [];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function scopeStatus($query): void
    {
        $query->where('status', 1);
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
        }
        return $status;
    }
    public function rates(): HasMany
    {
        return $this->hasMany(FoodRate::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->orderBy('status', 'desc');
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(UserAddress::class);
    }

    public function bookmarkedFoods(): BelongsToMany
    {
        return $this->belongsToMany(Food::class, 'bookmarks')->where('deleted_at', null);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
