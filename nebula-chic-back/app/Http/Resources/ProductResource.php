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
      'id' => $this->id,
      'name' => $this->name,
      'price' => $this->price,
      'description' => $this->description,
      'product_type_id' => $this->productType->id,
      'productType' => $this->productType->name,
      'sizes_id' => collect($this->sizes)->map(fn ($size) => $size->id),
      'sizes' => collect($this->sizes)->map(fn ($size) => $size->name)->implode(', '),
      'images' => ImageResource::collection($this->images)
    ];
  }
}
