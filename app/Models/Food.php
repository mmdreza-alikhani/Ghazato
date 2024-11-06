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
 * @method static whereHas(string $string, \Closure $param)
 * @method static find(mixed $category)
 * @method static findOrFail($food_id)
 * @method static active()
 */
class Food extends Model
{
    use HasFactory, sluggable, SoftDeletes;

    protected $table = "foods";
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

        static::updating(function ($food) {
            $food->slug = SlugService::createSlug($food, 'slug', $food->title . '-' . $food->shop->title);
        });
        static::creating(function ($food) {
            $food->slug = SlugService::createSlug($food, 'slug', $food->title . '-' . $food->shop->title);
        });
        static::forceDeleting(function ($food) {
            File::delete(storage_path('/foods/images/'. $food->primary_image));
            foreach ($food->images as $image) {
                FoodImage::destroy($image->id);
                File::delete(storage_path('/foods/images/'. $image->image));
            }
        });
    }

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class, 'food_ingredient');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
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

    public function getVeganAttribute($is_vegan): string
    {
        return $is_vegan ? 'بله' : 'خیر';
    }

    public function is_discounted(): bool
    {
        if ($this->discounted_quantity > '0' && $this->discounted_price != null && $this->date_on_sale_from < Carbon::now() && $this->date_on_sale_to > Carbon::now()){
            return true;
        }else{
            return false;
        }
    }

    public function images(): HasMany
    {
        return $this->hasMany(FoodImage::class);
    }

    public function rates(): HasMany
    {
        return $this->hasMany(FoodRate::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->where('status', 1);
    }

    public function checkUserBookmark($userId): bool
    {
        return $this->hasMany(Bookmark::class)->where('user_id', $userId)->exists();
    }
}
