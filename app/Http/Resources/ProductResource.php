<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ProductResource extends JsonResource
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
            'id'   => $this->id,
            'name' => $this->name,
            'price'=> $this->price,
            'stock'=> $this->stock,
            'size' => $this->size,
            'detail'=> Str::limit($this->detail,100),
            'category_name' => $this->Category->name,
            'brand_name' => $this->Brand->name,
            'brand_id' => $this->brand_id,
            'photos' => PhotoResource::collection($this->Photos),
        ];
    }
}
