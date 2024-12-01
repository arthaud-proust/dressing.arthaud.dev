<?php

namespace App\Policies;

use App\Models\Dressing;
use App\Models\User;

class DressingPolicy
{
    public function view(User $user, Dressing $dressing): bool
    {
        return $dressing->user_id === $user->id;
    }

    public function update(User $user, Dressing $dressing): bool
    {
        return $dressing->user_id === $user->id;
    }

    public function delete(User $user, Dressing $dressing): bool
    {
        return $dressing->user_id === $user->id;
    }

    public function restore(User $user, Dressing $dressing): bool
    {
        return $dressing->user_id === $user->id;
    }

    public function forceDelete(User $user, Dressing $dressing): bool
    {
        return $dressing->user_id === $user->id;
    }
}
