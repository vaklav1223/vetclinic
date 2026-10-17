<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Owner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'description',
    ];

    protected function casts(): array
    {
        return [];
    }

    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class);
    }
}
