<?php

namespace App\Repositories\Role;

use App\Repositories\EloquentRepositoryInterface;

interface RoleRepositoryInterface extends EloquentRepositoryInterface
{
    /**
     * Get role id, display name key value pair
     *
     * @return array
     */
    public function getIdDisplayname();
}
