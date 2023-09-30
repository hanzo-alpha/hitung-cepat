<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\JenisPemilihan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JenisPemilihanPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_jenis_pemilihan');
    }

    public function view(User $user, JenisPemilihan $jenisPemilihan): bool
    {
        return $user->can('view_jenis_pemilihan');
    }

    public function create(User $user): bool
    {
        return $user->can('create_jenis_pemilihan');
    }

    public function update(User $user, JenisPemilihan $jenisPemilihan): bool
    {
        return $user->can('update_jenis_pemilihan');
    }

    public function delete(User $user, JenisPemilihan $jenisPemilihan): bool
    {
        return $user->can('delete_jenis_pemilihan');
    }

    public function restore(User $user, JenisPemilihan $jenisPemilihan): bool
    {
        return $user->can('{{ Restore }}');
    }

    public function forceDelete(User $user, JenisPemilihan $jenisPemilihan): bool
    {
        return $user->can('{{ ForceDelete }}');
    }
}
