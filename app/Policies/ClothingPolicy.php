<?php

namespace App\Policies;

use App\Models\Clothing;
use App\Models\Dressing;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class ClothingPolicy
{
    public function view(User $user, Clothing $clothing): bool
    {
        return Gate::check('view', $clothing->dressing);
    }

    public function create(User $user, Dressing $dressing): bool
    {
        return Gate::check('update', $dressing);
    }

    public function update(User $user, Clothing $clothing): bool
    {
        return Gate::check('update', $clothing->dressing);
    }

    public function delete(User $user, Clothing $clothing): bool
    {
        return Gate::check('update', $clothing->dressing);
    }

    public function restore(User $user, Clothing $clothing): bool
    {
        return Gate::check('update', $clothing->dressing);
    }

    public function forceDelete(User $user, Clothing $clothing): bool
    {
        return Gate::check('update', $clothing->dressing);
    }
}
