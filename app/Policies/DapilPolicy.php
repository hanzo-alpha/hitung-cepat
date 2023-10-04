<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Dapil;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DapilPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        //
    }

    public function view(User $user, Dapil $dapil): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Dapil $dapil): bool
    {
    }

    public function delete(User $user, Dapil $dapil): bool
    {
    }

    public function restore(User $user, Dapil $dapil): bool
    {
    }

    public function forceDelete(User $user, Dapil $dapil): bool
    {
    }
}
