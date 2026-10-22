<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'breed' => $this->breed,
            'age' => $this->age,
            'price' => $this->price,
            'is_vaccinated' => $this->is_vaccinated,
            'birth_date' => $this->birth_date ? $this->birth_date : null,
            'cover_url' => $this->cover ? asset('storage/' . $this->cover) : null,
            'created_at' => $this->created_at?->toIso8601String(),
            'genre' => new GenreResource($this->whenLoaded('owner')),
            'links' => [
                'self' => route('api.v1.books.show', ['id' => $this->id]),
            ],
        ];
    }
}
