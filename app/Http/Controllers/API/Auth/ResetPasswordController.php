<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\PasswordRecoverRequest;
use App\Notifications\API\Auth\PasswordResetRequest;
use App\Notifications\API\Auth\PasswordResetSuccess;
use App\PasswordReset;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function recover(PasswordRecoverRequest $request)
    {
        $request->validated();
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'error' => true,
                'message' => trans('auth.email.recover.error')
            ], 404);
        }
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => sha1(time()) . str_random(60),
            ]
        );
        if ($user && $passwordReset) {
            $user->notify(
                new PasswordResetRequest($passwordReset->token)
            );
        }

        return response()->json([
            'error' => false,
            'message' => trans('auth.email.recover.success')
        ]);

    }

    /**
     * @param $token
     *
     * @return JsonResponse
     */
    public function find($token)
    {
        $passwordReset = PasswordReset::where('token', $token)
            ->first();
        if (!$passwordReset) {
            return response()->json([
                'error' => true,
                'message' => trans('auth.password_reset.token.invalid')
            ], 404);
        }
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();

            return response()->json([
                'error' => true,
                'message' => trans('auth.password_reset.token.invalid')
            ], 404);
        }

        return response()->json($passwordReset);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function reset(\App\Http\Requests\API\Auth\PasswordResetRequest $request)
    {

        $request->validated();
        $passwordReset = PasswordReset::where([
            ['token', $request->token]
        ])->first();
        if (!$passwordReset) {
            return response()->json([
                'error' => true,
                'message' => trans('auth.password_reset.token.invalid')
            ], 404);
        }
        $userEmail = DB::table('password_resets')->where('token', $passwordReset->token)->pluck('email');
        $user = User::where('email', $userEmail)->first();
        if (!$user) {
            return response()->json([
                'error' => true,
                'message' => trans('auth.password_reset.user.invalid')
            ], 404);
        }
        $user->password = bcrypt($request->password);
        $user->save();
        $passwordReset->delete();
        $user->notify(new PasswordResetSuccess($passwordReset));

        return response()->json([
            'error' => false,
            'data' => $user
        ]);
    }

}
