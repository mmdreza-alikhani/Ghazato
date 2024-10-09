<?php

namespace Modules\Api\V1\Coupon\app\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @method getRawOriginal(string $string)
 */
class CouponResource extends JsonResource
{
    public static $wrap = 'coupon';
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
            'code' => $this->code,
            'shop_id' => $this->shop_id,
            'type' => $this->type,
            'status' => $this->getRawOriginal('status'),
            'amount' => $this->amount,
            'percentage' => $this->percentage,
            'max_percentage_amount' => $this->tmax_percentage_amountype,
            'description' => $this->description,
            'expired_at' => $this->expired_at->format('Y-m-d H:i:s'),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
