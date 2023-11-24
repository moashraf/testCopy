<?php

namespace App\Traits;

use App\Http\Services\smsGateways\Whysms;
use App\Models\School\Manager;
use App\Models\Verification_code;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

trait OtpSmsTrait
{
    /**
     * @param Request $request
     * @return $this|false|string
     */


    public function check_otp_register($phone_number, $digits, $client_id = null)
    {

        #Validation Logic
        $verification_code  = Verification_code::where('phone_number', $phone_number)->first();
        $now = Carbon::now();


        // opt sent already
        if ($verification_code) {

            //check if it has been actived already
            // if ($verification_code->verified == 1 && $now->isAfter($verification_code->expire_at)) {
            //     return response()->json([
            //         "status" => "done",
            //         "msg" => "هذا الجوال تم تفعيله من قبل",
            //     ]);
            // }

            $verification_code_with_digits = $verification_code->where('otp', $digits)->first();

            //verficiation with digits 
            if ($verification_code_with_digits) {
                if ($verification_code_with_digits && $now->isAfter($verification_code->expire_at)) {
                    return response()->json([
                        "status" => false,
                        "msg" => "ناسف ولكن انتهي وقت تفعيل هذا كود",
                    ]);
                }
                //verified with digits
                else {
                    $verification_code->verified = 1;
                    $verification_code->save();
                    return response()->json([
                        "status" => 'done',
                        "msg" => "تم تفعيل جوالك بنجاح",
                    ]);
                }
            }
            //otp is not correct
            elseif ($verification_code_with_digits == null && $digits !== null) {
                return response()->json([
                    "status" => false,
                    "msg" => "كود التفعيل غير صحيح",
                ]);
            }
            //check when the last time otp was sent
            else {
                if ($verification_code && $now->isBefore($verification_code->expire_at)) {
                    return response()->json([
                        "status" => true,
                        "msg" => "نحن قمنا بارسال رمز التفعيل بالفعل. يجب عليك الانتظار لمدة ١٢٠ ثانية",
                        "diff_seconds" => $now->diffInSeconds($verification_code->expire_at),
                    ]);
                } else {
                    //-- Generate An OTP
                    $verificationCode = $this->generateOtp($phone_number, 1);
                    $sms_mesg_cont = "اهلا بك في لام, رمز التفعيل الخاص بك: " . $verificationCode['otp'] . " لا تخبر احدا بهذا الكود";
                    $sms_send = app(Whysms::class)->sendSms($phone_number, $sms_mesg_cont);
                    return response()->json([
                        "status" => true,
                        "msg" => "لقد تم ارسال كود تفعيل بالفعل للهاتف ولكن سوف نرسل واحد اخر الان",
                        "diff_seconds" => $now->diffInSeconds($verificationCode['expire_at']),
                    ]);
                }
            }
        }
        // first time otp
        else {
            //-- Generate An OTP
            $verificationCode = $this->generateOtp($phone_number, 1);
            $sms_mesg_cont = "اهلا بك في لام, رمز التفعيل الخاص بك: " . $verificationCode['otp'] . " لا تخبر احدا بهذا الكود";
            $sms_send = app(Whysms::class)->sendSms($phone_number, $sms_mesg_cont);
            return response()->json([
                "status" => true,
                "msg" => "لقد تم ارسال رمز التفعيل لجوالك",
                "diff_seconds" => $now->diffInSeconds($verificationCode['expire_at']),
            ]);
        }
    }

