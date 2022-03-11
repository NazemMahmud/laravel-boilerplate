<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Get user profile.
     *
     * @return JsonResponse
     */
    public function profile(): JsonResponse
    {
        return response()->json(auth()->user());
    }
}
