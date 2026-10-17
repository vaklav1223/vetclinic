<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'title',
        'breed',
        'age',
        'price',
        'is_vaccinated',
        'birth_date',
    ];

    protected function casts(): array
    {
        return [
            'is_vaccinated' => 'boolean',
            'price' => 'decimal:2',
            'birth_date' => 'date',
        ];
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class);
    }

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('is_vaccinated', true);
    }

    public function scopeSearch(Builder $query, string $searchTerm): Builder
    {
        return $query->where(function (Builder $q) use ($searchTerm) {
            $q->where('title', 'like', "%{$searchTerm}%")
              ->orWhere('breed', 'like', "%{$searchTerm}%");
        });
    }
}
