<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\RegisterRequest;
use App\Notifications\API\Auth\UserRegisterationEmail;
use App\User;
use App\VerifyUser;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{

    /**
     * @param RegisterRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function register(RegisterRequest $request)
    {
        try {
            $request->validated();
        } catch (ValidationException $e) {
            return response()->json([
                'error' => true,
                'message' => $e
            ], Response::HTTP_BAD_REQUEST);
        }

        try {
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'phone_number' => $request->phone_number

            ]);

            $token = $user->createToken('api-token')->accessToken;
            VerifyUser::create([
                'user_id' => $user->id,
                'email_token' => sha1(time()) . Str::random(40)
            ]);
            return response()->json([
                'data' => [
                    'user' => $user,
                    'meta' => [
                        'token' => $token,
                        'type' => 'Bearer'
                    ],
                    'registered' => $this->registered($user)
                ]
            ], Response::HTTP_OK);
        } catch (QueryException $exception) {
            return response()->json([
                'error' => true,
                'message' => $exception->getMessage()
            ], $exception->getCode());
        }
    }

    /**
     * @param int $codeLength
     *
     * @return int
     * @throws \Exception
     */
    protected function generateCode($codeLength = 4)
    {
        $min = 10 ** $codeLength;
        $max = $min * 10 - 1;

        return random_int($min, $max);

    }

    /**
     * @param $user
     * @return \Illuminate\Http\JsonResponse
     */
    protected function registered($user)
    {

        $token = VerifyUser::where('user_id', $user->id)->first()->email_token;
        try {
            $user->notify(
                new UserRegisterationEmail($token)
            );


            return response()->json([
                'redirect' => true,
                'error' => false,
                'message' => trans('validation.register.success')
            ], Response::HTTP_OK);

        } catch (\Exception $exception) {
            return response()->json([
                'error' => true,
                'message' => trans('validation.register.failed')
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }


    }


}
