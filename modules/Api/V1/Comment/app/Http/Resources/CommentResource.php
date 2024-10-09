<?php

namespace Modules\Api\V1\Comment\app\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @method getRawOriginal(string $string)
 */
class CommentResource extends JsonResource
{
    public static $wrap = 'comment';
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
            'user_id' => $this->user_id,
            'food_id' => $this->food_id,
            'reply_of' => $this->reply_of,
            'status' => $this->getRawOriginal('status'),
            'reason_for_rejection' => $this->reason_for_rejection,
            'rejected_by' => $this->rejected_by,
            'text' => $this->text,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
