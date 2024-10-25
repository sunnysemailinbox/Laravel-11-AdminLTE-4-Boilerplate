<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\User\SearchUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    private $userRepository;
    private $roleRepository;

    /**
     * UserController constructor.
     *
     * @param UserRepositoryInterface $userRepository
     * @param RoleRepositoryInterface $roleRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        RoleRepositoryInterface $roleRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * List Users
     * 
     * Display a listing of the users.
     * 
     * @return View
     */
    public function index(): View
    {
        Gate::authorize('viewAny', User::class);

        return view('user.index');
    }

    /**
     * Get Users Datatables Resources
     *
     * Get a list of the users resources for datatables.
     *
     * @queryParam draw required Used by DataTables to ensure requests are drawn in sequence Example: 1
     * @queryParam start required Paging first record indicator Example: 1
     * @queryParam length required Number of records to be returned Example: 10
     * @queryParam search[value] string Search "value" Example: fahad@nxb
     * @queryParam order array Array of the order "column" index and "dir" Example: [[column => 2], [dir => 'desc']]
     * @queryParam columns array Array of the columns "data" Example: [data => 'email']
     *
     * @responseFile responses/user/users.json
     *
     * @param SearchUserRequest $searchUserRequest
     * @return JsonResponse
     */
    public function getDatatablesResources(SearchUserRequest $searchUserRequest): JsonResponse
    {
        Gate::authorize('viewAny', User::class);

        $data = $searchUserRequest->validated();
        $users = $this->userRepository->search($data);

        return response()->json([
            'draw' => $data['draw'],
            'recordsTotal' => $users->total(),
            'recordsFiltered' => $users->total(),
            'data' => $users->items(),
        ]);
    }

    /**
     * Show Create User Page
     * 
     * Show the form for creating a new user.
     * 
     * @return View
     */
    public function create(): View
    {
        Gate::authorize('create', User::class);

        $roles = $this->roleRepository->all();
        return view('user.create', ['roles' => $roles]);
    }

    /**
     * Store User
     * 
     * Store a newly created user in storage.
     * 
     * @bodyParam name string required Name of a user Example: Fahad
     * @bodyParam email string required Email of a user Example: fahad@nxb.com
     * @bodyParam role integer required Id of the role Example: 1
     * 
     * @param StoreUserRequest $storeUserRequest
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $storeUserRequest): RedirectResponse
    {
        Gate::authorize('store', User::class);

        $data = $storeUserRequest->validated();
        $this->userRepository->createUser($data);
        return Redirect::route('users.index')->with('status', 'user-saved');
    }

    /**
     * Display User
     *
     * Display the specified user.
     *
     * @urlParam user required The Id of a user Example: 1
     *
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        Gate::authorize('view', $user);

        return view('user.view', ['user' => $user]);
    }

    /**
     * Edit User Form
     *
     * Show the form for editing the specified user
     *
     * @urlParam user required The Id of a user Example: 1
     *
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        Gate::authorize('edit', $user);

        $roles = $this->roleRepository->all();
        return view('user.edit', ['roles' => $roles, 'user' => $user]);
    }

    /**
     * Update User
     *
     * Update the specified user in storage.
     *
     * @urlParam user required The Id of a user Example: 1
     *
     * @param UpdateUserRequest $updateUserRequest
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $updateUserRequest, User $user): RedirectResponse
    {
        Gate::authorize('update', $user);

        $data = $updateUserRequest->validated();
        $this->userRepository->updateUser($user, $data);

        return Redirect::route('users.index')->with('status', 'user-updated');
    }

    /**
     * Remove User
     *
     * Remove the specified user from storage.
     *
     * @urlParam user required The Id of a user Example: 1
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user)
    {
        Gate::authorize('delete', $user);

        $this->userRepository->deleteUser($user);
        return Redirect::route('users.index')->with('status', 'user-deleted');
    }
}
