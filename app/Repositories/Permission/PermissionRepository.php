<?php

namespace App\Repositories\Permission;

use App\Repositories\BaseRepository;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Builder;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    /**
     * PermissionRepository constructor.
     *
     * @param Permission $model
     */
    public function __construct(
        Permission $model
    )
    {
        parent::__construct($model);
    }

    /**
     * Get permissions order by
     *
     * @param $roleId
     * @param $sortOrders
     * @return mixed
     */
    public function getRolesPermissions($roleId, $sortOrders)
    {
        return $this->model::withCount(['roles' => function (Builder $query) use ($roleId) {
                    $query->where('roles.id', $roleId);
                }])
                ->when($sortOrders, function (Builder $query, array $sortOrders) {
                    foreach ($sortOrders as $column => $order) {
                        $query->orderBy($column, $order);
                    }
                }, function (Builder $query) {
                    $query->orderBy('feature', 'asc')
                            ->orderBy('display_name', 'asc');
                })
                ->get();
    }
}
