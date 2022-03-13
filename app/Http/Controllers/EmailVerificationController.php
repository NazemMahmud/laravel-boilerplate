<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\JsonResponse;

class EmailVerificationController extends Controller
{
//    use VerifiesEmails, RedirectsUsers;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function sendVerificationEmail(Request $request): JsonResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Already Verified'
            ], 200);
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json([
            'status' => 'verification-link-sent'
        ], 200);
    }
}
