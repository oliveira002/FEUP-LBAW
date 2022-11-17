<?php

namespace App\Policies;

use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    public function show(User $user, User $user2)
    {
      // Only a user can see its own profile
      return $user->id === $user2->id;
    }

    public function edit(User $user, User $user2)
    {
      // Only a user can edit its own profile
      return $user->id === $user2->id;
    }

    public function delete(User $user, User $user2)
    {
      // Only a user can delete its own profile
      return $user->id === $user2->id;
    }
}