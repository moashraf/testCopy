<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequest;
use App\Http\Services\smsGateways\Whysms;
use App\Models\Branch\Appointment;
use App\Models\Branch\Appointment\Rate_appointment;
use App\Models\Branch\Branch;
use App\Models\Branch\Lab;
use App\Models\Branch\Package;
use App\Models\Branch\Slider;
use App\Models\Branch\Tag;
use App\Models\Branch\Trip;
use App\Models\Branch\Unit;
use App\Models\Branch\Unit_offer;
use App\Models\Branch\Unit_tag;
use App\Models\Branch\Visa;
use App\Models\Cat\Article\Article;
use App\Models\Invoice\Coupon;
use App\Models\Invoice\Invoice;
use App\Models\Invoice\Invoice_item;
use App\Models\location\City;
use App\Models\location\Country;
use App\Models\Patient\Cancel_reason_cat;
use App\Models\Patient\Destination;
use App\Models\Patient\From_recourse;
use App\Models\Patient\Image_destination;
use App\Models\Patient\Medicine;
use App\Models\Patient\Patient;
use App\Models\Patient\Service_item;
use App\Models\Patient\Specialty_cat;
use App\Models\Patient\Treatment;
use App\Models\Verification_code;
use App\Rules\CouponRule;
use App\Rules\Recaptcha;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use App\Models\Patient\Service_inv_cat as PatientService_inv_cat;
use Illuminate\Support\Facades\Mail;
use App\Mail\Regiser_client_otp_mail;
use App\Mail\Forget_password_client_mail;
use App\Models\Patient\Password_reset;
use App\Models\School\Manager;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Traits\OtpSmsTrait;
use Illuminate\Support\Facades\Session;

