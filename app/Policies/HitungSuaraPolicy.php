<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\HitungSuara;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HitungSuaraPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        //
    }

    public function view(User $user, HitungSuara $hitungSuara): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, HitungSuara $hitungSuara): bool
    {
    }

    public function delete(User $user, HitungSuara $hitungSuara): bool
    {
    }

    public function restore(User $user, HitungSuara $hitungSuara): bool
    {
    }

    public function forceDelete(User $user, HitungSuara $hitungSuara): bool
    {
    }
}
