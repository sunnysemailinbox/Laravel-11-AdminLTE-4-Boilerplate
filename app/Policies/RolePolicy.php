<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('role:index');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Role $role): bool
    {
        return $user->hasPermissionTo('role:show');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('role:create');
    }

    /**
     * Determine whether the user can store models.
     */
    public function store(User $user): bool
    {
        return $user->hasPermissionTo('role:store');
    }

    /**
     * Determine whether the user can edit the model.
     */
    public function edit(User $user, Role $role): bool
    {
        return $user->hasPermissionTo('role:edit');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Role $role): bool
    {
        return $user->hasPermissionTo('role:update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Role $role): bool
    {
        return $user->role_id !== $role->id && $user->hasPermissionTo('role:destroy');
    }

    /**
     * Determine whether the user can edit the role permissions.
     */
    public function editPermissions(User $user, Role $role): bool
    {
        return $user->hasPermissionTo('role:edit-permissions');
    }

    /**
     * Determine whether the user can update the role permissions.
     */
    public function updatePermissions(User $user, Role $role): bool
    {
        return $user->hasPermissionTo('role:update-permissions');
    }
}