    public function check_otp_login_trait($digits)
    {

        $check_session = session()->get('logn_otp');

        $phone_number = $check_session['phone_number'];
        $token = $check_session['token'];

        $verification_code  = Verification_code::where('type', 2)
            ->where('phone_number', $phone_number)
            ->where('token', $token)->where('otp', $digits)->first();
        $now = Carbon::now();

        if ($verification_code && $now->isAfter($verification_code->expire_at)) {
            $verification_code->delete();
            Session::forget('logn_otp');
            return response()->json([
                "status" => false,
                "msg" => "ناسف ولكن انتهي وقت تفعيل هذا كود",
            ]);
        } elseif ($verification_code && $now->isBefore($verification_code->expire_at)) {
            $verification_code->delete();
            Session::forget('logn_otp');
            $manager = Manager::where('type', 1)->where('phone_number', $verification_code->phone_number)->find($verification_code->manager_id);
            Auth::guard('school')->login($manager);

            return response()->json([
                "status" => 'done',
                "url" => route('school_route.choose_school'),
                "msg" => "تم التحقق من حسابك بنجاح وسوف يتم انتقالك للوحة التحكم",
            ]);
        } else {
            return response()->json([
                "status" => false,
                "msg" => "رمز التحقق غير صحيح",
            ]);
        }
    }

    public function check_otp_forget_password_trait($digits)
    {

        $check_session = session()->get('forget_password_otp');

        $phone_number = $check_session['phone_number'];
        $token = $check_session['token'];

        $verification_code  = Verification_code::where('type', 3)
            ->where('phone_number', $phone_number)
            ->where('token', $token)->where('otp', $digits)->first();
        $now = Carbon::now();

        if ($verification_code && $now->isAfter($verification_code->expire_at)) {
            $verification_code->delete();
            Session::forget('forget_password_otp');
            return response()->json([
                "status" => false,
                "msg" => "ناسف ولكن انتهي وقت تفعيل هذا كود",
            ]);
        } elseif ($verification_code && $now->isBefore($verification_code->expire_at)) {

            $verificationCode = $this->generateOtp($check_session['phone_number'], 4, $verification_code->manager_id);
            session()->put('new_forget_password_otp', [
                "phone_number" => $check_session['phone_number'],
                "token" => $verificationCode['token'],
            ]);

            $verification_code->delete();
            Session::forget('forget_password_otp');

            return response()->json([
                "status" => 'done',
                "msg" => "تم التحقق من حسابك بنجاح وسوف يتم انتقالك لاستعادة كلمة المرور",
            ]);
        } else {
            return response()->json([
                "status" => false,
                "msg" => "رمز التحقق غير صحيح",
            ]);
        }
    }

    //for otp generation
    //otp type:1- register, 2- login, 3- foreget passwrod, 4- password page
    public function generateOtp($phone_number, $type, $manager_id = null)
    {
        # User Does not Have Any Existing OTP
        $verificationCode = Verification_code::where('type', $type)
            ->where('phone_number', $phone_number)->latest()->first();

        $now = Carbon::now();

        if ($verificationCode && $now->isBefore($verificationCode->expire_at)) {
            return [
                "status" => false,
                "msg" => "نحن قمنا بارسال رمز التفعيل بالفعل. يجب عليك الانتظار لمدة ١٢٠ ثانية",
                "type" => $type,
                "phone_number" => $verificationCode->phone_number,
                'otp' => $verificationCode->otp,
                'token' => $verificationCode->token,
                'expire_at' => $verificationCode->expire_at,
            ];
        }

        $token = Str::random(64);

        if ($verificationCode) {
            $otp = rand(1234, 9999);
            $expire_at = Carbon::now()->addMinutes(2);
            $verificationCode->manager_id = $manager_id;
            $verificationCode->otp = $otp;
            $verificationCode->token = $token;
            $verificationCode->expire_at = $expire_at;
            $verificationCode->verified = 0;
            $verificationCode->save();
            return [
                "status" => true,
                "type" => $type,
                "phone_number" => $verificationCode->phone_number,
                'otp' => $otp,
                'token' => $token,
                'expire_at' => $expire_at,
            ];
        } else {
            // Create a New OTP
            $verification_code = Verification_code::create([
                'type' => $type,
                'manager_id' => $manager_id,
                'phone_number' => $phone_number,
                'otp' => rand(1234, 9999),
                'token' => $token,
                'expire_at' => Carbon::now()->addMinutes(2),
            ]);
            return [
                "status" => true,
                "type" => $type,
                "phone_number" => $verification_code->phone_number,
                'otp' => $verification_code->otp,
                'token' => $verification_code->token,
                'expire_at' => $verification_code->expire_at,
            ];
        }
    }
}
