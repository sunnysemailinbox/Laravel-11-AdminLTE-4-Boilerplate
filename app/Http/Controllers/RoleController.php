<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\Role\SearchRoleRequest;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Http\Requests\Role\UpdateRolePermissionsRequest;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\Permission\PermissionRepositoryInterface;
use Illuminate\Http\JsonResponse;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    private $roleRepository;
    private $permissionRepository;

    /**
     * RoleController constructor.
     *
     * @param RoleRepositoryInterface $roleRepository
     * @param PermissionRepositoryInterface $permissionRepository
     */
    public function __construct(
        RoleRepositoryInterface $roleRepository,
        PermissionRepositoryInterface $permissionRepository
    )
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * List Roles
     * 
     * Display a listing of the roles.
     * 
     * @return View
     */
    public function index(): View
    {
        Gate::authorize('viewAny', Role::class);

        return view('role.index');
    }

    /**
     * Get Roles Datatables Resources
     *
     * Get a list of the roles resources for datatables.
     *
     * @queryParam draw required Used by DataTables to ensure requests are drawn in sequence Example: 1
     * @queryParam start required Paging first record indicator Example: 1
     * @queryParam length required Number of records to be returned Example: 10
     * @queryParam search[value] string Search "value" Example: fahad@nxb
     * @queryParam order array Array of the order "column" index and "dir" Example: [[column => 2], [dir => 'desc']]
     * @queryParam columns array Array of the columns "data" Example: [data => 'email']
     *
     * @responseFile responses/role/roles.json
     *
     * @param SearchRoleRequest $searchRoleRequest
     * @return JsonResponse
     */
    public function getDatatablesResources(SearchRoleRequest $searchRoleRequest): JsonResponse
    {
        Gate::authorize('viewAny', Role::class);

        $data = $searchRoleRequest->validated();
        $roles = $this->roleRepository->search($data);

        return response()->json([
            'draw' => $data['draw'],
            'recordsTotal' => $roles->total(),
            'recordsFiltered' => $roles->total(),
            'data' => $roles->items(),
        ]);
    }

    /**
     * Show Create Role Page
     * 
     * Show the form for creating a new role.
     * 
     * @return View
     */
    public function create(): View
    {
        Gate::authorize('create', Role::class);

        return view('role.create');
    }

    /**
     * Store Role
     * 
     * Store a newly created role in storage.
     * 
     * @bodyParam name string required Name of a role Example: guest
     * @bodyParam display_name string required Display name of a role Example: Guest
     * 
     * @param StoreRoleRequest $storeRoleRequest
     * @return RedirectResponse
     */
    public function store(StoreRoleRequest $storeRoleRequest): RedirectResponse
    {
        Gate::authorize('store', Role::class);

        $data = $storeRoleRequest->validated();
        $this->roleRepository->create($data);
        return Redirect::route('roles.index')->with('status', 'role-saved');
    }

    /**
     * Display Role
     *
     * Display the specified role.
     *
     * @urlParam role required The Id of a role Example: 1
     *
     * @param Role $role
     * @return View
     */
    public function show(Role $role): View
    {
        Gate::authorize('view', $role);

        return view('role.view', ['role' => $role]);
    }

    /**
     * Edit Role Form
     *
     * Show the form for editing the specified role
     *
     * @urlParam role required The Id of a role Example: 1
     *
     * @param Role $role
     * @return View
     */
    public function edit(Role $role): View
    {
        Gate::authorize('edit', $role);

        return view('role.edit', ['role' => $role]);
    }

    /**
     * Update Role
     *
     * Update the specified role in storage.
     *
     * @urlParam role required The Id of a role Example: 1
     *
     * @param UpdateRoleRequest $updateRoleRequest
     * @param Role $role
     * @return RedirectResponse
     */
    public function update(UpdateRoleRequest $updateRoleRequest, Role $role): RedirectResponse
    {
        Gate::authorize('update', $role);

        $data = $updateRoleRequest->validated();
        $role->update($data);

        return Redirect::route('roles.index')->with('status', 'role-updated');
    }

    /**
     * Remove Role
     *
     * Remove the specified role from storage.
     *
     * @urlParam role required The Id of a role Example: 1
     *
     * @param Role $role
     * @return RedirectResponse
     */
    public function destroy(Role $role)
    {
        Gate::authorize('delete', $role);

        $status = $this->roleRepository->deleteRole($role);
        return Redirect::route('roles.index')->with('status', $status);
    }

    /**
     * Display Role Permissions
     *
     * Display the permissions for specified role.
     *
     * @param Role $role
     * @return View
     */
    public function showPermissions(Role $role): View
    {
        Gate::authorize('editPermissions', $role);

        $roles = $this->roleRepository->all();
        $sortOrders = ['feature' => 'asc', 'display_name' => 'asc'];
        $permissions = $this->permissionRepository->getRolesPermissions($role->id, $sortOrders);
        return view('role.permissions', ['roleId' => $role->id, 'roles' => $roles, 'permissions' => $permissions]);
    }

    /**
     * Update Role Permissions
     *
     * Update the specified role permissions in storage.
     *
     * @urlParam role required The Id of a role Example: 1
     * @bodyParam permissions array required Ids of permissions Example: [1,2]
     * 
     * @param UpdateRolePermissionsRequest $updateRolePermissionsRequest
     * @param Role $role
     * @return RedirectResponse
     */
    public function updatePermissions(UpdateRolePermissionsRequest $updateRolePermissionsRequest, Role $role): RedirectResponse
    {
        Gate::authorize('updatePermissions', $role);

        $data = $updateRolePermissionsRequest->validated();
        $this->roleRepository->syncPermissions($role, $data['permissions']);

        return Redirect::route('roles.permissions', $role->id)->with('status', 'permissions-updated');
    }
}
