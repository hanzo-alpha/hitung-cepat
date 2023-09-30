<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Caleg;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CalegPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        //
    }

    public function view(User $user, Caleg $caleg): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Caleg $caleg): bool
    {
    }

    public function delete(User $user, Caleg $caleg): bool
    {
    }

    public function restore(User $user, Caleg $caleg): bool
    {
    }

    public function forceDelete(User $user, Caleg $caleg): bool
    {
    }
}
