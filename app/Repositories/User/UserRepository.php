<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(
        User $model
    )
    {
        parent::__construct($model);
    }

    /**
     * Search users
     *
     * @param $data
     * @return mixed
     */
    public function search($data)
    {
        $query = $this->model::query()
            ->select('id', 'name', 'email')
            ->withAggregate('role', 'display_name');

        // Handle search
        if (isset($data['search']['value']) && $data['search']['value'] != '') {
            $search = $data['search']['value'];
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%");
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
     * To create a user
     *
     * @param $data
     * @return User
     */
    public function createUser($data)
    {
        // Generate a random password
        $password = Str::random(10);

        // Hash the password
        $data['password'] = Hash::make($password);

        // Store the file in the `public/avatars` directory
        $data['avatar'] = $data['avatar']->store('avatars', 'public');

        return $this->create($data);
    }

    /**
     * To update a user
     *
     * @param $data
     * @param $data
     * @return User
     */
    public function updateUser(User $user, $data)
    {
        if(isset($data['avatar'])) {
            // Store the file in the `public/avatars` directory
            $data['avatar'] = $data['avatar']->store('avatars', 'public');

            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
        }

        return $user->update($data);
    }

    /**
     * To delete a user
     *
     * @param User $user
     */
    public function deleteUser(User $user)
    {
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();
    }

    /**
     * Check if user has the specified permission
     *
     * @param $user
     * @param $permission
     * @return boolean
     */
    public function hasPermissionTo($user, $permission)
    {
        $hasPermissionTo =  $user->role()
                            ->whereHas('permissions', function (Builder $query) use ($permission) {
                                $query->where('name', '=', $permission);
                            })->get();

        if ($hasPermissionTo->count()) {
            return true;
        }

        return false;
    }
}
