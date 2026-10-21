<?php

namespace App\Policies;

use App\Models\Owner;
use App\Models\User;

class OwnerPolicy
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

    public function update(User $user, Owner $owner): bool
    {
        return $user->id === $owner->user_id;
    }

    public function delete(User $user, Owner $owner): bool
    {
        return $user->id === $owner->user_id;
    }
}
