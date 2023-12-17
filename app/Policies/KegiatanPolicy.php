<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class KegiatanPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        //
    }

    public function view(User $user, Kegiatan $kegiatan): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Kegiatan $kegiatan): bool
    {
    }

    public function delete(User $user, Kegiatan $kegiatan): bool
    {
    }

    public function restore(User $user, Kegiatan $kegiatan): bool
    {
    }

    public function forceDelete(User $user, Kegiatan $kegiatan): bool
    {
    }
}
