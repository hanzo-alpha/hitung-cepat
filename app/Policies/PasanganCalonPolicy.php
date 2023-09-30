<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\PasanganCalon;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PasanganCalonPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        //
    }

    public function view(User $user, PasanganCalon $pasanganCalon): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, PasanganCalon $pasanganCalon): bool
    {
    }

    public function delete(User $user, PasanganCalon $pasanganCalon): bool
    {
    }

    public function restore(User $user, PasanganCalon $pasanganCalon): bool
    {
    }

    public function forceDelete(User $user, PasanganCalon $pasanganCalon): bool
    {
    }
}
