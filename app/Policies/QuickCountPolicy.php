<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\QuickCount;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuickCountPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, QuickCount $quickCount): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, QuickCount $quickCount): bool
    {
    }

    public function delete(User $user, QuickCount $quickCount): bool
    {
    }

    public function restore(User $user, QuickCount $quickCount): bool
    {
    }

    public function forceDelete(User $user, QuickCount $quickCount): bool
    {
    }
}
