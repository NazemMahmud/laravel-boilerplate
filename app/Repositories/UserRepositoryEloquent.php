<?php


namespace App\Repositories;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepositoryEloquent implements UserRepositoryInterface
{
    protected User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function createResource($request)
    {
        return $this->model::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);
    }

    /**
     * Search user by any single column value
     *
     * @param $column
     * @param $value
     * @return mixed
     */
    public function getByColumn($column, $value) {
        return $this->model::where($column, $value)->first();
    }
}
