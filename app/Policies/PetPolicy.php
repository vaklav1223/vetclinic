<?php

namespace App\Policies;

use App\Models\Pet;
use App\Models\User;

class PetPolicy
{
    public function before(User $user, string $ability): ?bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        return null;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'editor']);
    }

    public function update(User $user, Pet $pet): bool
    {
        return $user->id === $pet->user_id;
    }

    public function delete(User $user, Pet $pet): bool
    {
        return $user->id === $pet->user_id;
    }
}
