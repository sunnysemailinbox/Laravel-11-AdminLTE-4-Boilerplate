<?php

namespace App\Repositories\Role;

use App\Repositories\EloquentRepositoryInterface;
use App\Models\Role;

interface RoleRepositoryInterface extends EloquentRepositoryInterface
{
    /**
     * Get role id, display name key value pair
     *
     * @return array
     */
    public function getIdDisplayname();

    /**
     * Search roles
     *
     * @param $data
     * @return mixed
     */
    public function search($data);

    /**
     * Sync Role Permissions
     *
     * @param Role $role
     * @param array $permissions
     */
    public function syncPermissions($role, $permissions);

    /**
     * To delete a role
     *
     * @param Role $role
     * @return string
     */
    public function deleteRole(Role $role);
}
