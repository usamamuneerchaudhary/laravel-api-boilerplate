<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\VerifyUser;
use Illuminate\Http\JsonResponse;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Rest\Client;

use Symfony\Component\HttpFoundation\Response;

class VerificationController extends Controller
{



    /**
     * @param $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyUserByEmail($token)
    {
        $verifyUser = VerifyUser::where('email_token', $token)->first();
        if (isset($verifyUser)) {
            $user = $verifyUser->user;

            if (!$user->verified_by_email) {
                $verifyUser->user->verified_by_email = true;
                $verifyUser->user->save();
                $verifyUser->email_token_used = true;
                $verifyUser->save();
                return response()->json([
                    'error' => false,
                    'message' => trans('validation.register.verify.email.success')
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => trans('validation.register.verify.email.verified')
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                'error' => false,
                'message' => trans('validation.register.verify.email.unidentified')
            ], Response::HTTP_ACCEPTED);
        }
    }
    
}