class ClientAuthCont extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use OtpSmsTrait;

    public function index()
    {
        return "soon";
    }


    public function login()
    {
        return view('website/auth/login');
    }

    public function login_otp(Request $request)
    {
        //specify your custom message here
        $messages = [
            'required' => 'الحقل :attribute مطلوب',
            'string'    => 'The :attribute must be text format',
            'file'    => 'The :attribute must be a file',
            'mimes' => 'Supported file format for :attribute are :mimes',
            'max'      => 'الحقل :attribute يحب ان لا يتجاوز :max',
            'unique' => 'رقم الجوال مسجل في لام بالفعل',
            'numeric' => 'الحقل :attribute يجب ان يكون رقما',
            'digits_between' => ':attribute يجب ان يكون بين :min و :max',
        ];

        // Validate the form data
        $this->validate($request, [
            'phone_number'   => 'required',
            'password' => 'required',
        ], $messages);

        $phone_number =  $request->input('phone_number');
        $password =  $request->input('password');

        if (is_numeric($phone_number)) {
            $field = 'phone_number';
        } elseif (filter_var($phone_number, FILTER_VALIDATE_EMAIL)) {
            $field = 'email';
        } else {
            $field = 'username';
        }

        $client = Manager::where('type', 1)->where($field, $phone_number)->first();

        //Check password hash
        if ($client !== null && Hash::check($password, $client->password)) {

            //username & password matches
            $verificationCode = $this->generateOtp($client->phone_number, 2, $client->id);

            // send sms
            if ($verificationCode['status'] == true) {
                $sms_mesg_cont = "مرحبا $client->first_name في منصة لام رمز التحقق: " . $verificationCode['otp'];
                $sms_send = app(Whysms::class)->sendSms($client->phone_number, $sms_mesg_cont);

                if ($sms_send['status'] !== "success") {
                    return back()
                        ->withInput($request->input())
                        ->withErrors([
                            'phone_number' => 'هناك خطا في ارسال رمز التفعيل. الرجاء الاتصال بالدعم',
                        ]);
                }
            }

            session()->put('logn_otp', [
                "phone_number" => $client->phone_number,
                "token" => $verificationCode['token'],
            ]);

            return redirect()->route('school_route.enter_otp');
        } else {
            //Invalid login username or password!
            // if unsuccessful, then redirect back to the login with the form data
            return back()
                ->withInput($request->input())
                ->withErrors([
                    'phone_number' => 'رقم الجوال, البريد الالكتروني او الباسورد غير صحيح',
                ]);
        }
    }


    public function enter_otp()
    {

        $check_session = session()->get('logn_otp');

        if (!$check_session) {
            return redirect()->route('school_route.login');
        }

        $phone_number = $check_session['phone_number'];
        $token = $check_session['token'];

        $verification_code  = Verification_code::where('type', 2)
            ->where('phone_number', $phone_number)->where('token', $token)->first();
        $now = Carbon::now();

        if (!$verification_code) {
            $verification_code->delete();
            Session::forget('logn_otp');
            return redirect()->route('school_route.login')->withErrors([
                'error' => 'Unexpected error [2041312]',
            ]);
        } elseif ($verification_code && $now->isAfter($verification_code->expire_at)) {
            $verification_code->delete();
            Session::forget('logn_otp');
            return redirect()->route('school_route.login')->withErrors([
                'error' => "ناسف ولكن تم انتهاء جلسة تسجيل الدخول",
            ]);
        }

        $short_phone_number = substr($phone_number, -3);

        $diff_seconds = $now->diffInSeconds($verification_code->expire_at);

        return view('website.auth.enter_otp', compact('short_phone_number', 'diff_seconds'));
    }


    public function check_otp_login(Request $request)
    {
        //specify your custom message here
        $messages = [
            'required' => 'الحقل :attribute مطلوب',
            'string'    => 'The :attribute must be text format',
            'file'    => 'The :attribute must be a file',
            'mimes' => 'Supported file format for :attribute are :mimes',
            'max'      => 'الحقل :attribute يحب ان لا يتجاوز :max',
            'unique' => 'رقم الجوال مسجل في لام بالفعل',
            'numeric' => 'الحقل :attribute يجب ان يكون رقما',
            'digits_between' => ':attribute يجب ان يكون بين :min و :max',

        ];

        $resend_status =  $request->input('resend');

        if ($resend_status !== "true") {
            $this->validate($request, [
                'digits' => ['required', 'min:4', 'max:4'],
            ], $messages);
        }

        $check_session = session()->get('logn_otp');

        if (!$check_session) {
            return response()->json([
                "status" => false,
                "msg" => "هناك مشكلة غير متوقعة (UN000003)",
            ]);
        }

        $phone_number = $check_session['phone_number'];
        $token = $check_session['token'];

        $verification_code  = Verification_code::where('type', 2)
            ->where('phone_number', $phone_number)->where('token', $token)->first();
        $now = Carbon::now();
        $digits =  $request->input('digits');

        if (!$verification_code) {
            $verification_code->delete();
            Session::forget('logn_otp');
            return redirect()->route('school_route.login')->withErrors([
                'error' => 'Unexpected error [2041312]',
            ]);
        } elseif ($verification_code && $now->isAfter($verification_code->expire_at) && $resend_status == true) {

            $otp = rand(1234, 9999);
            $token = Str::random(64);
            $expire_at = Carbon::now()->addMinutes(2);
            $verification_code->otp = $otp;
            $verification_code->token = $token;
            $verification_code->expire_at = $expire_at;
            $verification_code->verified = 0;
            $verification_code->save();

            session()->put('logn_otp', [
                "phone_number" => $verification_code->phone_number,
                "token" => $token,
            ]);

            $client = Manager::where('phone_number', $phone_number)->where('type', 1)->first();

            $sms_mesg_cont = "مرحبا $client->first_name في منصة لام رمز التحقق: " . $otp;
            $sms_send = app(Whysms::class)->sendSms($client->phone_number, $sms_mesg_cont);

            if ($sms_send['status'] !== "success") {
                return response()->json([
                    "status" => false,
                    "msg" => "ناسف ولكن هناك مشكلة في تسجيل الدخول. الرجاء التحدث الي الدعم",
                ]);
            }
            return response()->json([
                "status" => "resend",
                "msg" => "تم ارسال كود التحقق الي جوالك",
                "diff_seconds" => $now->diffInSeconds($verification_code->expire_at),
            ]);
        } else {
            $otp = $this->check_otp_login_trait($digits);
            return $otp;
        }
    }


    public function login_sub(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'phone_number'   => 'required',
            'password' => 'required',
            // 'g-recaptcha-response' => ['required', new Recaptcha()],
        ]);

        $fieldType = filter_var($request->input('phone_number'), FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';

        // Attempt to log the user in
        if (Auth::guard('school')->attempt([$fieldType => $request->input('phone_number'), 'password' => $request->password], $request->remember)) {
            $request->session()->regenerate();
            // if successful, then redirect to their intended location
            return redirect()->intended(route('school_route.home'));
        }

        // if unsuccessful, then redirect back to the login with the form data
        return back()->withErrors([
            'phone_number' => 'Your Phone number or Password is not correct!',
        ]);
    }


    function logout()
    {
        Auth::guard('school')->logout();
        session()->flash('success', 'لقد تم تسجيل خروجك بنجاح');
        return redirect()->route('school_route.login');
    }



    public function register()
    {
        return view('website.auth.register');
    }

    public function register_store(Request $request)
    {
        // return  $this->validate($request, [
        //     'g-recaptcha-response' => ['required', new Recaptcha()],
        // ]);

        //specify your custom message here
        $messages = [
            'required' => 'الحقل :attribute مطلوب',
            'string'    => 'The :attribute must be text format',
            'file'    => 'The :attribute must be a file',
            'mimes' => 'Supported file format for :attribute are :mimes',
            'max'      => 'الحقل :attribute يحب ان لا يتجاوز :max',
            'unique' => 'رقم الجوال مسجل في لام بالفعل',
            'numeric' => 'الحقل :attribute يجب ان يكون رقما',
            'digits_between' => ':attribute يجب ان يكون بين :min و :max',
        ];

        $this->validate($request, [
            'first_name' => ['required', 'min:3', 'max:50'],
            'password' => [
                'required', 'min:8', 'max:40',
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'phone_number' => 'required|unique:managers,phone_number',
            'email' => 'required|email:rfc,dns|unique:managers,email',
            'digit_1' => 'required|integer|between:0,10',
            'digit_2' => 'required|integer|between:0,10',
            'digit_3' => 'required|integer|between:0,10',
            'digit_4' => 'required|integer|between:0,10',
        ]);

        $now = Carbon::now();

        // phone number otp 
        $phone_number = $request->input('phone_number');
        $digits = $request->input('digit_1') . $request->input('digit_2') . $request->input('digit_3') . $request->input('digit_4');

        $verification_code  = Verification_code::where('phone_number', $phone_number)->where('otp', $digits)->where('verified', 1)->first();

        if ($verification_code == null) {
            return back()->withInput()->withErrors([
                'msg' => 'كود التفعيل غير صحيح او لم يتم ضغط زر التفعيل',
            ]);
        } elseif ($verification_code && $now->isAfter($verification_code->expire_at)) {
            return back()->withInput()->withErrors([
                'msg' => "ناسف ولكن انتهي وقت تفعيل هذا الكود",
            ]);
        }

        //create the new serial code 000001
        $new_serial_number_patient = serial_number('managers');

        $manager = Manager::create([
            'new_id' => $new_serial_number_patient,
            'code' => "MAG-" . generateRandomString(6),
            'first_name' => $request->input('first_name'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'inactive' => 0,
            'from_recourse_id' => 6,
        ]);

        $verification_code->delete();

        Auth::guard('school')->login($manager);

        session()->flash('success', 'تم تسجيلك بنجاح في منصة لام');
        return redirect()->route('school_route.dashboard');
    }


    public function forget_password()
    {
        return view('website.auth.forget_password.forget_password_email');
    }

    public function check_email_forget_password(Request $request)
    {
        //specify your custom message here
        $messages = [
            'required' => 'الحقل :attribute مطلوب',
        ];

        // Validate the form data
        $this->validate($request, [
            'email' => 'required|email:rfc,dns',
        ], $messages);

        $email =  $request->input('email');

        $client = Manager::select('phone_number')->where('email', $email)->where('type', 1)->first();

        //Check password hash
        if (!$client) {
            //Invalid login username or password!
            // if unsuccessful, then redirect back to the login with the form data
            return back()
                ->withInput($request->input())
                ->withErrors([
                    'phone_number' => 'لا يوجد حساب مرتبط بهذا البريد الالكتروني',
                ]);
        } else {

            $short_phone_number = substr($client->phone_number, -3);
            return view('website.auth.forget_password.forget_password_phone', compact('email', 'short_phone_number'));
        }
    }


    public function check_phone_forget_password(Request $request)
    {
        //specify your custom message here
        $messages = [
            'required' => 'الحقل :attribute مطلوب',
            'string'    => 'The :attribute must be text format',
            'file'    => 'The :attribute must be a file',
            'mimes' => 'Supported file format for :attribute are :mimes',
            'max'      => 'الحقل :attribute يحب ان لا يتجاوز :max',
            'unique' => 'رقم الجوال مسجل في لام بالفعل',
            'numeric' => 'الحقل :attribute يجب ان يكون رقما',
            'digits_between' => ':attribute يجب ان يكون بين :min و :max',
        ];

        // Validate the form data
        $this->validate($request, [
            'phone_number' => 'required|numeric',
            'email' => 'required|email:rfc,dns',
        ], $messages);

        $phone_number =  $request->input('phone_number');
        $email =  $request->input('email');
        $password =  $request->input('password');

        $client = Manager::where('phone_number', $phone_number)->where('email', $email)->where('type', 1)->first();

        //Check password hash
        if (!$client) {
            //Invalid login username or password!
            // if unsuccessful, then redirect back to the login with the form data
            return redirect()->route('school_route.forget_password')->withInput()->withErrors([
                'msg' => "رقم الجوال غير صحيح",
            ]);
        } else {

            $verification_code  = Verification_code::where('type', 3)
                ->where('phone_number', $phone_number)->first();

            if (!$verification_code) {
                //username & password matches
                $verificationCode = $this->generateOtp($client->phone_number, 3, $client->id);
                $now = Carbon::now();
                // send sms
                if ($verificationCode['status'] == true) {
                    $sms_mesg_cont = "مرحبا $client->first_name في منصة لام رمز استعادة كلمة المرور: " . $verificationCode['otp'];
                    $sms_send = app(Whysms::class)->sendSms($client->phone_number, $sms_mesg_cont);

                    if ($sms_send['status'] !== "success") {
                        return back()
                            ->withInput($request->input())
                            ->withErrors([
                                'phone_number' => 'رقم الجوال, البريد الالكتروني او الباسورد غير صحيح',
                            ]);
                    }

                    $short_phone_number = substr($phone_number, -3);
                    $diff_seconds = $now->diffInSeconds($verificationCode['expire_at']);

                    session()->put('forget_password_otp', [
                        "phone_number" => $verificationCode['phone_number'],
                        "token" => $verificationCode['token'],
                    ]);

                    return view('website.auth.forget_password.enter_otp_forget_password', compact('short_phone_number', 'diff_seconds'));
                }
            } else {
                $verification_code->delete();
                return back()
                    ->withInput($request->input())
                    ->withErrors([
                        'msg' => "ناسف ولكن هناك خطا غير متوقع (UNX 0000004)",
                    ]);
            }
        }
    }


    public function check_otp_forget_password(Request $request)
    {
        //specify your custom message here
        $messages = [
            'required' => 'الحقل :attribute مطلوب',
            'string'    => 'The :attribute must be text format',
            'file'    => 'The :attribute must be a file',
            'mimes' => 'Supported file format for :attribute are :mimes',
            'max'      => 'الحقل :attribute يحب ان لا يتجاوز :max',
            'unique' => 'رقم الجوال مسجل في لام بالفعل',
            'numeric' => 'الحقل :attribute يجب ان يكون رقما',
            'digits_between' => ':attribute يجب ان يكون بين :min و :max',

        ];

        $resend_status =  $request->input('resend');

        if ($resend_status !== "true") {
            $this->validate($request, [
                'digits' => ['required', 'min:4', 'max:4'],
            ], $messages);
        }

        $check_session = session()->get('forget_password_otp');

        if (!$check_session) {
            return response()->json([
                "status" => false,
                "msg" => "هناك مشكلة غير متوقعة (UN000005)",
            ]);
        }

        $phone_number = $check_session['phone_number'];
        $token = $check_session['token'];

        $verification_code  = Verification_code::where('type', 3)
            ->where('phone_number', $phone_number)->where('token', $token)->first();
        $now = Carbon::now();
        $digits =  $request->input('digits');

        if (!$verification_code) {
            $verification_code->delete();
            Session::forget('forget_password_otp');
            return redirect()->route('school_route.login')->withErrors([
                'error' => 'Unexpected error [2041312]',
            ]);
        } elseif ($verification_code && $now->isAfter($verification_code->expire_at) && $resend_status == true) {

            $otp = rand(1234, 9999);
            $token = Str::random(64);
            $expire_at = Carbon::now()->addMinutes(2);
            $verification_code->otp = $otp;
            $verification_code->token = $token;
            $verification_code->expire_at = $expire_at;
            $verification_code->verified = 0;
            $verification_code->save();

            session()->put('forget_password_otp', [
                "phone_number" => $verification_code->phone_number,
                "token" => $token,
            ]);

            $client = Manager::where('phone_number', $phone_number)->where('type', 1)->first();

            $sms_mesg_cont = "مرحبا $client->first_name في منصة لام رمز التحقق: " . $otp;
            $sms_send = app(Whysms::class)->sendSms($client->phone_number, $sms_mesg_cont);

            if ($sms_send['status'] !== "success") {
                return response()->json([
                    "status" => false,
                    "msg" => "ناسف ولكن هناك مشكلة في استرجاع كلمة المرور. الرجاء التحدث الي الدعم",
                ]);
            }
            return response()->json([
                "status" => "resend",
                "msg" => "تم ارسال رمز التحقق الي جوالك",
                "diff_seconds" => $now->diffInSeconds($verification_code->expire_at),
            ]);
        } else {
            $otp = $this->check_otp_forget_password_trait($digits);
            return $otp;
        }
    }

    public function new_page_forget_password()
    {
        $check_session = session()->get('new_forget_password_otp');

        if (!$check_session) {
            return redirect()->route('school_route.login');
        }

        $phone_number = $check_session['phone_number'];
        $token = $check_session['token'];

        $verification_code  = Verification_code::where('type', 4)
            ->where('phone_number', $phone_number)->where('token', $token)->first();
        $now = Carbon::now();

        if (!$verification_code) {
            $verification_code->delete();
            Session::forget('new_forget_password_otp');
            return redirect()->route('school_route.login')->withErrors([
                'error' => 'Unexpected error [2041312]',
            ]);
        } elseif ($verification_code && $now->isAfter($verification_code->expire_at)) {
            $verification_code->delete();
            Session::forget('new_forget_password_otp');
            return redirect()->route('school_route.login')->withErrors([
                'error' => "ناسف ولكن تم انتهاء جلسة استعادة كلمة المرور",
            ]);
        }

        return view('website.auth.forget_password.new_page_forget_password');
    }


    public function new_page_forget_password_store(Request $request)
    {

        $request->validate([
            'password' => [
                'required', 'confirmed', 'min:8', 'max:40',
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'password_confirmation' => 'required'
        ]);

        $check_session = session()->get('new_forget_password_otp');

        if (!$check_session) {
            return redirect()->route('school_route.login');
        }

        $phone_number = $check_session['phone_number'];
        $token = $check_session['token'];

        $verification_code  = Verification_code::where('type', 4)
            ->where('phone_number', $phone_number)->where('token', $token)->first();
        $now = Carbon::now();

        if (!$verification_code) {
            $verification_code->delete();
            Session::forget('new_forget_password_otp');
            return redirect()->route('school_route.login')->withErrors([
                'error' => 'Unexpected error [2041312]',
            ]);
        } elseif ($verification_code && $now->isAfter($verification_code->expire_at)) {
            $verification_code->delete();
            Session::forget('new_forget_password_otp');
            return redirect()->route('school_route.login')->withErrors([
                'error' => "ناسف ولكن تم انتهاء جلسة استعادة كلمة المرور",
            ]);
        } else {

            $manager = Manager::where('phone_number', $verification_code->phone_number)->where('type', 1)->find($verification_code->manager_id);
            $manager->password = bcrypt($request->input('password'));
            $manager->save();

            return redirect()->route('school_route.login')
                ->with('success', 'تم تغيير كلمة المرور بنجاح');
        }
    }


    //for select input ajax to send the cities beasd on the given country
    public function createcityajax($id)
    {
        return City::where('country_id', $id)->get();
    }


    public function check_otp(Request $request)
    {
        //specify your custom message here
        $messages = [
            'required' => 'الحقل :attribute مطلوب',
            'string'    => 'The :attribute must be text format',
            'file'    => 'The :attribute must be a file',
            'mimes' => 'Supported file format for :attribute are :mimes',
            'max'      => 'الحقل :attribute يحب ان لا يتجاوز :max',
            'unique' => 'رقم الجوال مسجل في لام بالفعل',
            'numeric' => 'الحقل :attribute يجب ان يكون رقما',
            'digits_between' => ':attribute يجب ان يكون بين :min و :max',

        ];

        $this->validate($request, [
            'phone_number' => 'required|unique:managers,phone_number|numeric',
            'digits' => ['nullable', 'min:4', 'max:4'],
        ], $messages);


        $phone_number = $request->input('phone_number');
        $digits =  $request->input('digits');

        $otp = $this->check_otp_register($phone_number, $digits);

        return $otp;
    }
}
