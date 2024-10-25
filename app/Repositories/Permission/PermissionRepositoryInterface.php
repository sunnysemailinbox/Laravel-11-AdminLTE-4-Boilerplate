<?php

namespace App\Repositories\Permission;

use App\Repositories\EloquentRepositoryInterface;

interface PermissionRepositoryInterface extends EloquentRepositoryInterface
{
    /**
     * Get permissions order by
     *
     * @param $roleId
     * @param $sortOrders
     * @return mixed
     */
    public function getRolesPermissions($roleId, $sortOrders);
}
