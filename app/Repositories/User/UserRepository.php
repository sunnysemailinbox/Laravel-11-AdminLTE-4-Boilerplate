<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

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
        if ($data['order']) {
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

        return $this->create($data);
    }
}
