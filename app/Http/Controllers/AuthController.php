<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    /**
     * Register user.
     *
     * @return JsonResponse
     */
    public function registration(RegistrationRequest $request): JsonResponse
    {
        $requestData = $request->validated();
        $user = $this->repository->createResource($requestData);

        event(new Registered($user)); // event call to send verify link to email

        return response()->json([
            'data' => [
                "name" => $user->name,
                "email" => $user->email,
            ],
            'message' => 'Registration request done. Please check your email',
        ], 201);
    }

    /**
     * login user
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $requestData = $request->validated();

        if (!$token = auth()->attempt($requestData)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(['data' => $this->respondWithToken($token)->original], 200);
    }

    /**
     * Refresh token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return response()->json(['data' => $this->respondWithToken(auth()->refresh())->original], 200);
    }


    /**
     * Logout user
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'User successfully logged out.']);
    }


    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken(string $token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 1
        ]);
    }

}
