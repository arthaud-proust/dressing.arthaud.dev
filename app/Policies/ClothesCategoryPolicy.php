<?php

namespace App\Policies;

use App\Models\ClothesCategory;
use App\Models\User;

class ClothesCategoryPolicy
{
    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, ClothesCategory $clothesCategory): bool
    {
        return $clothesCategory->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, ClothesCategory $clothesCategory): bool
    {
        return $clothesCategory->user_id === $user->id;
    }

    public function delete(User $user, ClothesCategory $clothesCategory): bool
    {
        return $clothesCategory->user_id === $user->id;
    }

    public function restore(User $user, ClothesCategory $clothesCategory): bool
    {
        return $clothesCategory->user_id === $user->id;
    }

    public function forceDelete(User $user, ClothesCategory $clothesCategory): bool
    {
        return $clothesCategory->user_id === $user->id;
    }
}
