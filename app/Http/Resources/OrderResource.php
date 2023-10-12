<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use function Symfony\Component\Translation\t;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'order_id' => $this->unique_id,
            'order_data' => [
                'status' => $this->status,
                'total_price' => $this->orderProduct->sum('sub_price'),
                'date' => $this->created_at->format('d M Y'),
            ],
        ];
    }
}
