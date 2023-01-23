<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AmenityPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        return $user->role === User::ROLE_ADMIN;
    }

    public function edit(User $user): bool
    {
        return $user->role === User::ROLE_ADMIN;
    }

    public function list(User $user): bool
    {
        return $user->role === User::ROLE_ADMIN;
    }

    public function delete(User $user): bool
    {
        return $user->role === User::ROLE_ADMIN;
    }
}
