<?php

namespace App\Repositories\Role;

use App\Repositories\BaseRepository;
use App\Models\Role;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    /**
     * RoleRepository constructor.
     *
     * @param Role $model
     */
    public function __construct(
        Role $model
    )
    {
        parent::__construct($model);
    }

    /**
     * Get role id, display name key value pair
     *
     * @return array
     */
    public function getIdDisplayname()
    {
        return $this->model::pluck('display_name', 'id')->toArray();
    }
}
