<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\User\SearchUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use Illuminate\Http\JsonResponse;

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
     * Display a listing of the resource.
     */
    public function index(): View
    {
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
     * @responseFile responses/user/suborganizations.json
     *
     * @param SearchUserRequest $searchUserRequest
     * @return JsonResponse
     */
    public function getDatatablesResources(SearchUserRequest $searchUserRequest): JsonResponse
    {
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
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
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
     */
    public function store(StoreUserRequest $storeUserRequest)
    {
        $data = $storeUserRequest->validated();
        $this->userRepository->createUser($data);
        return redirect('/users');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
