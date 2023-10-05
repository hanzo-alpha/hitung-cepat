<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\DaftarPemilih;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DaftarPemilihPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        //
    }

    public function view(User $user, DaftarPemilih $daftarPemilih): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, DaftarPemilih $daftarPemilih): bool
    {
    }

    public function delete(User $user, DaftarPemilih $daftarPemilih): bool
    {
    }

    public function restore(User $user, DaftarPemilih $daftarPemilih): bool
    {
    }

    public function forceDelete(User $user, DaftarPemilih $daftarPemilih): bool
    {
    }
}
