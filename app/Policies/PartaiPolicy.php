<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Partai;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PartaiPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Partai $partai): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Partai $partai): bool
    {
    }

    public function delete(User $user, Partai $partai): bool
    {
    }

    public function restore(User $user, Partai $partai): bool
    {
    }

    public function forceDelete(User $user, Partai $partai): bool
    {
    }
}
