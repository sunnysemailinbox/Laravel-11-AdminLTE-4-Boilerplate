<?php

namespace App\Repositories\User;

use App\Repositories\EloquentRepositoryInterface;

interface UserRepositoryInterface extends EloquentRepositoryInterface
{
    /**
     * Search users
     *
     * @param $data
     * @return mixed
     */
    public function search($data);
}
