<?php

namespace App\Policies;

use App\Models\SelfCareQuestion;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SelfCareQuestionPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, SelfCareQuestion $question): bool
    {
        return $user->id === $question->user_id || $question->is_default;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, SelfCareQuestion $question): bool
    {
        return $user->id === $question->user_id && !$question->is_default;
    }

    public function delete(User $user, SelfCareQuestion $question): bool
    {
        return $user->id === $question->user_id && !$question->is_default;
    }
}
