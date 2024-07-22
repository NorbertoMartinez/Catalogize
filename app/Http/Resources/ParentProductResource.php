<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ParentProductResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'sku' => $this->sku,
            'isStockeable' => $this->isStockeable,
            'stock' => $this->stock,
            'isGlobalPrice' => $this->isGlobalPrice,
            'price' => $this->price,
            'availability_id' => $this->availability_id,
            'product_type_id' => $this->product_type_id,
            'status_id' => $this->status_id,
        ];
    }
}
