<?php

namespace App\Policies;

use App\Models\SelfCareCheckin;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SelfCareCheckinPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, SelfCareCheckin $checkin): bool
    {
        return $user->id === $checkin->user_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, SelfCareCheckin $checkin): bool
    {
        return false;
    }

    public function delete(User $user, SelfCareCheckin $checkin): bool
    {
        return false;
    }
}
