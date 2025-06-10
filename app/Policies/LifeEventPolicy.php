<?php

namespace App\Policies;

use App\Models\LifeEvent;
use App\Models\User;

class LifeEventPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, LifeEvent $lifeEvent): bool
    {
        return $user->id === $lifeEvent->user_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, LifeEvent $lifeEvent): bool
    {
        return $user->id === $lifeEvent->user_id;
    }

    public function delete(User $user, LifeEvent $lifeEvent): bool
    {
        return $user->id === $lifeEvent->user_id;
    }
}
