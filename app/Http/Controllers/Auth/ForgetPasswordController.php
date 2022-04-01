<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\HttpHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(protected UserRepositoryInterface $repository)
    {
    }
    /**
     * Send mail to reset password when forgot password clicked
     *
     * @param ForgotPasswordRequest $request
     * @return JsonResponse
     */
    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        $requestData = $request->validated();
        try {
            if ($checkUser = $this->repository->getByColumn('email', $requestData['email'])) {
                $status = Password::sendResetLink($requestData['email']); // vendor\laravel\framework\src\Illuminate\Auth\Passwords\PasswordBroker.php
                return $status === Password::RESET_LINK_SENT
                    ? response()->json(['status' => __($status)])
                    : response()->json(['email' => __($status)]);
            }
            return HttpHandler::errorMessage("Email doesn't exist");
        } catch (\Exception $ex) {
            return HttpHandler::errorMessage("Something went wrong");
        }
    }

    /**
     * Reset user password
     *
     * @param ResetPasswordRequest $request
     * @return JsonResponse
     */
    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                $user->tokens()->delete();
                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            response()->json([
                'message'=> 'Password reset successfully'
            ]);
        }

        return response()->json([
            'message'=> __($status)
        ], 500);
    }
}
