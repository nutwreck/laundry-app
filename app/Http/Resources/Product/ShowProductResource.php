<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) // phpcs:ignore
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name_product' => $this->name,
            'sku_product' => $this->sku,
            'price_product' => $this->price,
            'qty_product' => $this->quantity,
        ];
    }
}
