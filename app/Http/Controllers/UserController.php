<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;
use App\Http\Resources\UserResource;
use App\Enums\RedisKeyEnum as RedisKey;

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
        $cachedUser = Redis::get(RedisKey::USER_PROFILE);
        if (isset($cachedUser)) {
            return new UserResource(json_decode($cachedUser, FALSE));
        }

        $user = auth()->user();
        Redis::set(RedisKey::USER_PROFILE, json_encode(
            [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => $user->created_at,
            ]));

        return new UserResource($user);
    }
}
