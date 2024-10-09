<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;

/**
 * @method static create(array $array)
 * @method static where(string $string, string $string1, string $string2)
 * @method static latest()
 * @method static status()
 * @method static find(mixed $shop)
 */
class Banner extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "banners";
    protected $guarded = [];

    protected static function boot(): void
    {
        parent::boot();

        static::forceDeleting(function ($banner) {
            File::delete(storage_path('/banners/images/'. $banner->image));
        });
    }

    public function scopeStatus($query): void
    {
        $query->where('status', 1);
    }

    public function getStatusAttribute($status): string
    {
        return $status ? 'فعال' : 'غیرفعال';
    }
}
