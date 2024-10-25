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

    /**
     * Search roles
     *
     * @param $data
     * @return mixed
     */
    public function search($data)
    {
        $query = $this->model::query()
            ->select('id', 'name', 'display_name');

        // Handle search
        if (isset($data['search']['value']) && $data['search']['value'] != '') {
            $search = $data['search']['value'];
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('display_name', 'LIKE', "%{$search}%");
        }

        // Handle sorting
        if (isset($data['order'])) {
            $orderColumn = $data['columns'][$data['order'][0]['column']]['data'];
            $orderDirection = $data['order'][0]['dir'];
            $query->orderBy($orderColumn, $orderDirection);
        }

        // Fetch paginated data
        return $query->paginate($data['length']);
    }

    /**
     * Sync Role Permissions
     *
     * @param Role $role
     * @param array $permissions
     */
    public function syncPermissions($role, $permissions)
    {
        $role->permissions()->sync($permissions);
    }

    /**
     * To delete a role
     *
     * @param Role $role
     * @return string
     */
    public function deleteRole(Role $role)
    {
        if ($role->users()->exists()) {
            $status = 'role-user-exists';
        } else {
            $role->delete();
            $status = 'role-deleted';
        }

        return $status;
    }
}
