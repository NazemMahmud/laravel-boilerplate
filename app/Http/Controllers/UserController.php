<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    /**
     * Get user profile.
     * Check redis first
     * if not found: cache in Redis, then return
     *
     * @return UserResource
     */
    public function profile(): UserResource
    {
        $cachedUser = Redis::get('user_profile');
//        dump($cachedUser);
        if (isset($cachedUser)) {
            return new UserResource(json_decode($cachedUser, FALSE));
        }
        $user = auth()->user();
//        dump($user);
//        return $user;
        Redis::set('user_profile', json_encode(
            [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => $user->created_at,
            ]));

        return new UserResource($user);
//        return new UserResource(auth()->user());
    }
}
