<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
            "short_description" => $this->short_description,
            "description" => $this->description,
            "sku" => $this->sku,
            "price" => (float) $this->price,
            "discount_percentage" => (float) $this->discount_percentage,
            "discounted_price" => round($this->price - ($this->price * ($this->discount_percentage / 100)), 2),
            "stock" => $this->stock,
            "quantity" => (int) $this->quantity,
            "status" => $this->status,
            "images" => $this->media->pluck('url'),
            "image" => $this->media->first()?->url ?? '/assets/images/product.png',
            "colors" => ColorResource::collection($this->whenLoaded('colors')),
            "sizes" => SizeResource::collection($this->whenLoaded('sizes')),
            "categories" => CategoryResource::collection($this->whenLoaded('categories')),
        ];
    }
}

