<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GenreResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name ?? $this->title ?? '', 
            'books_count' => $this->whenCounted('pets'),
            'books' => BookResource::collection($this->whenLoaded('pets')),
        ];
    }
}
