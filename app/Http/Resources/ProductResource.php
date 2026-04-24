<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'descriptionLong' => $this->descriptionLong,
            'price' => (float) $this->price,
            'category_id' => $this->category_id ? (int) $this->category_id : null,
            'category' => $this->whenLoaded('category', function () {
                if (!$this->category) {
                    return null;
                }

                return [
                    'id' => (int) $this->category->id,
                    'name' => $this->category->name,
                ];
            }),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
