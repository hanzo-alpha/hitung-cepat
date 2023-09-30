<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\JenisCalon;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JenisCalonPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, JenisCalon $jenisCalon): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, JenisCalon $jenisCalon): bool
    {
    }

    public function delete(User $user, JenisCalon $jenisCalon): bool
    {
    }

    public function restore(User $user, JenisCalon $jenisCalon): bool
    {
    }

    public function forceDelete(User $user, JenisCalon $jenisCalon): bool
    {
    }
}
