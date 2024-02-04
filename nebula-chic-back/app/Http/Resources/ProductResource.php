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
      'producType' => ProductTypeResource::make($this->productType),
      'sizes' => SizeResource::collection($this->sizes),
      'images' => ImageResource::collection($this->images)
    ];
  }
}
