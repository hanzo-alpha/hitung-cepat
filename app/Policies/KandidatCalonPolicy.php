<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\KandidatCalon;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class KandidatCalonPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        //
    }

    public function view(User $user, KandidatCalon $kandidatCalon): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, KandidatCalon $kandidatCalon): bool
    {
    }

    public function delete(User $user, KandidatCalon $kandidatCalon): bool
    {
    }

    public function restore(User $user, KandidatCalon $kandidatCalon): bool
    {
    }

    public function forceDelete(User $user, KandidatCalon $kandidatCalon): bool
    {
    }
}
