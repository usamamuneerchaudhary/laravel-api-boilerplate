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
     * @return JsonResponse
     * @throws \Twilio\Exceptions\TwilioException
     */
    public function sendSMS()
    {
        $user = \auth()->user();
        $account_sid = 'ACd71b4f57b3f2188a7847282cfe38f9c6';
        $auth_token = 'a32007b2900655f3210f572fd43cf8d8';
        $twilio_number = "+12242879218";
        if (VerifyUser::where('user_id', $user->id)->exists()) {
            $code = VerifyUser::where('user_id', $user->id)->first()->sms_token;
        }
        try {
            $client = new Client($account_sid, $auth_token);
            $client->messages->create(
                $user->phone_number,
                [
                    'from' => $twilio_number,
                    'body' => 'Your Rentable PK verification code is:' . $code
                ]
            );
            return response()->json([
                'success' => true,
                'message' => 'Please check your Mobile Number for the verification code'
            ], Response::HTTP_OK);
        } catch (ConfigurationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }

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


    /**
     * @param $code
     * @return JsonResponse
     */
    public function verifyUserBySMS($code)
    {
        $verifyUser = VerifyUser::where('sms_token', $code)->first();
        if (isset($verifyUser)) {
            $user = $verifyUser->user;
            if (!$user->verified_by_sms) {
                $verifyUser->user->verified_by_sms = true;
                $verifyUser->user->update();
                $verifyUser->sms_token_used = true;
                $verifyUser->update();
                return response()->json([
                    'error' => false,
                    'message' => trans('validation.register.verify.sms.success')
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => trans('validation.register.verify.sms.verified')
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                'error' => false,
                'message' => trans('validation.register.verify.sms.unidentified')
            ], Response::HTTP_ACCEPTED);
        }
    }
}
