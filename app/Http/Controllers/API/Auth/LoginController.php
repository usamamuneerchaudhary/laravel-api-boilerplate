<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\LoginRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Laravel\Passport\Passport;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{

    /**
     * @param LoginRequest $request
     *
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {

        try {
            $request->validated();
        } catch (ValidationException $e) {
            return response()->json([
                'error' => true,
                'message' => $e
            ], Response::HTTP_BAD_REQUEST);
        }
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->attempt($credentials, $remember_me)) {
            $token = auth()->user()->createToken('my-api-token')->accessToken;
            $user = User::where('email', $request->email)->with('roles')->first();

            if ($remember_me === true) {
                Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
            }
            return response()->json([
                'error' => false,
                'data' => [
                    'user' => $user,
                    'meta' => [
                        'token' => $token,
                        'type' => 'Bearer'
                    ]
                ]
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'error' => true,
                'message' => trans('validation.invalid_credentials')
            ], Response::HTTP_BAD_REQUEST);
        }


    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'error' => false,
            'message' => trans('auth.logged_out')
        ]);

    }

}
