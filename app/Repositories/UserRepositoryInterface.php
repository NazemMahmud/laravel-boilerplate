<?php

namespace App\Repositories;


interface UserRepositoryInterface
{
    public function createResource($request); // create new user

    public function getByColumn($column, $value); // get user by any specific column
}
