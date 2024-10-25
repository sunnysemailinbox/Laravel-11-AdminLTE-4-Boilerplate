<?php

namespace App\Repositories\User;

use App\Repositories\EloquentRepositoryInterface;
use App\Models\User;

interface UserRepositoryInterface extends EloquentRepositoryInterface
{
    /**
     * Search users
     *
     * @param $data
     * @return mixed
     */
    public function search($data);

    /**
     * To create a user
     *
     * @param $data
     * @return User
     */
    public function createUser($data);

    /**
     * To update a user
     *
     * @param $data
     * @param $data
     * @return User
     */
    public function updateUser(User $user, $data);

    /**
     * To delete a user
     *
     * @param User $user
     */
    public function deleteUser(User $user);

    /**
     * Check if user has the specified permission
     *
     * @param $user
     * @param $permission
     * @return boolean
     */
    public function hasPermissionTo($user, $permission);
}
