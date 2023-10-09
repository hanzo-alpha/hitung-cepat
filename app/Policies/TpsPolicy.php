<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Tps;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TpsPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Tps $tps): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Tps $tps): bool
    {
    }

    public function delete(User $user, Tps $tps): bool
    {
    }

    public function restore(User $user, Tps $tps): bool
    {
    }

    public function forceDelete(User $user, Tps $tps): bool
    {
    }
}
