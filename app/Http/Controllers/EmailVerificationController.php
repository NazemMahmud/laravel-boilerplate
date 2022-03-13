<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailVerificationRequest;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
// use Illuminate\Foundation\Auth\EmailVerificationRequest; not using default
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\JsonResponse;

class EmailVerificationController extends Controller
{
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    /**
     * @param EmailVerificationRequest $request
     * @return JsonResponse
     */
    public function verify(EmailVerificationRequest $request): JsonResponse
    {
        $user = $request->validated();

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'message'=>'Email already verified'
            ], 200);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return response()->json([
            'message'=>'Email has been verified'
        ], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function sendVerificationEmail(Request $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Email already Verified'
            ], 200);
        }

        $user->sendEmailVerificationNotification();

        return response()->json([
            'message' => 'Verification link sent'
        ], 200);
    }
}
