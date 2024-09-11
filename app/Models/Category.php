<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static latest()
 * @method static where(string $string, int $int)
 * @method static create(array $array)
 * @method static status()
 * @method static orderBy(string $string, string $string1)
 * @method static find(mixed $category)
 */
class Category extends Model
{
    use HasFactory , sluggable, SoftDeletes;
    protected $table = "categories";
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

        static::updating(function ($category) {
            $category->slug = SlugService::createSlug($category, 'slug', $category->title);
        });

        static::creating(function ($category) {
            $category->slug = SlugService::createSlug($category, 'slug', $category->title);
        });

        static::deleting(function ($category) {
            foreach ($category->foods as $food){
                $food->delete();
            }
        });
    }

    public function getStatusAttribute($status): string
    {
        return $status ? 'فعال' : 'غیرفعال';
    }

    public function foods(): HasMany
    {
        return $this->hasMany(Food::class);
    }
}
