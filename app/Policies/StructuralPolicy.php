<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Structural;
use Illuminate\Auth\Access\HandlesAuthorization;

class StructuralPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_structural');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Structural $structural): bool
    {
        return $user->can('view_structural');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_structural');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Structural $structural): bool
    {
        return $user->can('update_structural');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Structural $structural): bool
    {
        return $user->can('delete_structural');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_structural');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Structural $structural): bool
    {
        return $user->can('force_delete_structural');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_structural');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Structural $structural): bool
    {
        return $user->can('restore_structural');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_structural');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Structural $structural): bool
    {
        return $user->can('replicate_structural');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_structural');
    }
}
