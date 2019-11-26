<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'description' => $this->detail,
            'price' => $this->price,
            'itemsLeft' => $this->stock,
            'discount' => $this->discount,
            // 'discountedPrice' => round(($this->price - $this->discount),2),
            'discountedPrice' => round((1 - ($this->discount/100)) * $this->price, 2),
            'rating' => $this->reviews->count() > 0 ? round($this->reviews->sum('star')/$this->reviews->count(), 2) : 0,
            'reviews' => [
                'link' => route('reviews.index', $this->id)
            ]
        ];
    }
}
