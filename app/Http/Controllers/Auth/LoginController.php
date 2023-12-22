<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Rules\Recaptcha;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use AuthenticatesAndRegistersUsers, ThrottlesLogins ;

class LoginController extends Controller
{


    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    //to login with email and mobile
    public function username()
    {
        $login = request()->input('identify');

        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $field = 'email';
        } else {
            $field = 'phone_number';
        }

        request()->merge([$field => $login]);

        return $field;
    }

    public function validateLogin(Request $request)
    {
        //Validate your form data here
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            'g-recaptcha-response' => ['required', new Recaptcha()],
        ]);
    }

    //to send the error msg
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'identify' => 'Sorry! your mobile, email, or password are    not correct',
        ]);
    }

    protected function redirectTo()
    {
        
        if (Auth::user()->role_id == 1) {
            return route('sett.home');
        } else {
            return route('sett.home');
        }

    }

    public function logout(){
        Auth::logout();
        return Redirect::to('/prox');
    }
    

}