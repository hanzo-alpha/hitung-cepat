<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\HitungSuaraPartai;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HitungSuaraPartaiPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        //
    }

    public function view(User $user, HitungSuaraPartai $hitungSuaraPartai): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, HitungSuaraPartai $hitungSuaraPartai): bool
    {
    }

    public function delete(User $user, HitungSuaraPartai $hitungSuaraPartai): bool
    {
    }

    public function restore(User $user, HitungSuaraPartai $hitungSuaraPartai): bool
    {
    }

    public function forceDelete(User $user, HitungSuaraPartai $hitungSuaraPartai): bool
    {
    }
}
