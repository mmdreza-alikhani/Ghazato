<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;

/**
 * @method static create(array $array)
 * @method static where(string $string, string $string1, string $string2)
 * @method static latest()
 * @method static status()
 * @method static orderBy(string $string, string $string1)
 */
class Shop extends Model
{
    use HasFactory, sluggable, SoftDeletes;

    protected $table = "shops";
    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function scopeStatus($query): void
    {
        $query->where('status', 1);
    }

    protected static function boot(): void
    {
        parent::boot();

        static::updating(function ($shop) {
            $shop->slug = SlugService::createSlug($shop, 'slug', $shop->title);
        });

        static::deleting(function ($shop) {
            File::delete(public_path('/uploads/shops/images/'. $shop->primary_image));
            foreach ($shop->foods as $food) {
                $food->delete();
            }
        });
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


    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->where('status', 1);
    }

    public function foods(): HasMany
    {
        return $this->hasMany(Food::class)->where('status', 1);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function coupons(): HasMany
    {
        return $this->hasMany(Coupon::class);
    }

    public function checkUserBookmark($userId): bool
    {
        return $this->hasMany(Bookmark::class)->where('user_id', $userId)->exists();
    }
}
