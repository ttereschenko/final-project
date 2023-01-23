<?php

namespace App\Policies;

use App\Models\Property;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropertyPolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Property $property): bool
    {
        return $user->id === $property->user_id ||  $user->role === User::ROLE_ADMIN;
    }

    public function delete(User $user, Property $property): bool
    {
        return $user->id === $property->user_id ||  $user->role === User::ROLE_ADMIN;
    }

    public function addToWishlist(User $user, Property $property): bool
    {
        return $user->id !== $property->user_id;
    }

    public function deleteFromWishlist(User $user, Property $property): bool
    {
        return $user->id !== $property->user_id;
    }

    public function reserve(User $user, Property $property): bool
    {
        return $user->id !== $property->user_id;
    }
}
