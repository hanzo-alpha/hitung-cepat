<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Relawan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RelawanPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        //
    }

    public function view(User $user, Relawan $relawan): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Relawan $relawan): bool
    {
    }

    public function delete(User $user, Relawan $relawan): bool
    {
    }

    public function restore(User $user, Relawan $relawan): bool
    {
    }

    public function forceDelete(User $user, Relawan $relawan): bool
    {
    }
}
