<?php

namespace Modules\Api\V1\Banner\app\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @method getRawOriginal(string $string)
 */
class BannerResource extends JsonResource
{
    public static $wrap = 'banner';
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
            'text' => $this->text,
            'status' => $this->getRawOriginal('status'),
            'type' => $this->type,
            'button_text' => $this->button_text,
            'button_link' => $this->button_link,
            'button_icon' => $this->button_icon,
            'priority' => $this->priority,
            'image' => $this->image,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
