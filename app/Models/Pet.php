<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;
use App\Observers\PetObserver; 
use Illuminate\Database\Eloquent\Attributes\ObservedBy; 
#[ObservedBy(PetObserver::class)]
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
        'cover',
        'attachment',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function coverUrl(): Attribute
    {
        return Attribute::get(function () {
            if ($this->cover && Storage::disk('public')->exists($this->cover)) {
                return Storage::url($this->cover);
            }
            return asset('images/no-cover.png');
        });
    }
    public function bookings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Booking::class);
    }

}
