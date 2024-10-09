<?php

namespace Modules\Api\V1\Category\app\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @method getRawOriginal(string $string)
 * @property mixed $slug
 * @property mixed $title
 * @property mixed $id
 * @property mixed $icon
 * @property mixed $updated_at
 * @property mixed $created_at
 * @property mixed $deleted_at
 */
class CategoryResource extends JsonResource
{
    public static $wrap = 'category';
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'status' => $this->getRawOriginal('status'),
            'icon' => $this->icon,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
