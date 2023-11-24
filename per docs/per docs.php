<?php /* 

//to start laravel
php artisan serve

how does laravel it works
1- we bulid the model that represents a table in database and every db table must have a model
2- we bulid a route which is the URL for the page, and connect it to the conterller
3- the contler, is the backend (php) and db dealer and contrall the model and the view and tranfare information between all pages and db
    //conect the route to the view(html frontend code)
    //conect the database(model) and recive information to pass it to the view
    //recive info from another view page to get other data
4- buliding our view (html)

example: if we need to bulid a table shows all users and delete them
        1-create 2 routes contining 2 contllers for each, one conttler for the view (html) to show the table and deal with db to selete the wanted data,
        //the other for the conttler(backend) to delete
        2- the first contteler for view will dealer with the db and secelet table and pass it to the view
        3- the view will recive the data and show it and have (a hrf) to go to the other route that has the contteler that deal with db
        4- cinttler will recive the data and deal with the db to delete it
        



//laravel pathes
//resource:view : html
//public:view : css, js, and img
//app/Controllers: Controllers has the backend code (php and database)
//route/to create url and connect view and Controllers



index: 
1- General
    1.2 Installing Laravel
2- Route
3- Authentication
    3.1 Built-in login and resgister authintcation kits
    3.2 bulding authintcation login and resgister manilully
    3.3 Middleware
    3.4 Guard
4- Controller
5- model 
6- database
7- ajax
8- blade view (html)
9- Authorization
10- Parameters
--------------------------------------------------------------


///// ------------------------------- 1- General ------------------------------- /////

===== namespace it's where you put the path the cureet page ===== 
// defined as a class of elements in which each element has a different name to that associated class
    (namespace App\Http\Controllers;)
===== (use) is to use the path that has a namespace inside another page 
    (use App\Http\Controllers\ajaxtest;)


//composer dump-autoload


------- diffrenece in Authentication and Authorization  -------

Authentication: is how to make the user authenticated and stored in session to see the adminpage for example
Authorization: even though a user is authenticated, they may not be authorized to update or delete certain Eloquent models or database records managed by your application.

middleware: is to protacte the route and allows what you want to enter, it uses guards, or gates , policies to make the user enter the page
guards: what users table in the database to use to make thier users authenticated such as users, admins or doctors
gate: is to allow spefici users or user group to do some action like update or delete but without using a model
policies: same as gate but it has many logic (ex gates) inside to to allow spefici users or user group to do some action like update or delete
and it is deal with a model
role: is the user type, admin or user, doctor
permstion: can edit or delete or only see


///// ------------------------------- 1.2 Installing Laravel ------------------------------- /////

1- download Composer

2- download the Laravel installer using Composer:
    (composer create-project laravel/laravel example-app)
3 (composer global require laravel/installercomposer global require laravel/installer)

//This directory exists in different locations based on your operating system; however, some common locations include:
    macOS: $HOME/.composer/vendor/bin (~/Library/.composer/vendor/bin/)
    Windows: %USERPROFILE%\AppData\Roaming\Composer\vendor\bin

---- after installation ----
1- change the application name in .env and you can use it with (config('app.name');)
2- intall authentication

/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
brew tap shivammathur/php
brew tap shivammathur/php/php@8.0

///// ------------------------------- 2- Route ------------------------------- /////

//route is the url of the page and must be bulid at first, and it is connected to contrller to do its logic and actions
All Laravel routes are defined in your route file
For most applications, you will begin by defining routes in your routes/web.php file. The routes defined in routes/web.php

after creation we add code to (app/Providers/RouteServiceProvider.php)


------ 2.1 define a controller ------
Route::get('/user/{id}', [controllerName::class, 'show']);


------ 2.2 define view ------
Route::view('/welcome', 'welcome');




------ 2.3- Named Routes ------
it allows to generate URLs or redirects for specific routes. You may specify a name for a route by chaining the name 
//Route names should always be unique.

Route::get('/user/profile', function () {
    //
})->name('profile');




------ 2.4- resource route ------
//(resouce) which has index,show,update, and delete and you can acess to it like /photos or photos/create
in route:
use App\Http\Controllers\PhotoController;
Route::resource('photos', PhotoController::class); 

==to make contoral for (resoruce)
php artisan make:controller PhotoController --resource

== the first page (contrall )will apear in the route name wil be (the index) fun inside the contraller

== acess it by {{ route('admin.users.index') }}

------ 2.5 - prefex ------

//it has a group of route which has the same url: prefex put a speific url before the url route inside it
//for example if the prefix name is admin so all the routes inside the prefex will be admin/RouteName
//we can use it instead of resouce but it is not recomened

Route::group([ 
  'prefix' => 'api/v1',
  'namespace' => 'Api',
   'middleware'  =>'cors'], function () {
    Route::get('create', function () {
        return view('welcome');
    });
    Route::get('/store', [ajaxtest::class, 'store'])->name('storeajax');
});

Route::prefix('admin')->group(function () {
    Route::get('/users', function () {
        // Matches The "/admin/users" URL
    });
});

------ 2.6 - group Routes ------
it allows you to share route attributes, such as middleware, across a large number of routes without needing to define those attributes on each individual route.

Route::middleware(['first', 'second'])->group(function () {
    Route::get('/', function () {
        // Uses first & second Middleware
    });

    Route::get('user/profile', function () {
        // Uses first & second Middleware
    });
});

------ 2.7 - Redirect Routes ------
    Route::redirect('/here', '/there');
    Route::redirect('/here', '/there', 301); //By default, Route::redirect returns a 302 status code. You may customize the status code using the optional third parameter:

------ Route Parameters ------
Route::get('/user/{id}', function ($id) {
    return 'User '.$id;
});


--------------------------------------------------------------Route








///// ------------------------ 3- Authentication ------------------------ /////

Authentication provide methods that allow you to verify a user's credentials and authenticate the user.
In addition, these services will automatically store the proper authentication data in the user's session and issue the user's session cookie.
--
how authentication works. When using a web browser, a user will provide their username and password via a login form.
If these credentials(data) are correct, the application will store information about the authenticated user in the user's session.
then a cookie issued to the browser contains the session ID so that subsequent requests to the application can associate the user with the correct session.
After the session cookie is received, the application will retrieve the session data based on the session ID,
note that the authentication information has been stored in the session, and will consider the user as "authenticated".
--
in other words, authentication is managed by sessions which take the input parameters such as email or username and password,
for user identification. If these parameters match, the user is said to be authenticated.

--
At its core, Laravel's authentication facilities are made up of ("guards" and "providers"). Guards define how users are authenticated for each request.
For example, Laravel ships with a session guard which maintains state using session storage and cookies.

(Providers) define how users are retrieved from your persistent storage. Laravel ships with support for retrieving users using Eloquent and the database query builder.
However, you are free to define additional providers as needed for your application.
-----


Laravel includes built-in authentication and session services which are typically accessed via the (Auth) and (Session) facades.
These features provide cookie-based authentication for requests that are initiated from web browsers.

//note: (Auth::) is to acess to authentication

////note: the defulat guard for Auth:: (facade(a class)) is ('web') which uses ('user') table to do its requests and we can change it in config/auth.php (congif/auth.php(guards, providers))
////if we want to use another guard with Auth:: (facade(a class)) not the defult we would use: Auth::guard('admin')->user()





// -------- 3.1 Built-in login and resgister authintcation kits -------- //

These kits automatically scaffold your application with the routes, controllers, and views you need to register and authenticate your application's users.
They provide methods that allow you to verify a user's credentials and authenticate the user. In addition,
these services will automatically store the proper authentication data in the user's session and issue the user's session cooki

there are 3 typys of started kits you can use
    1- UI (laravel/ui) (the old and good one)
    2- Breeze (the easy and new one but does not include presets for Vue or React and also bostrap) (ver 8)
    3- Jetstream and Fortify (the complix one) (ver 8)


-------------- laravel UI --------------

------ install laravel UI ------ 

1- in terminal (composer require laravel/ui --dev) //install the Laravel UI official package for making auth scaffolding in Laravel
2- // // (php artisan ui vue --auth) if we want to use vue //After installation of Laravel UI package. We are now able to scaffold our auth with Bootstrap, Vue, React etc
3- // // (npm install && npm run dev) to install and run NPM dependencies //rembeber to install node.js
4- // run (php artisan migrate) for install tables in case is not exsits

---- login with mobile instead of email or with both ----

1- create a column in a table called mobile and resgiter it in the user model
2- add this method into the login controller. (the defult one: app/Http/Controllers/Auth/LoginController.php)
    (// app/Http/Controllers/Auth/LoginController.php
        public function username()
        {
            return 'username';// the wanted cloumn to login with
        })

3- then finally edit the login inputs and errors in html view (resources/view/auth)
    <div class="col-md-6">
        <input id="identify" type="text" class="form-control @error('identify') is-invalid @enderror" name="identify" value="{{ old('identify') }}" required autocomplete="identify" autofocus>

@error('identify')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
@enderror
    </div>

4- in case we want to login with both email or mobile in (app/Http/Controllers/Auth/LoginController.php)
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Http\Request;

    public function login(request $request){
        $input = $request->all();

        $this->validate($request, [

            'identify' => 'required',
            'password' => 'required',

        ]);
        $fieldType = filter_var($request->identify, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';

        if (Auth::attempt(array($fieldType => $input['identify'], 'password' => $input['password']))) {
            return redirect()->route('home');
        } else {
            return redirect()->route('login')
                ->with('error', 'Email-Address And Password Are Wrong.');
        }
    }

    or-
        public function username()
        {
            $login = request()->input('identify');
            if(is_numeric($login)){
                $field = 'phone';
            } elseif (filter_var($login, FILTER_VALIDATE_EMAIL)) {
                $field = 'email';
            } else {
                $field = 'username';
            }
            request()->merge([$field => $login]);
            return $field;
        }

        protected function sendFailedLoginResponse(Request $request)
        {
            throw ValidationException::withMessages([
                'identify' => [trans('auth.failed')],
            ]);
        }
    

----- redrict user after login -----
//in (app/Http/Controllers/Auth/LoginController.php) //or in RegisterController, and ResetPasswordController:

    protected function redirectTo()
    {
        if (Auth::user()->role_id == 0) {
            return '/home';
        } else {
            return '/dashboard2';
        }
    }

----- redrict user after logout -----
//in (app/Http/Controllers/Auth/LoginController.php) //or in RegisterController, and ResetPasswordController:

    public function logout(){
        Auth::logout();
        return Redirect::to('/prox');
    }
    
------ email verification and configration ------
// you must have a servicer to send emails
// you can have one for testing (https://mailtrap.io/signin)

1- to configrate the email service info in (.env) for example as following, rembmber to fill ( MAIL_FROM_ADDRESS)
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=465
    MAIL_USERNAME=99f977416baaef
    MAIL_PASSWORD=57150ce7c583d0
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS= shady@shady.com

2- go to the user model (users table) and insert the following trait in the main class title (class User extends Authenticatable).
    use Illuminate\Contracts\Auth\MustVerifyEmail;
    class User extends Authenticatable implements MustVerifyEmail()

3- goint to the route file (web) (Auth::routes();) and pass the following to make the user not entering the dashboard after regstering but the user must verify the email
    (Auth::routes('verify' => true);)

4- add new middlware to the dashboard to make the user with only virfied email to enter it
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

5- edit the forma that will be send to the email in (/resources/views/auth/verify.blade.php)

6- the conttler that contral the verification email (app/Http/Controllers/Auth/VerificationController.php)


------ if we want to change the table of users that be chacked

the defult table to chack the user info is users and if we want to change it in (config/auth) but we need to install new guard first
    protected function guard()
        {
            return Auth::guard('school');
        }


------ change url if the user not login

-- change in (Middleware\Authenticate)
 protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }


------ mutli auth for 2 different tables
1- add a new gurid for auth:: for the other table
2- bulid mainual login
3- in (Middleware/Authenticate)
    protected function redirectTo($request){
            if (! $request->expectsJson()) {
                if ($request->routeIs('patient.*')) {
                    return route('patient.login');
                }
                return route('login');
            }
    }
4- in (Middleware/RedirectIfAuthenticated)
    public function handle(Request $request, Closure $next, ...$guards)
        {
            $guards = empty($guards) ? [null] : $guards;
            foreach ($guards as $guard) {
                if (Auth::guard($guard)->check()) {
                    if($guard === 'patient'){
                        return redirect()->route('patient.profile');
                    }
                    return redirect(RouteServiceProvider::HOME);
                }
            }   
            return $next($request);
        }

------ all the auth routes

-- it can be finded in web.php
Auth::routes();

------ to change the error msg during login

    //to send the error msg
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'identify' => 'Sorry! your mobile, email, or password are    not correct',
        ]);
    }

------ Login and Register With Facebook Using Laravel Socialite ------
Laravel Socialite supports authentication with Facebook, Twitter, LinkedIn, Google, GitHub, GitLab, and Bitbucket.

1- in termnial, (composer require laravel/socialite)

2- get the app id and key by entering the deveolper pages for the soical media paltforms such as (http://developers.facebook.com)


------ other things ------

-- 1- change the dircation when a user successfully login the default auth system redirects the user to /home path
    we have to change (public const HOME = '/home';) in (app/providers/RouteServiceProvider)
    //or in contraller (Http/Controllers/Auth/LoginController.php)

-- 2- Laravel auth system by default check user email. If we want to check username instead of checking email then we have to add this method into the login controller. 
    (app/Http/Controllers/Auth/LoginController.php)
        public function username()
        {
            return 'username';
        }

-- 3- If you want to disable the new user registration system. Then go to the web.php route file and change the auth route.
    (Auth::routes(['register' => false]);)

-- 4- the pages view for laravel ui is in (resources/view/auth)

-- 5- to disable registration, rest passwrod, and verify, in route file in (Auth::routes();)
    Auth::routes([
        'register' => false, // Registration Routes...
        'reset' => false, // Password Reset Routes...
        'verify' => false, // Email Verification Routes...
    ]);


// -------- 3.2 bulding authintcation login and resgister manilully -------- //

//manilully, If you choose to not use this scaffolding, you will need to manage user authentication
//using the Laravel authentication classes directly. Don't worry, it's a cinch!
//We will access Laravel's authentication services via the Auth facade,

//note: the defulat guard for Auth:: is ('web') and it is using ('users') table to do its requests 
which we can changeed like Auth::guard('admin')->attempt([])


---- registration ----

//--- 1: create the route of both regstier form and its contllers
//--- 2: bulding resgiter page and send resgster data to its contraller to insert it into the db
        with using $user = ModelName::create([//]); to insert data to db

//--- 3: using ($user = Auth::login($user);) in resgister contterler to make the user authenticated (logined)
    and save the user data in the user sesstion (you can hide some user data to store in its model with protected $hidden = [}) 

        //an example of login in conttler
        request()->validate([
            'name' => ['required', 'min:2'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], //('confirmed') is for passwrod input confirmation //with placing (password_confirmation) in the input name.
        ]);
        $password_hash =  bcrypt($request->input('password'));
        $user = Usertest::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $password_hash,
            'group_id' => '1',
        ]);
        Auth::login($user);
        //with gurad (Auth::guard('school')->login($user);)


//--- 4: after authentication you can use the middlware to portacte some pages and html parts

---- login ----
//--- 1: create the route of both login form and its contllers
//--- 2: bulding login page and send login data to its contraller
//--- 3: create validation

//--- 4: use (Auth::attempt()) //to check if the use data is valid and match db
        then make the user authenticted and redirect the user to given url 
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate(); //It mainly helps prevent session fixation attacks
                return redirect()->intended('dashboard');
            } //(you can hide some user data to store in its model with protected $hidden = [})  
        
        //also we can use remember me func 
            if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {}

        //an example of login in conttler
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            }
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);

//--- 5: rederict the error back to the page
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);

-- (Auth::attempt) note, Laravel's authentication services will retrieve users from your database based on your authentication guard's "provider" configuration (congif/auth.php(providers)).
In the default config/auth.php configuration file, the Eloquent user provider is specified and it is instructed to use the App\Models\User model when retrieving users.
You may change these values within your configuration file based on the needs of your application.

//note: the defulat guard for Auth:: is ('web') and it is using ('users') table (model) to do its requests 
which we can changeed like Auth::guard('admin')->attempt([])


some important funcs:
     
    //you can use another guard than the defult (web) with (Auth::) like (Auth::guard('admin')->user())
    
    1- (Auth::login($user);) //to make the a user authnitcated and be login and save its data in sesstion
    //in $user is from (create()). we can use (Auth::login($user->id, TRUE);) if we only want to save user id
    //Auth:: has web gurad in defulat whoch uses user model (users table) and we can change it
    //using with another guard (Auth::guard('admin')->login($user))

    2- (Auth::login($user, $remember = true);) //"remember me" functionality is desired for the authenticated session.
    Remember, this means that the session will be authenticated indefinitely or until the user manually logs out of the application

    3- (Auth::user();) //getting the currently authenticated user... 
    //using with another guard (Auth::guard('admin')->user())

    4- Auth::user()->id; //to get specific data in authenticated user info saved
        - Auth::guard('school')->id(; //in case of using the gurad

    5- Auth::id(); //to get the user id

    6- Auth::check(); //it will return TURE if the user is logged in

    7- Auth::logout(); //to logout and destriy the authnication

    8- @auth // @endauth and @guest // @endguest
    directives may be used to quickly determine if the current user is authenticated or is a guest, good to use in view html

    9- @auth('admin') // @endauth  //you may specify the authentication guard that should be checked when using the @auth and @guest directives:

    10- $password_hash =  bcrypt($request->input('password')); //for hashing the password

    11- note: with auth(), we can put a gurde like (auth()->guard($guard)->check())

    12- @guest('school') @endguest //to speiciy the not authiticated users


///// ------------- 3.3 Middleware ------------- /////

//Middleware provide a convenient mechanism for inspecting and filtering HTTP requests entering your application.
//Laravel includes a middleware that verifies the user of your application is authenticated.
//If the user is not authenticated, the middleware will redirect the user to your application's login screen. 
//However, if the user is authenticated, the middleware will allow the request to proceed further into the application.
//in other words, middleware is to make the page be accessed by specfic users

////note: the defulat guard for Auth:: (middleware) is ('web') and it is using ('user') table to do its requests and we can change it in config/auth.php (congif/auth.php(guards, providers))
////if we want to use another guard with Auth:: (middleware) not the defult we would use: Auth::guard('admin')->user()

==== 1- create a new middleware //app/middleware
    php artisan make:middleware EnsureTokenIsValid


==== 2- regsiter the middleware to Kernel (app/Http/Kernel.php)
    'MiddlewareName' => \App\Http\Middleware\MiddlewarePath::class,


==== 3- to put rules to the middleware we enter the middleware file and (app/Http/Middleware) in (handl) we put the loagic

    public function handle(Request $request, Closure $next)
    {
        $grouptype = Auth::user()->group_id;
        //Auth:: has (web) gurad in defulat which uses user model (users table)
        //which we can change it (Auth::guard('admin')->user())  or using @request method to revice a gurd from the middleware route for example

        if ($grouptype == 1) {
            return $next($request);
        }
        return redirect('login');
    }

    -- another example
@if(Auth::check() && Auth::user()->role_id == 2)
                    return $next($request);
@endif
                    return redirect('login');

===== 4: useing the middleware 

        --in route
            1- (->middleware(GroupId::class);)
            2- (->middleware('auth');)
            3- (->middleware('auth:GuardName');)
            4- (->middleware(['first', 'second']);) multi middleware 
                //You cannot merge these 2 middlewares by OR Operator
                //you can create new middelware, something like IsAdmin and do you checks inside of that middleware and assing that middleware to your Group

            //route grouo
                Route::group(['middleware' => 'auth'], function() {
                    // Put all other routes here and the auth middleware will be applied on them all
                });

                //if we want to When assigning middleware to a group of routes, you may occasionally
                need to prevent the middleware from being applied to an individual route within the group.
                //Route::get('/profile', function () {//})->withoutMiddleware([EnsureTokenIsValid::class]);
                
        --in contraller
            public function __construct()
            {
                $this->middleware('auth');
            }

// a group of middlewares, enter (App\Providers\RouteServiceProvider)

    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            ],
        ];


///other funcs:
    1- Determining If The Current User Is Authenticated
        if (Auth::check()) {
            // The user is logged in...
        } //This method will return true if the user is authenticated:
        
///defult middleware
        auth //for authnticated user // you can pass any gurads to it
        guest //for not authnticated user

//Auth Middleware :Determine if the user is logged in to any of the guards.
If not logged in then it will throw AuthenticationException and redirecting to login page.

//Guest Middleware :Here it will check if user is logged in to any of the guards.
If so it redirect to RouteServiceProvider::HOME mentioned page.or else it passes to requested page.

///// ------------- 3.4 Guard ------------- /////

Guards are a way to specify how users are authenticated for requests.
Laravel's authentication facilities are made up of "guards" and "providers".
Guards define how users are authenticated for each request.
//guards specify what db table must be used to be authenticated

Laravel ships with a session guard which maintains state using session storage and cookies. so guard contints the authntication data
Providers define how users are retrieved from your persistent storage. Laravel ships with support for retrieving users using Eloquent and the database query builder.
However, you are free to define additional providers as needed for your application.

Guard is the type of the user, ex admin user, doctor user, patient, normal user, etc.. in db table
for example if we want to use another table such as admin that we need to make it authenticated in a diffreenet way we should create a new guard for that

//the defult guard for (Auth::) is (web)

Guard role is to authenticate routes:
1- Web guard will authenticate web routes
2- Api guard will authenticate api routes.
3- For other user types e.g Admin guard will authenticate admin routes and so on.

//note: the defulat guard is ('web') and it is using ('users') table to do its requests
//every guard has a table and u can find it in config/auth.php


------ create a custom guard ------

-- 1: go to (config/auth.php)(guards) then we define the new guard as following:
    'admin' => [
      'driver' => 'session',
      'provider' => 'admins',
    ],

-- 2: next, in the same folder we go to (providers) and define the pervious guard in the provider
    //with the same name of ('provider' => 'admins') in guards,

        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\admin::class, //we put the model (table in db)
        ],

-- 3: to use the new guard with
    --in middleware
        (->middleware('auth:admin');) //auth: is a middleware meanns it must be login but referes to admin guard 
        //so everyone login from the table admin can visit the page

    --in contller
        1- Auth::guard('admin')->attempt($credentials);

        2- auth()->guard('admin')->attempt($credentials);

        3- auth('admin')->attempt($credentials);
        
        4- Auth::guard('admin')->user()

------------------------------------------------ Authentication End





///// ------------------------------- 4- Controller ------------------------------- /////

//it is used to control the view (html) and the model (database) and date and tranfare information between them
//it is where we put the backend code (php) and all the database quesery
//instead of defining all of your request handling logic as closures in your route files, you may wish to organize this behavior using "controller" classes.
//a controller class might handle all incoming requests such as http, parameters and etc related to users, including showing, creating, updating, and deleting users.
//controllers are stored in the app/Http/Controllers directory.

== 1- to create controller
    (php artisan make:controller PhotoController)

    1.2 want to make it inside a folder
        (php artisan make:controller post/PhotoController)

    1.2 make contoral for (resoruce)
    (php artisan make:controller PhotoController --resource)
    ////(resouce) which has index,show,update, and delete and you can acess to it like /photos or photos/create with adding first the route

    1.3  Create Model and Controller
        (php artisan make:model Product -mc)
        or
        (php artisan make:controller PhotoController --resource --model=Photo)

    1.4 create Model, Controller, and migration
        (php artisan make:model Todo -mcr)
    

==remember to change namespace if u create it by urslef and put what is in botton to difeine the path
    (use App\Http\Controllers\Controller;)
==going to be like it if it inside the folder
    namespace App\Http\Controllers\post;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;

    class PhotoController extends Controller {
            public function show()
        {
            return view('welcome');
        }
    }

==== return view 
    return view('welcome');
    
==== Database

== to insert data
(Post::create) knowing that (post) is the model name and must put its path in the contler page
    (use App\Models\Post;)

    public function show()
        {
            Post::create([
                'title' => 'hello world',
                'excerpt' => 'here is the first writing',
            ]);
        }



===== redercation =====
------- 1: redirect('RouteName') //return to spefici route
            return redirect()->route('RouteName');

------- 2: abort(404) //to go to faild pages like not fount page

------- 3: return back()->withErrors([$validator]); // return back to the page with errors. ($validator) we can use the errore that comes from validation
    // or we can use specific errror ('email' => 'The provided credentials do not match our records.)

        //in view
@error('title')
            <div class="alert alert-danger">{{ $message }}</div>
            //($message) is bulidin var to show the error msgs that comes from (withErrors())
@enderror
        or
@if($errors->has('firstname'))
            <div class="error">{{ $errors->first('firstname') }}</div>
@endif
        or
        {!! $errors->first('avatar', '<span class="invalid-feedbackasd" role="alert"><strong>:message</strong></span>') !!}
        or to get all errors
@foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
@endforeach

------- 4: return back()>withInputs($request->all());
        in blade
        <input type="text" name="name" value="{{ old('name') }}" />

------- 5: return redirect()->back()->withErrors($validator)->withInputs($request->all());

------- 6: return redirect()->back()->with(['success' => 'the info has already sent']);

        //in view

@if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
            // Session is where laravel save (with()) msges
@else

-------- 7: Show a Success Flash Message after sending somthing to db
            (session()->flash('msgTitle', 'the msg');)
            or
            (redirect('admin.index')->session()->flash('msgTitle', 'the msg');)
        --in view
            <p> {{ session('success')->get('success') }} </p>
        -- in js to hide the flash after 5 seconds
        $(document).ready(function() {
            setTimeout(function(){
                $('#flash-msg').hide();// or fade, css display however you'd like.
            }, 5000);
        })



    

------------------------------------------------ controller






///// ------------------------ 5- model ------------------------ /////

==== every table in db must have a model to have full control and you can put the realtionshops between all models
==== the model is managed by the conteller
==== the name of the model must be in a singulra from the db table name which should be plural
        for exmaple the name in model might be (post) and db table might be (posts)

=== 1- to create a model  php artisan make:model Patient/Session
    (php artisan make:model ModelName)
    1.2- to create a model and migration at once:
        (php artisan make:model Post -m)
        
=== 2- to connect the model to db table
    (protected $table = 'tableName')


=== 3- we put all the database tables inside ($fillable) to be used any action like inserting 
    protected $fillable = [ 'name', 'email', 'password', ];

=== 4- hide spicifc coulms from selecting
    protected $hidden = [ 'password', 'remember_token', ];

    === 4.2 we can make it visiable again inside any funcation in contraller
    Phone::find(1) -> makeVisible('column want to be visible')
    === 4.3 to make it hidden inside the contraller func
    Phone::find(1) -> makeHidden('column want to be visible')


=== 5- to block a specific felid to be used in any action
    protected $guarded = ['id'];   


=== 6- to disable created_at and updated_at timestamps
    public $timestamps = false;

=== 7- to select the model to do your database queries in contller we use //post:: then the query (post::)is the model name
    ex: (post::where('number', 'FR 900')->first())


------------------------------------------------ models






///// ------------------------ 6- database ------------------------ /////

//to conect to the database you must put its info in file called .env
//in laravel there are to 2 type to deal with the db
        //databe normal quieres 
        //bulidin Eloquent

        
1- When we'll work on a simple and small records site with simple CRUD and there records are not fact, then use Eloquent there.
2- When we'll work on a lot's of records, it is better to use DB Query than Eloquent.
Real Life Example:
1- I'm making an University website. Which may contain maximum 5,000 teachers and 10,000 students and some notices and files.
Then it is better to do this with simple Laravel Eloquent which is very much standard and readable.

2- Now I'm making a site like Stackoverflow. Which may contains more than 1,000,0000 (1 crore) posts and many more things.
I will must choose the conventional DB facades there. It is more faster for searching the posts from so much records.


============ Migration ============

//migration is to bulid tables in db or db queries automutlculy, which allowing your team to define and share the application's database schema definition
//the migration path (database/migrations)

-- 1- to create new migration
    (php artisan make:migration create_putheretablename_table)
    
    1.2- to create a model and migration at once:
    (php artisan make:model Post -m)
        
-- 2- public function up() we put the table information as folloing

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100); //VARCHAR with given length
            $table->string('email')->unique();
            $table->string('avatar')->unique();
            $table->timestamp('email_verified_at')->nullable(); //(nullable()) is to set null
            $table->string('password');
            $table->bigInteger('role_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->date('created_at');
            $table->decimal('amount', $precision = 8, $scale = 2); //The decimal with the given precision (total digits) and scale (decimal digits):
            $table->string('role')->default('user');
            $table->boolean('is_admin')->default('0');
            $table->enum('is_approved', array('0','1'))->default('0') //is to choces between a list
            $table->text('connection');
            $table->tinyText('connection'); //to 255 charators
            $table->integer('role');
            $table->smallInteger('country', 70); //0 to 65 k
            $table->tinyInteger('votes'); //Tinyint is an integer between 0 and 255



        });
    }

-- 3- run the migreation
    3.1: To run all of your outstanding migration
        (php artisan migrate)
    
    3.2: To roll back the latest migration operation
        (php artisan migrate:rollback)

    3.3: re-creates your entire database:
        (php artisan migrate:fresh)

        
============ Seeders ============
Laravel includes the ability to seed your database with data using seed classes.
All seed classes are stored in the (database/seeders) directory.

1- create a new seeder
    (php artisan make:seeder UserSeeder)

2- to insert data to db thorugh seeder in the created file inside (database/seeders)
    public function run()
    {
        DB::table('users')->insert([  
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }

3- running Seeders
    (php artisan db:seed --class=UserSeeder)
    -- or run all the seeders at the same time
    (php artisan db:seed)php artisan db:seed --class=CitiesTable
    -- to run specific seeder
    php artisan db:seed --class=PermissionTableSeeder



///// ------------------------ normal databas ------------------------ /////


==insert data

(Post::create) knowing that (post) is the model name and must put its path in the contler page
    (use App\Models\Post;)





==select data
DB::table('table_names')->find($id)->column_name;
DB::table('users')
            ->select('name', 'email as user_email')
            ->get();
DB::table('table_names')->where('id',$id)->first()->column_name;
DB::table('table_names')->where('id',$id)->first('column_name');
DB::table('users')->get();
$titles = DB::table('users')->pluck('title'); //(pluck) is to select specific column 





==update date




==relationship

$shares = DB::table('shares')
    ->join('users', 'users.id', '=', 'shares.user_id')
    ->join('follows', 'follows.user_id', '=', 'users.id')
    ->where('follows.follower_id', '=', 3)
    ->get();

//examples of 3 tables 
1- Articles table: (id, title, body, categories_id, user_id)
2- Categories table: (id, category_name)
3- User table: (id, user_name, user_type)

$articles =DB::table('articles')
        ->join('categories', 'articles.id', '=', 'categories.id')
        ->join('users', 'users.id', '=', 'articles.user_id')
        ->select('articles.id','articles.title','articles.body','users.username', 'category.name')
        ->get();

//another example    
    $articles = DB::table('payments')
            ->join('services', 'payments.service_id', '=', 'services.id')
            ->join('users', 'payments.user_id', '=', 'users.id')
            ->select('users.name as username', 'services.name', 'payments.price')
            ->where('users.id', '=', 2)
            ->get();


///// ------------------------ Eloquent ------------------------ /////


it is a simple way of using the database but it is slwoer than the db quires
So when we use Eloquent and When DB facades:


    //post:: //is the model name

    //get() //to get all results (return collection)
    //first() to get the first result
    //all() to select all data inside the table
    //find() to get the table ID (primmery key)




================ select data ================

    = post::where('user', '4')
                ->orderBy('name') //to 
                ->limit(10) //to get only 10 rows
                ->get();

    =post::where('number', 'FR 900')->first(); //first() is to get the first column
    
    =post::all(); //(all) to select all data

    =post::find(1); //to find the ID

    =post::select('name','surname')->where('id', 1)->get(); //(get) is to get all data

    =Usertest::find(2)->name; //get the the name with the user id

    =user = User::find(1);
    return $user->first_name;
    
    =Usertest::select('name', 'group_id')->get();

    =Usertest::select('nameuser' 'as name', 'group_id')->get(); //to change the nameuser to be name

    =Usertest::where('id', 1)->get(['name','surname']);

    =$query->where([
    ['column_1', '=', 'value_1'],
    ['column_2', '<>', 'value_2'],
    [COLUMN, OPERATOR, VALUE],
    ...
    ])

    =whereDate / whereMonth / whereDay / whereYear / whereTime
        ->whereDate('created_at', '2016-12-31')
    
    =$stmt = Appointment::select(DB::raw(DB::raw('DATE_FORMAT(start_at,"%h:%i %p") as date')))
        ->whereDate('start_at', '=' , '2021-10-11')
        ->where('branch_id', '=' , '1')
        ->get();
        
    =Manager::where('phone_number', 'like', '%' . $search_query . '%')
            ->orWhere('second_name', 'like', '%' . $search_query . '%')
            ->get();
            
    =$wordCount = $stmt->count();

    =static::where('created_at', '<=', now()->subMonth())->get();
        
    =Usertest::all('name', 'surename');
    
    =$permissions = Permission::pluck('id','id')->all();

    // QUESTION When We should use Pluck method in laravel???
    // ANSWER: You might often run into a situation where you have to extract certain values (excluding the keys) from a collection 
        then you should use pluck().i.e (when you only need value, not the key) such as (//Reult ['Bradmen', 'Jhon Doe', 'Martin'];)

    
    //for relationship
    ==$user = Usertest::with(['posts' => function ($q) {
            $q->select('title', 'user_id');
        }])->where('name', 'hesham')->get();




======= example for finding the posts of a specific user with the possbility of deleting it: 
//important to foucs on the realtionship method in the Model

=first we bulid the route of the users table in the rotue
Route::get('/showuser', [PostCont::class, 'showuser']);

= in conottller for the user table we select all the user and pass it to the view page
   public function showuser()
    {
        $users = Usertest::select('id', 'name', 'email')->get();

        return view('userposts', compact('users'));
    }

= in view page we recive the paramter and show it in a table and send it via <a hraf> to another page
        //($user) is the paramter that we passed through contteler via compact('users')
@if(isset($users) && $users -> count() > 0 )
@foreach($users as $item)
                <tr>
                    <th scope="row">1</th>
                    <td>{{ $item -> name }}</td>
                    <td><a href="{{ route('userposts', $item -> id) }}"><button class="btn btn-info"> more </button></a></td>
                    //we passes the paramter to the conteler and the route (we need to name() the page in the route)
                </tr>
@endforeach
@else
          sorry there is no info
@endif

====== then to get all the posts that made by the user
==we first bulid the route
Route::get('/userposts/{postID}', [PostCont::class, 'showpost']);
//({postID}) is the requried parameter and it can be replaced with ({name?}) if it is not requried

==then in cotller we do
        $users = Usertest::find($userid);
        $posts = $users->posts;

        return view('posts', compact('posts'));
        //('posts') in compact is $posts = $users->posts; we pass to the post table
==in the view 
@if(isset($posts) && $posts -> count() > 0 )
                
@foreach($posts as $item)
                    <tr>
                        <th scope="row">1</th>
                        <td>{{ $item -> title }}</td>
                        <td>{{ $item -> excerpt }}</td>
                        <td>{{ $item -> user_id }}</td>
                    </tr>
@endforeach

@else
            sorry there is no info
@endif


=========== for deleteing data: 
//in route
Route::get('/postsdelete/{userid}', [PostCont::class, 'deletepost'])->Name('postsdelete');
==== in contnerl
        $users = Usertest::find($userid);
        $users->posts()->delete(); (posts()) is the relationship inside
        $users->delete();
        return 'the info has been deleted';
==== in a view of the show user page we will only put another (a href) to pass the parameter to the contller 
<a href="{{ route('postsdelete', $item -> id) }}"><button class="btn btn-danger"> delete </button></a></td>






================ insert data ================

1- normal insert data
    public function show()
    {
        Post::create([
            'title' => 'hello world',
            'excerpt' => 'here is the first writing',
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
        ]);
    }

    //to get the last id inserted by create:: ($invoice_id = invoices::latest()->first()->id;)

2- for the relationship many to many, to insert data into (pivet table)

    1- public function addpayment(Request $request)
    {
        //1- we get the doctor id that we need to insert data with (the table that hold the realationship)
        $user = User::find($request->doctorid); 

        //2- select the realtionship func paymentrel() then using attach. the data will be stored into (pivit table)
        //contining the values of ($user) in all columns and $request->serviceid
        $user->paymentrel()->attach($request->serviceid);

        return 'the info has already sent';
    }

    //2.2- or to insert data with addationl clumn to (pivet table)
        $user->paymentrel()->attach($request->serviceid, array('price' => 21));

    //2.3- insert data into (pivet table) with no duplicate data and also it will replaces the current records with the new records. This is very useful for updating a model.
     and insert only the new items to the pivot table (like update the povirt with only new insert).
        ($user->paymentrel()->sync($request->serviceid, array('price' => 21));)

    //2.4- the same as (sync()) but with not delete the old record and update the data with old records and the new ones withput dublicated data
        ($user->paymentrel()->syncWithoutDetaching($request->serviceid, array('price' => 21));)




================ validation and inserting update data ================

=we put the validation func in collter before submting to db

-------- auto validation --------

= we can use (validate).  or (validateWithBag) (validateWithBag: if we want to store any error messages with a named error bag:)
//note that if the sent data does not match the validation will redirect back automulty to the page
    public function store(Request $request)
    {
    $validatedData = $request->validateWithBag([
        'title' => ['required', 'unique:tableName,coulmName', 'max:255'],
        'body' => ['required', 'exists:tableName,coulmName'],
    ]);
        // The blog post is valid...
    }
        //As you can see, the validation rules are passed into the validate method. Don't worry - all available validation rules are documented. Again, 
        //if the validation fails, the proper response will automatically be generated. If the validation passes, our controller will continue executing normally.

    
-------- manualy validation and insert data --------

== 1: in the route
    Route::get('/', function () {
        return view('welcome');
    }); // for the form html //better to make it in conttleer apart

    Route::post('/postSend', [PostCont::class, 'send'])->Name('postSend'); //for contrling the data comes from the form


= 2: in contraller 
=note: should place the bottom path in the page in contraller
(use Illuminate\Support\Facades\Validator;)

    public function send(Request $request)
    {

    //validation rulres

    $rules = [
        'title' => ['required', 'unique:tableName,coulmName', 'max:255'],
        'body' => ['required', 'exists:tableName,coulmName'],
        'excerpt' => 'required|max:255',
        'user' => 'numeric',
        'password' => ['required', 'string', 'min:8', 'confirmed'], //('confirmed') is for passwrod input confirmation //with placing (password_confirmation) in the input name. 
        //or you can use ('confirm_password' => ['required', 'string', 'min:8', 'same:new_password']')

        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'avatar' => ['required','image', 'mimes:jpeg,jpg,png', 'max:700'],
        'catagory_id' => ['required', Rule::exists('tableName','coulmName')],
        'country' => ['required', 'exists:countries,id'], //(exists) The field under validation must exist in a given database table.
        'birthday' => ['required', 'date', 'date_format:Y/m/d'],
        'sale_price' => [
            new RequiredIf($this->list_type == 'For Sale'),
            'string',
            ...
        ] //put requrie if
        'first_name' => ['sometimes', 'required', 'max:60'], (sometimes) if the input exist 
        'email' => ['nullable', 'email:rfc,dns', ($this->email === $this->old_email) ? '' : 'unique:managers,email', 'max:255'],  //(nullable) to accept empty input  


    ];
    //change the defult messages which return with (withErrors)
    $messages = [
        'title.required' => 'u did not write it',
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    //in case of fails validation
        if ($validator->fails()) {
        //return $validator->errors();
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
            //(withErrors($validator)) it returs all errors and (->withInputs($request->all())) all the inputs that the user wrote in the form
        }
        Post::create([
            'title' => $request->input('title'), //to get the input value (title) the input name in html
            'excerpt' => $request->input('excerpt'),
            'user' => $request->input('user'),
        ]); //Post:: the model name that we need to insert data
        }

    //to return sucess msg to html
    return redirect()->back()->with(['success' => 'the info has already sent']);

=then in html
    =successful msg
@if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
            // Session is where laravel save (with()) msges
@else

    =error msgs //comes from (withErrors())
@error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                //($message) is bulidin var to show the error msgs that comes from (withErrors())
@enderror


//------ recomenned for best practice

//------ for validation, it is better to put http request which has the validation in another page

    1: we create a new doument and page in (app) folder named requests
        (php artisan make:request nameRequest)

    2: in the request file that we created we put authorize true 
        public function authorize(){
        return true;}

    3: in request file we put our validaation rules in and put another func for valdation msg

        public function rules()
        {
            return [
                'title' => 'required|unique:posts,title|min:2',
            ];
        }
        public function messages()
        {
            return [
                'title.required' => 'u did not write it',
            ];
        }

    4: in collter in func that we do our logic, we put the new request page name
    public function send(infoRquest $request){//}

    //4: now the validation and request is ready to use with error msgs in the request page and we only put the create: funcation (insert data)
        //and  the following in the conttler for sucefful message
        return redirect()->back()->with(['success' => 'the info has already sent']);

//------ custom Validation Rules ------
1- create a new rule and it will be stored in (App\Rules)
        (php artisan make:rule RuleName)
2- do loagic in passes and msg for the validation msg
    public function passes($attribute, $value)
    {
        return strtoupper($value) === $value;
    }
    public function message()
    {
        return 'The :attribute must be at least ' . $this->length . ' 10 characters and contain at least one uppercase character, one number and one special character.';
    }
3- Once the rule has been defined, you may attach it to a validator by passing an instance of the rule object with your other validation rules:
    use App\Rules\Uppercase;
    $request->validate([
        'name' => ['required', 'string', new Uppercase],
    ]);

4- in case you want to pass a parameter, for example to pass the legal age dendps on the given parameter
    public function __construct($age)
    {
        $this->legalAge = $age;
    }

        public function passes($attribute, $value)
    {
        $formattedValue = new Carbon($value);
        $legalAge = Carbon::now()->subYears($this->legalAge);
        return $formattedValue < $legalAge;
    }
    --to use
            'age' => ['required', new LegalAgeRule(18)],


//----- insert img -----

//-- 1: view
//we must add in (form) this (enctype= multipart/form-data) to uplode files
    <form method="POST" action="{{ route('postSend') }}" enctype= multipart/form-data>

//-- 2: create a folder to put the img in (app/public)

//-- 3: connect the folder we created above to the file system (config/filesystems.php) in (disks) to make the file be uploaded to the created folder
        'avatar' => [
            'driver' => 'local',
            'root' => storage_path('app/public/img/avatar'),
            'url' => env('APP_URL') . '/public',
            'visibility' => 'public',],
            
//-- 4: validate the img before moving to the follder
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

//-- 5: in conotller we save the img first to the folder before inserting the to db
        1- ($file_extension = request()->avatar->getClientOriginalExtension()) //returns the original file extension
        2- ($file_name = time() . '.' . $file_extension;) //to replace the file name with time
        3- ($path = 'img/avatar';) //the path of the folder that we created in publick
        4- ($request->avatar->move($path, $file_name);) to uplodae the img to the follder we created at begining
        5- then we insert only the img name
            Post::create(['avatar' => $file_name,]);



// for best practice we can create a funcation to handle the image 

        //the func will take the photo that is sent by the form and the folder path to move the img to
        //then it will replace the name img and store the img and retun the new name

        //the new funcation
            protected function saveImg($photo, $folderpath){
            $file_extension =  $photo->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extension;
            $photo->move($folderpath, $file_name);
            return $file_name; }

        //and in the insert contraller
            $file_name = $this->saveImg($request->avatar, 'img/avatar');
        //then save ($file_name) in db


        //--- recomeneded for ur choice  ---
        //first we create a page to contain our funcations and it is better to have a folder named Traits in (app) with a name of the conttller:
                traits imgTraits{saveImg($photo, $folderpath){}}

        //then we inculde it in the conttler page we need to insert the img in
                use app/traits/imgTraits;
                


================ update date ================

        $que1 = Post::find($request->postid);

        1- $que1->update($request->all()); //to update all the cloumns
        
        2- $que1->update([
            'title' => $request->title,
            'excerpt' => $request->excerpt,]); //to update speicif columns
        3- $flight = Flight::find(1);
           $flight->name = 'Paris to London';
           $flight->save();


================ delete date ================
//in route
Route::get('/postsdelete/{userid}', [PostCont::class, 'deletepost'])->Name('postsdelete');
==== in contnerl
        $users = Usertest::find($userid);
        $users->posts()->delete(); (posts()) is the relationship inside
        $users->delete();
        return 'the info has been deleted';
==== in a view of the show user page we will only put another (a href) to pass the parameter to the contller 
<a href="{{ route('postsdelete', $item -> id) }}"><button class="btn btn-danger"> delete </button></a></td>



================ other ================

//---- to count and group (get the highest wanted service for example) ----

$count = DB::table('payments')
    ->join('services', 'services.id', '=', 'payments.service_id')
    ->select('services.name as nemo', DB::raw('count(payments.service_id) AS total'))
    ->groupBy('payments.service_id', 'services.name')
    ->get();
//you can use one group by for example groupBy('payments.service_id') if turning 'strict' => false in config/database.php




=== ---------------- relationship ----------------


============ One to one ============

//only table has realation with only one primerkey
//For example, a User model might be associated with one Phone model

//realtion with another table that has the main table forginID wich is (phone)

    public function phone()
        {
            return $this->hasOne(Phone::class, 'foreign_key that in phone to relate the main table ID', 'primery key of the main table'); 
        } //Phone::class, is the table that has the primery id we need to attcah the cureent table to
    
//we can do the oppsit, intering the table that has the main table forgeing_key and relate it to the main table
    public function Post()
    {
        return $this->belongsTo(Post::class, 'user');
        or
        return $this->belongsTo(Post::class, 'foreign_key', 'owner_key');
        //return $this->belongsTo(Branch::class, 'branch_id', 'id');
        //Post::class, is the table that has the primery id we need to attcah the cureent table to
        
    }
    
//==to select it and show
//(Usertest is the main tabke) (posts) is the funcation that holds the realtion
//rembember that u must return the forgin id

==1
        $users = UserModelName::find(1);
        $posts = $users->posts;
==2
    return Usertest::with(['posts' => function ($q) {
        $q->select('title', 'user_id');
    }])->find(2);
==3
    $user = Usertest::with(['posts' => function ($q) {
        $q->select('title', 'user_id');
    }])->where('name', 'hesham')->get();
    
==4
    $posts = Post::with(['author' => function($query){
        $query->select(['id','name']);
    }])->get(['id','title', 'author_foreign_key_in_posts_table']);

==5
    $model = Model::with('relatedModel', 'relatedModelTwo')->get();

//-- to get the forgin key table data
    Usertest::find(2)->posts; //(posts) is the funcation that holds the realtion and (user) has the var that contints the realtion 

//-- to get specific forgin key table data   
    Usertest::$user->posts->title;

//- for belong to // we can do everything above
    we can select it by
    $phone = phone::find(1);
    $userPhone = $phone -> user ->get();


//-- to select all data from the table that has only relation with the other table
    User::whereHas('Phone') //(phone) is the realtion funcation inside (User) conntrler
==or
User::whereHas('Phone', funcation($q){
    $q -> where('code', '02')
})

==or who does not
User::whereDoesnotHave('Phone') -> get();



==== delete the data and the relation data
        $users = UserModel::find(1);
        $users->posts()->delete();
        $users->delete();


        
============ One to many ============

//one table has many raltion in another table
//For example, a blog post may have an infinite number of comments


    public function phone()
        {
            return $this->hasMany(Phone::class, 'foreign_key that in phone to relate the main table ID' , 'primery key of the main table (ex Phone table');
            or
            (return $this->hasMany(Comment::class)) 
        }
//it can be the oppite which u can use (belongsTo) like in one to one



============ Many to many ============

it is 3 or more tables mainly. the thired table (pivot table or linking table) that link the other 2 tables togther 

An example of a many-to-many relationship is a user that has many roles and those roles are also shared by other users in the application. For example,
a user may be assigned the role of "Author" and "Editor"; however, those roles may also be assigned to other users as well. So, a user has many roles and a role has many users.
To define this relationship, three database tables are needed: users, roles, and role_user. The role_user table is derived from the alphabetical order of the related model names and contains user_id and role_id columns.
This table is used as an intermediate table linking (pivot table) the users and roles.
Remember, since a role can belong to many users, we cannot simply place a user_id column on the roles table. This would mean that a role could only belong to a single user.
In order to provide support for roles being assigned to multiple users, the role_user table is needed. 

Unlike One to Many and One to One, in this relationship type, the key is the join (pivot table) you define between two tables to link them.
A pivot table allows the relationship id from one model to be related to many other models and vice-versa.

//another example, Let’s say a company has a group of Shops all over country and a variety of products,
and they want to store the information about which Product is sold in which Shop.
It’s a perfect example of many-to-many relationship: one product can belong to several shops, and one shop can have multiple products.
so, we need to have a thired table (pivot table) to conenect the reatlionship between the products and the shop which might called product_shop
So here’s a potential database structure:
    shops
      – id
      – name

    products
      – id
      – name

    product_shop
      – product_id
      – shop_id

//another example, a patient want to pay for a sercive, so we will have a patient table and a service table. and a third one to link these 2 tables togther called payment
//havning the id of the patient table and the serivce table.


///// ------- creating
    1- imagin we have 3 tables, one for users and the second for the services, and the last one for payment (pivot table or linking table) that links the 2 first tables togther
    //the thired one havning the ID of the user ID and the services ID

    2- creating 3 modles for the 3 tables,

    3- going to users or services (normal tables) and connect 3 tables togther. 
        //for example for the user tables
        public function paymentrel()
        {
            return $this->belongsToMany(Service::class, 'Payments', "user_id", "service_id", "id", "id")->withPivot('price');
        }
        //explaings
        (Service::class):       the second normal tables model
        (Payments):             the name of the pivot table name in the database 
        (user_id):              the id of the first normal table (user) (the table that we put the query) (not requried if it is not named _id)
        (service_id):           the id of the second normal table (sercive) (not requried if it is not named _id)
        (id):                   the primery key of the first table (users) (not requried if it is not named id)
        (id):                   the primery key of the second table (users) (not requried if it is not named id)
        (->withPivot('price')): to attach a specific coloum of the pivot table with the query

    4-to select the data in contrller
        $user = user::with('paymentrel')->find(2);
        return $user->paymentrel;
        //paymentrel: the relationship func


============ joining 3 tables ============

We have three models:
    1- Article (belongs to user and category)
    2- Category (has many articles)
    3- User (has many articles)

    1- Article.php: namespace App\Models;
        protected $table = 'articles';
        public function user() {
            return $this->belongsTo('App\Models\User');
        }
    
        public function category() {
            return $this->belongsTo('App\Models\Category');
        }

    2- Category.php: namespace App\Models;
        protected $table = "categories";
    
        public function articles() {
            return $this->hasMany('App\Models\Article');
        }

    3- User.php: namespace App\Models;
        protected $table = 'users';
    
        public function articles() {
            return $this->hasMany('App\Models\Article');
        }

//to select data
    $article = Article::with(['user','category'])->first();   

and you can use this like so:

    //retrieve user name 
    $article->user->user_name  

    //retrieve category name 
    $article->category->category_name

//In another case, you might need to retrieve all the articles within a category or retrieve all of a specific user`s articles.

    $categories = Category::with('articles')->get();
    $users = Category::with('users')->get();


============ Polymorphic Relationships ============
A polymorphic relationship allows the child model to belong to more than one type of model using a single association. For example,
imagine you are building an application that allows users to share blog posts and videos. In such an application,
a Comment model might belong to both the Post and Video models and you don't know

---- One To one (Polymorphic) ----
1- in the main table that belong to tables that we don't know:
class Comment extends Model{
    public function commentable()
    {return $this->morphTo();}
}
2- in other tables that has the main table
    class Post extends Model{
        public function comments()
        {
            return $this->morphOne(Comment::class, 'commentable');
        }
    }
3- get the data from the main table
        $Invoice = Lab::find(16);
        $invoiceable = $Invoice->invoiceable;
4- get the data from the other tables
    $lab = Lab::find(1);
    $invoice $lab->invoice;
    --$lab = Lab::with(['invoice' => function ($q) {
        $q->select('invoiceable_id','invoiceable_type', 'id', 'code', 'status');}])->find(1);




------------------------------------------------ database






///// ------------------------ 7- ajax ------------------------ /////

//we put the ajax secetion in the folder bottom

Errors code:
419 //you can not acess cuz of csrf
422 //the kind of data sending or reciving (mainly from the valdation)

//you must use CSRF in every ajax request sending data (not files) ('_token' : "{{ csrf_token() }}",)
//ajax route for recource 

Verb          Path                             Action  Route Name
GET           /associates                      index   associates.index
GET           /associates/create               create  associates.create
POST          /associates                      store   associates.store
GET           /associates/{associates}         show    associates.show
GET           /associates/{associates}/edit    edit    associates.edit
PUT|PATCH     /associates/{associates}         update  associates.update
DELETE        /associates/{associates}         destroy associates.destroy


///// --------- Insert Data --------- 

//-- 1: use this forma in view (html)

  $(document).on('click', '#submetpost', function(e){
    e.preventDefault(); //it stops the default action of an element from happening, ex it prevents a submit button from submitting a form.
    $.ajax({
      type: "post",
      url: "{{ route('ajaxstore') }}",
      data: {
        '_token' : "{{ csrf_token() }}",
        'title' : $("input[name='title']").val(),
        'excerpt' : $("input[name='excerpt']").val(),
        'user_id' : $("input[name='user_id']").val(),
        'avatar' : $("input[name='user_id']").val(),
      },
      success: function(data)
      {
         // show response from the php script.
      },
      error: function()
      {
      }
    });
  }) 

  //but if we want to insert data with files(img for example)

    $(document).on('click', '#submetpostbutn', function(e){
        e.preventDefault();
        var formData = new FormData($('#sendpostform')[0]); //to get all inputs inside the form
        $.ajax({
            type: "post",
            enctype: 'multipart/form-data', //we use it for sending files
            url: "{{ route('ajaxstore') }}",
            data: formData,
            processData: false, //we use it for sending files, see the info in the bottom
            contentType: false, //we use it for sending files, see the info in the bottom
            cache: false, //we use it for sending files
            success: function(data)
            {
                // show response from the php script.
                if(data.poststatue == true){
                $('#successmsg').show()
                alert(data.msg)
                } //to get the array that the other page send with sucessful msg
            }, 
            error: function(){}
        });
    }) 

//-- 2: in conteraller

    protected function saveImg($photo, $folderpath){
        $file_extension =  $photo->getClientOriginalExtension();

        $file_name = time() . '.' . $file_extension;

        $photo->move($folderpath, $file_name);

        return $file_name;
    } // for replace the photo name and move it into the follder

    public function store(Request $request){
        $file_name = $this->saveImg($request->avatar, 'img/avatar'); //to recall the photo func
        
        $postCrate = Post::create([
            'title' => $request->input('title'),
            'excerpt' => $request->input('excerpt'),
            'user_id' => $request->input('user_id'),
            'avatar' => $file_name,
        ]);

        if ($postCrate) //to send aray to ajax after checking if the inf has already sent to db
            return response()->json([
                'poststatue' => true,
                'msg' => 'info has been sent to db'
            ]);
        else //if it is no sending
            return response()->json([
                'poststatue' => false,
                'msg' => 'sorry, we could not save the data'
            ]);
    }}


//processData: it's false jQuery simply sends whatever you specify as data in an Ajax request
without any attempt to modify it by encoding it as string.

//contentType: This option sets the value of the Content-Type header sent with the request. 
This informs the server how the content of should be interpreted. Notice that this only works with a Post


///// --------- Delete Data --------- 

1- using it in a view
    <tr class="postrowid{{ $contents -> id }}"> //pointing the row with post ID to enable the jquery ajax to delete the row after secssful
    <td>
    <a id="deleteajax" data-postid="{{ $contents -> id }}" ><button class="btn btn-danger"> delete </button></a>
    //to make the jquery ajax get the postID via (data-postid)
    </td> </tr>

    $(document).on('click', '#deleteajax', function(e){
    e.preventDefault();
    var postid = $(this).attr('data-postid'); //get the postID
    $.ajax({
        type: "post",
        url: "{{ route('ajaxdelete') }}",
        data: {
        '_token' : "{{ csrf_token() }}",
        'postid' : postid, 
        },
        success: function(data)
        {
            // show response from the php script.
            if(data.poststatue == true){
            $('#successmsg').show()

            $('.postrowid'+data.idpost).remove();
            } 
            //removing the deleted row after delelting it via contraller (db). 
            //the conttler sends back the deleted postID which match the (postrowid) in row <tr> to remove
        },
        error: function(){}
    });
    })

//-- 2: in conteraller

    public function delete(Request $request)
    {
        $post = Post::find($request->postid);
        $post->delete();

        if ($post)
            return response()->json([
                'poststatue' => true,
                'msg' => 'info has been deleted',
                'idpost' => $request->postid, //send the deleted post ID
            ]);
        else
            return response()->json([
                'poststatue' => false,
                'msg' => 'sorry, we could not save the data'
            ]);
    }



///// --------- Update Data --------- 

1- in all show tables or user etc.. we must have a (a hraf) to pass the id of wanted table to update to the contller and show it in the view
    <a href="{{ route('edit', $contents -> id) }}" ><button class="btn btn-primary"> edit </button></a>

2- in route we must add requried id to get the passed id
    Route::get('/edit/{postid}', [ajaxtest::class, 'edit'])->name('edit');


3- the contller that recive the paramter from the all data table page (see number 1) and show it in the view edit page form
    public function edit(Request $request)
    {
        //select and show all data
        $que1 = Post::select('id', 'title', 'excerpt', 'user_id', 'avatar')->find($request->postid);
        return view('editajax', compact('que1'));
    }

4- the ajax for update in edit page view

  $(document).on('click', '#updatepostbutn', function(e){
    e.preventDefault();
    var formData = new FormData($('#updatepostform')[0]);
    $.ajax({
      type: "post",
      enctype: 'multipart/form-data',
      url: "{{ route('editstore') }}",
      data: formData,
      processData: false,
      contentType: false,
      cache: false,
      success: function(data)
      {
         // show response from the php script.
         if(data.poststatue == true){
           $('#successmsg').show()
           alert(data.msg)
         }
      },
      error: function(){}
    });
    
5- the contller that recive the ajax request and update the table in db

   public function editstore(Request $request)
    {
        $que1 = Post::find($request->postid);
        $que1->update($request->all());
        if ($que1)
            return response()->json([
                'poststatue' => true,
                'msg' => 'info has been updated',
                'idpost' => $request->postid,
            ]);
        else
            return response()->json([
                'poststatue' => false,
                'msg' => 'sorry, we could not update the data'
            ]);
    }
}



///// --------- ajax validation --------- 

    1- in (view form) we put a div for the error under every input including the same name of attr (name) of the wanted input 
        <input type="text" name='title' class="form-control" id="exampleInputEmail1">
        <div id="title_error" class="form-text alert-danger"></div>

    2- in (ajax form) we put the follwoung in the (the error section )
        error: function(reject)
        {
            var errors_resopnse = JSON.parse(reject.responseText); //explaining in the bottom
            $.each(errors_resopnse.errors, function(key, val){
            $("#" + key + "_error").text(val[0]); //to get the error div id to insert the ajax validation response
            //("#" it is like '#get' + 'key' is the key array and (_error)
            //so it is gonna be like (#title.error) then put the text in error div with (val[0]) which means to print the first value of the array
            })
        }

    3- after showing the error in the div error, if the user correct the error, the error will stay the same, so we need to rest all inputs by adding the following in the body
         $('#avatar_error').text(''); // the input id we need to rest

    == the final ajax error will be like
            $(document).on('click', '#submetpostbutn', function(e){
                e.preventDefault();
                $('#avatar_error').text('');
                $('#title_error').text('');
                $('#excerpt_error').text('');
                $('#user_id_error').text('');

                var formData = new FormData($('#sendpostform')[0]);

                $.ajax({
                type: "post",
                enctype: 'multipart/form-data',
                url: "{{ route('ajaxstore') }}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function(data)
                {
                    // show response from the php script.
                    if(data.poststatue == true){
                    $('#successmsg').show()
                    alert(data.msg)
                    }
                },
                error: function(reject)
                {
                    var errors_resopnse = JSON.parse(reject.responseText);
                    $.each(errors_resopnse.errors, function(key, val){
                    $("#" + key + "_error").text(val[0]);
                    })
                }
                });
            }) 

(var errors = $.parseJSON(reject.responseText);)
    //it takes a well-formed JSON string and returns the resulting JavaScript value. such as String, Number, Array ,and etc


------------------------------------------------ ajax






///// ------------------------ 8- blade view (html) ------------------------ /////

// it is where the user see, where we put the html code
// note that is imprtant to link the view page via contrller not via route

    ==CSRF Protection //Remember for sercurity, any HTML forms has POST, PUT, PATCH, or DELETE must include a CSRF token field
    //and also to avoice the error of 419 PAGE EXPIRED
@csrf


--------- http request --------- 

==remember to use ->Name('nameRoute'); in ur route

==HTTP request : to send data to a specific route contreller via http request
    <form method="POST" action="{{ route('postSend') }}">
@csrf// rembmver to use it

==remember to define the route by ->Name('routeName'); in ur route

==(a href) to send data to a specific route contreller via (a href)
    <a href="{{ route('routeName', $item -> id) }}"><button class="btn btn-info"> more </button></a>



--------- If Statements ---------

@if(count($records) === 1)
        I have one record!
@elseif(count($records) > 1)
        I have multiple records!
@else
        I don't have any records!
@endif
------
@if(Auth::check() && Auth::user()->role_id == 2)
        // button
@endif
------
@isset($records)
        // $records is defined and is not null...
@endisset//if it is exitst

@empty($records)
        // $records is "empty"...
@endempty//if it is empty

@php
    {{-- PHP code here --}}
@endphp//php code

--------- Authentication ---------

1- The @auth and @guest authentication directives may be used to quickly determine if the current user is authenticated or is a guest:

    1.1- @auth // The user is authenticated... @endauth
    2.2- @auth('admin') // The user is authenticated... @endauth //with guard

2- @if(auth()->guard('guard_name')->check()) ....... @endif

3- @if (Auth::check() && Auth::user()->role_id == 2)
        // button
@endif

4- @if(Auth::->user()->type == 'admin') 
        <h1>Welcome admin</h1>
@else
        <h1>Welcome user</h1>
@endif//Note: change type with the column name that you used to recognize each user


--------- The Loop Variable ---------

//a ($loop) variable will be available inside of your loop. This variable provides access to some useful bits of information
//such as the current loop index and whether this is the first or last iteration through the loop

@foreach($users as $user)
@if($user->first) This is the first iteration.
@endif

@if($loop->last) This is the last iteration.
@endif
    <p>This is user {{ $user->id }}</p>
@endforeach

// $loop->index	The index of the current loop iteration (starts at 0).
// $loop->count	The total number of items in the array being iterated.
// $loop->remaining	The iterations remaining in the loop.





--------- view inheritance & Layouts extends --------- 

1- first we create 2 folders, layouts and includes. the first one has the head and the html end, and the second one has the header, navbar, and the fotter

2- in the layout file we pu

2- in normal pages, first we need to extands the layout file that has the head and the fotter
@extends('layout.master')

3- then, we use (@section()) to put the body content then in the layout file that has the head and fotter we call this section with (@yield()) and they must have the same name

    //in layout file
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <title>@yield('title', 'Hello')</title>
        </head>
        <body>
            include('includes.header')
@yield('content')
            include('includes.fotter')
        </body>
        </html>

    //in the section body (the normal page)
@extends('layout.master')
@section('title', 'contact us')
@section('content')
        <div class="container">
            <div><h1>hello world</h1></div>
        </div>
@endsection(or u can use @stop)

// ---- we can use section in layout file ----
 //you can use section in the layout file and it will show in all the pages that extands the layout file without adding anything in the section page (normal page)
1- in layout file 
    (@section() // @show)
// and if we want to not show it in all pages (@section() // @endsection)

2- if we want to overwrite the section in layout page, in section page (normal pages) we put the follwoing 
    (@section() // @endsection)
    //and it bring the section and if we write something it will overwrite the section
    //but we can write with keeping the section that in the kayout file by adding 
        (@section() @parent // @endsection)



--------- includes css, js, and img ---------

All assets (css,js,img) should be placed in the public folder (/public)
 - <script src="{{ URL::asset('js/yourfile.js') }}"></script>
 - <link href="{{ URL::asset('css/min.css') }}" rel="stylesheet">
 - <img alt="logo" src="{{ URL::asset('images/logo.png') }}">




------------------------------------------------ blade view






///// ------------------------ 9- Authorization ------------------------ /////

Laravel also provides a simple way to authorize user actions against a given resource. For example, even though a user is authenticated,
they may not be authorized to update or delete certain Eloquent models or database records managed by your application.

Laravel provides two primary ways of authorizing actions: gates and policies. Think of gates and policies like routes and controllers. Gates provide a simple,
closure-based approach to authorization while policies, like controllers, group logic around a particular model or resource

Gates are a great way to learn the basics of Laravel's authorization features;
however, when building robust Laravel applications you should consider using policies to organize your authorization rules.


nothing is better than other between gates and policy Most applications will most likely contain some mixture of gates and policies, and that is perfectly fine!
Gates are most applicable to actions which are not related to any model or resource, such as viewing an administrator dashboard. In contrast,
policies should be used when you wish to authorize an action for a particular model or resource.


1- it is highly recomanded to have a table in the user name called (user_role) to be reconized in Authorization quereis
    //and more better to have another table named for examoles user_roles whcih have a realtionshop with the user table

role: is the user type, admin or user, doctor
permissoin: give permissoin to these role which can this role edit or delete or only see


------------ in view ------------

1- The @auth and @guest authentication directives may be used to quickly determine if the current user is authenticated or is a guest:
    1.1- @auth // The user is authenticated... @endauth
    2.2- @auth('admin') // The user is authenticated... @endauth //with guard

2- @if(auth()->guard('guard_name')->check()) ....... @endif

3- @if (Auth::check() && Auth::user()->role_id == 2)
        // button
@endif

4- @if(Auth::->user()->type == 'admin') 
        <h1>Welcome admin</h1>
@else
        <h1>Welcome user</h1>
@endif//Note: change type with the column name that you used to recognize each user




------------ Gates ------------

//Gates are a great way to learn the basics of Laravel's authorization features; however,
//when building robust Laravel applications you should consider using policies to organize your authorization rules.


1- to create a new gate, go to (App\Providers\AuthServiceProvider) in (boot()) and put the logic and actions

2- insert your logic
    use Illuminate\Support\Facades\Gate;
    use App\Models\User;
    
    Gate::define('update-post', function (User $user, Post $post) {
        return $user->id === $post->user_id;
    }); //(update-post) the gate name (User $user, Post $post) are the models name

    or 

    Gate::define('admin', function (User $user) {
        return $user->group_id === 2;
    }); //$user is the model name

    or 

    Gate::define('doctorAndAdmin', function (User $user) {
        return $user->group_id === 2 || $user->group_id === 3;
        //or return in_array($user->group_id, [2, 3]);
    });

    or

    1- for better approche we can have another table called userRolles for example which have the role name and id
    2- and in users table we put new cloumn named user_role which related to the userRolles table
    3- to not deal with id userRolles number we add instead, in userRolle model the following to indeintfy the ID of userRoles tables
        publick const is_admin = 1:
        publick const is_doctor = 1:
        publick const is_assistant = 1:
    4- fiannly in gate logic we indfiy the roles like that

        Gate::define('doctorAndAdmin', function (User $user) {
            return in_array($user->group_id, [userRolle::is_admin, userRolle::is_docotr]);
        });


3- use it in controller

    1- if (Gate::allows('isAdmin')) {
        echo 'Admin user role is allowed';
        } else {
            echo 'Admin are not allowed not allowed';
        }

    2- Gate::authorize('admin'); //(admin) the gate name


4- use it in blade view 
    1- @if (auth()->user()->can('update', $post))
        //
@endif

    2- @can('admin')
        //
@endcan

    3-@canany(['admin', 'doctor'])
@endcan
    //for multi gates with using OR oprator

    
5- use it in route middleware
    Route::middleware('can:admin')->group(function () {
        Route::get('/', function () {
    }); //(can() here is a bulidin middleware )

6- if you want to custm blade diractive such as @admin @endadmin 
    6.1 after doing all the pervious setps we put in (App\Providers\AuthServiceProvider) in (boot()) 
    6.2 (
        use Illuminate\Support\Facades\Blade;
        Blade::if('admin', function () {
            return request()->user()->can('admin');
        });) 

    // (if('admin') the name of the direative, (can('admin')) the name of the gate.
    
    6.3 use it in blade view as (@admin // @endadmin)



//error of (Call to a member function can() on null) //because the user is un-authenticated/logged out
    slouation:
@if(!Auth::guest()) or (@auth())
      Blade::if('admin', function () {
        return request()->user()?->can('admin');
    });



------------ Policies ------------

For more advanced authorization, it's probably more suitable to use Policies.
Policies are classes that organize authorization logic around a particular model or resource.
it is like a group of gates havning a group name to dfine and a spcific persmtion name for each gate inside the group (policy)
//policy must work with a model but in some cases yes

1- php artisan (make:policy PostPolicy) //it is stroed in (App\Policies)

    1.2 You may specify the model so you don't need to resgiter the policiy:
        (php artisan make:policy PostPolicy --model=Post)

2- Register policies to use when authorizing actions against a wanted model, in (app/Providers/AuthServiceProvider.php) in (protected $policies = [])
        we write the wanted model and the policy 
        (PostModel::class => PostPolicy::class)

3- writing policies in wanted policiy in (App\Policies)

    public function update(User $user, Post $post)
        {
            return $user->id === $post->user_id;
        } //it will return simple boolean values. true or false

    or

    public function update(User $user, Post $post)
        {
            return $user->group_id === 2 || $user->group_id === 3;
            //or return in_array($user->group_id, [2, 3]);
        }

    or

    1- for better approche we can have another table called userRolles for example which have the role name and id
    2- and in users table we put new cloumn named user_role which related to the userRolles table
    3- to not deal with id userRolles number we add instead, in userRolle model the following to indeintfy the ID of userRoles tables
        public const is_admin = 1:
        public const is_doctor = 1:
        public const is_assistant = 1:
    4- fiannly in gate logic we indfiy the roles like that

            public function update(User $user, Post $post) {
            return in_array($user->group_id, [userRolle::is_admin, userRolle::is_docotr]);
        });

4- using the policy

    4.2 usining in contraller:
        use App\Models\Post;
        ($this->authorize('update', Post::class);)

        4.1.2 Actions That Don't Require Models:
        ($this->authorize('create', Post::class);)

    4.3 Via Middleware:
        (->middleware('can:update,post'))

        4.3.2 Actions That Don't Require Models:
            (->middleware('can:create,App\Models\Post');)
            
    4.4 via blade
@can('update', $post)
            <!-- The current user can update the post... -->
@elsecan('create', App\Models\Post::class)
            <!-- The current user can create new posts... -->
@else
            <!-- ... -->
@endcan

        4.4.2 Actions That Don't Require Models:
@can('create', App\Models\Post::class)
                <!-- The current user can create posts... -->
@endcan


//to excute a method before any other methods on the policy. giving you an opportunity to authorize the action before the intended policy method is actually called.
This feature is most commonly used for authorizing application administrators to perform any action:
    
        public function before(User $user, $ability)
            {
                if ($user->isAdministrator()) {
                    return true;
                }
            }

        //or //it will basically check if your user is admin and if so no further checking is needed.
        public function before(User $authenticatedUser, $ability){
                // super admin can access everything
                if ($authenticatedUser->role == 'super_admin') {
                    return true;
                }
                return null; //fall through to the policy method
            }



------------ funcation to verfiy the user group id ------------

1- create a table called (Roles) that contain the roles details (id, name)
2- create another column (user_role) and user may have multiple roles not only Administrator
    Schema::create('role_user', function (Blueprint $table) {
    // having $table->id(); here is optional
    $table->bigInteger('user_id')->unsigned();
    $table->bigInteger('role_id')->unsigned();
    $table->foreign('user_id')->references('id')->on('users');
    $table->foreign('role_id')->references('id')->on('roles');
    }
3- Go to the User Model and create the function that handles the relationship between Role and User:
    public function roles() {
    return $this->belongsToMany(Role::class);
    }
4- Also inside the User Model create a function or multiple functions to check the User Roles depending on your project needs:
    public function isAdmin() {
    return $this->roles()->where('name', 'Admin')->exists();
    }
    public function isModerator() {
    return $this->roles()->where('name', 'Moderator')->exists();
    }

5- the use:
@if(Auth::user()->isAdmin())
     You are an Admin, showing Admin options...
@endif

@if(Auth::user()->isModerator())
     You are a Moderator, showing Moderator options
@endif

in the model (table)

    1- (public function isAdministrator() {
        return $this->roles()->where('name', 'Administrator')->exists();
    })

in the blade view

    2- (@if(Auth::user()->isAdministrator())
    enter code here
@endif)



-- or

1- add a column in user table (table->boolean('is_admin')->default(0);)
2-Then you can check: (@if($user->is_admin)@endif)

-- or

1- create a role column to user table
2- in user model: 
    public function isAdmin() {
    return $this->role == 'admin'l
    }
    public function isWriter() {
    return $this->role == 'writer';
    }
3- the using:
@if(Auth::user()->isServiceProvider())
        //am a service provider
@endif


------------ roles and permstion maniully ------------

1- create 3 tables (users), (permissions)(id,name,slug), (roles)(id,name,slug)

2- adding pivot tables:
    1- (users_permissions) //For this pivot table between users and permissions
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('permission_id');
            //FOREIGN KEY CONSTRAINTS
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            //SETTING THE PRIMARY KEYS
            $table->primary(['user_id','permission_id']);
            public function down()
            {
                Schema::dropIfExists('users_permissions');
            }

    2.2  (users_roles)
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('role_id');
            //FOREIGN KEY CONSTRAINTS
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            //SETTING THE PRIMARY KEYS
            $table->primary(['user_id','role_id']);
            {
                Schema::dropIfExists('users_roles');
            }
    2.3 (roles_permissions) //For example, a user may have the permission for post a topic, and an admin may have the permission to edit or delete a topic. In this case, let’s setup a new table for roles_permissions
             $table->unsignedInteger('role_id');
             $table->unsignedInteger('permission_id');
             //FOREIGN KEY CONSTRAINTS
             $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
             $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
             //SETTING THE PRIMARY KEYS
             $table->primary(['role_id','permission_id']);
            public function down()
            {
                Schema::dropIfExists('roles_permissions');
            }

3. setting up the relationships, We’ll start by creating the relationships between roles and permissions table. In our Role.php , Permision.php.

    3.1 in (App/controllers/Role.php)
        public function permissions() {
            return $this->belongsToMany(Permission::class,'roles_permissions');
        }
        public function users() {
            return $this->belongsToMany(User::class,'users_roles');
        }
    3.2 in (App/controllers/Permission.php)

4. creating a Trait:
    4.1 Inside of our app directory, let’s create a new directory and name it as Permissions and create a new file namely (HasPermissionsTrait.php)
        //in that we created (App/Permissions/HasPermissionsTrait.php)
    namespace App;

    use App\Permissions\HasPermissionsTrait;

    class User extends Authenticatable
    {
        use HasPermissionsTrait; //Import The Trait
    }
    Now open HasPermissionsTrait.php and paste those following code.

    App/Permissions/HasPermissionsTrait.php
    namespace App\Permissions;
    use App\Permission;
    use App\Role;
    trait HasPermissionsTrait {
    public function givePermissionsTo(... $permissions) {
        $permissions = $this->getAllPermissions($permissions);
        dd($permissions);
        if($permissions === null) {
        return $this;}

        $this->permissions()->saveMany($permissions);
        return $this;
    }

    public function withdrawPermissionsTo( ... $permissions ) {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;}

    public function refreshPermissions( ... $permissions ) {
        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);}

    public function hasPermissionTo($permission) {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);}

    public function hasPermissionThroughRole($permission) {
        foreach ($permission->roles as $role){
        if($this->roles->contains($role)) {
            return true;}}
        return false;}

    public function hasRole( ... $roles ) {
        foreach ($roles as $role) {
        if ($this->roles->contains('slug', $role)) {
            return true;
        }
        }
        return false;
    }
    public function roles() {

        return $this->belongsToMany(Role::class,'users_roles');}

    public function permissions() {
        return $this->belongsToMany(Permission::class,'users_permissions');}

    protected function hasPermission($permission) {
        return (bool) $this->permissions->where('slug', $permission->slug)->count();}

    protected function getAllPermissions(array $permissions) {
        return Permission::whereIn('slug',$permissions)->get();}
    }

    //we’re iterating through the roles and checking by the slug field, if that specific role exists. You can check or debug this by using:
        $user = $request->user(); //getting the current logged in user
        dd($user->hasRole('admin','editor')); // and so on

4. create CustomProvider


------------ roles and permstion package (Spatie) ------------

1- install the package with termnial with composer
    (composer require spatie/laravel-permission)
    (composer require laravelcollective/html)

2- Optional: The service provider will automatically get registered. Or you may manually add the service provider in (config/app.php) in ('providers' => []):
    'providers' => [
    // ...
        Spatie\Permission\PermissionServiceProvider::class,
    ];

3- You should publish the migration and the config/permission.php config file, We can also custom changes on Spatie package
    (php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider")

5- Clear your config cache
    (php artisan optimize:clear)
    # or
    (php artisan config:clear)

4- Run the migrations
    (php artisan migrate)
    or
    (php artisan migrate:fresh)

5- in the user model we add

    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    use Spatie\Permission\Traits\HasRoles;
    class User extends Authenticatable
    {
        use HasFactory, Notifiable, HasRoles;
        //
    }


5- Add Middleware, we have to add middleware in Kernel.php (app/Http/Kernel.php) in (routeMiddleware)

    protected $routeMiddleware = [
        ....
        'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
        'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
        'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,
    ]

6- make contraller for the user contral roles and permssion
        (php artisan make:controller UserController)
        (php artisan make:controller admins/RoleController)

7- make pages for getting users and create users and roles (u can copy them from view in my the doc laravel files)

8- Create Seeder For Permissions and AdminUser (you should use the steps as folloing one by one) (seeder is where we place data in laravel to be sent to db)
    (php artisan make:seeder PermissionTableSeeder)
    (php artisan make:seeder CreateAdminUserSeeder)

    8.2- in (database/seeds/PermissionTableSeeder.php) we put
        use Spatie\Permission\Models\Permission;
        public function run()
        {
            $permissions = [
                'role-list',
                'role-create',
                'role-edit',
                'role-delete',
                'product-list',
                'product-create',
                'product-edit',
                'product-delete'
            ];

            foreach ($permissions as $permission) {
                Permission::create(['name' => $permission]);
            }
        }

    8.2- after creating new seeder for creating admin user, in (database/seeds/CreateAdminUserSeeder.php) we put
        public function run()
            {
                $user = User::create([
                    'name' => 'Hardik Savani', 
                    'email' => 'admin@gmail.com',
                    'password' => bcrypt('123456')
                ]);
                $role = Role::create(['name' => 'Admin']);
                $permissions = Permission::pluck('id','id')->all();
                $role->syncPermissions($permissions);
                $user->assignRole([$role->id]);
            }

    8.3 run PermissionTableSeeder and admin seeder
        (php artisan db:seed --class=PermissionTableSeeder) //must run first
        (php artisan db:seed --class=CreateAdminUserSeeder)
 9- you can add roles and perimstionin db or in seders (such as above)
 
10- the usage:
    9.1: in blade
            (@can('product-delete')@endcan)
            or
            (@if (Auth::user()->hasRole('Admin')) // @endif)
            or
            (@role('Admin')@endrole)
            or
            (@hasanyrole('admin','writer')@endhasanyrole)


    9.2: in route
        Route::group(['middleware' => ['can:publish articles']], function () {
            //
        });
        or
        Route::get('/test11', [PostCont::class, 'test1'])->middleware(['can:role-create'])
        or
        Route::group(['middleware' => ['role:super-admin']], function () {//});
        or
        Route::group(['prefix' => 'ad', 'middleware' => ['can:user-show']],function () {//});
        or for multi 
        'middleware' => ['role:Super-admin|Receptionist']]
         
    9.3: in contllere
        public function __construct()
        {
            $this->middleware(['role:super-admin','permission:publish articles|edit articles']);
            -or
            $this->middleware('role:Super-admin')->only('index', 'show');
            -or
            $this->middleware('role:Super-admin|Doctor|Receptionis|Call-center')->only('index');
            $this->middleware('role:Super-admin|Doctor|Receptionis|Call-center')->only('show');
            $this->middleware('role:Super-admin|Doctor|Receptionis|Call-center')->only('create');
            $this->middleware('role:Super-admin|Doctor|Receptionis|Call-center')->only('store');
            $this->middleware('role:Super-admin|Doctor|Receptionis')->only('update');
            $this->middleware('role:Super-admin|Doctor|Receptionis')->only('edit');
        }

    9.4: bulidin funcations 
        -for creating
            $role = Role::create(['name' => 'writer']);
            $permission = Permission::create(['name' => 'edit articles']);
        -A permission can be assigned to a role using 1 of these methods:
            $role->givePermissionTo($permission);
            $permission->assignRole($role);
        -Multiple permissions can be synced to a role using 1 of these methods:
            $role->syncPermissions($permissions);
            $permission->syncRoles($roles);
        A permission can be removed from a role using 1 of these methods:
            $role->revokePermissionTo($permission);
            $permission->removeRole($role);

        -for selecting
            == $user = User::find(8);
                return $user->getRoleNames();
            ==$permissionNames = $user->getPermissionNames();
            ==$request->user()->roles()->pluck('name','id');
            ==Auth::user()->hasRole('seller','admin')
            ==Auth::user()->hasAllRoles('seller','admin')
            == Auth::user()->roles->pluck('name')[0] //to get the current user role name



------------ my approch ------------
1- create a table named user_roles
2- create a coulmn in user or admin table called user_role which have a relationship with user_roles table
3- in user or admin table we define the user role number to be more readable such as:
        public const is_admin = 1:
        public const is_doctor = 1:
4- in route we make a group of route havning the middlware with auth

5- bulid gates loagics for dashboard, menus, and other without model


------------------------------------------------ Authorization






///// ------------------------ 10- Parameters ------------------------ /////


//for passing parameters
//first we need to create a route with defining the parameter
//in contller we need to define it in the func to use it
//in view we need to send the parameter to the route to revice it by conttler

//---------- in route ----------

    //to put a requred paramter {userid}
    1:Route::get('/postsdelete/{nameOftheParameter}', [PostCont::class, 'deletepost'])->Name('postsdelete');

    2:[Route("/Abc/Details/{id}/{date}")] //for multi parameters

    //optional Parameters
    3:Route::get('/user/{nameOftheParameter?}', function ($name = null) { return $name; });

    4: [Route("/Abc/Details/{id?}/{date?}")] //for multi parameters

    3: Route::get('/', function () {
    return view('welcome', [
        'post' => 'hello',
        'user' => '21',
    ]);
    });

    4: Route::get('/posts/{post}/comments/{comment}', function ($postId, $commentId) {
    //}




//------------ in contller ------------

===== recive data from url parameters and http request =====

==== from the parameters
//we must define it in the route first to get the passed parameter in conttller
    
   public function userposts($nameOftheParameterWeCreatedInRoute)
    {
        $users = Usertest::find($nameOftheParameterWeCreatedInRoute);
        $posts = $users->posts;

        return view('posts', compact('posts'));
    }

    //we can use public function editstore(Request $request)
    // instead of (public function userposts($nameOftheParameterWeCreatedInRoute))

    == for multi 
    public function userposts($nameOftheParameterWeCreatedInRoute,$nameOftheSecondParameterWeCreatedInRoute)
        {}

==== from http requestrom the form in the view
    public function store(Request $request)
    1- ($name = $request->inputNameFromForm)
    2- ($name = $request->input('inputNameFromForm');)
    3- ($name => $request->get('inputNameFromForm'))
== rembmer to use the path in the botton with (Request $request)
    Illuminate\Http\Request


===== pass parameter to view =====

    1: ==->with('name', 'shady');
    
    2: return view('admins.create')->with('countries') //countries is the variable

    3: return view('greeting')
            ->with('name', 'Victoria')
            ->with('occupation', 'Astronaut');

    4: return view('posts', compact('posts'));

    5: return view('posts', compact('parameter1', 'parameter2'));

    6: $date=[]
    $date['name] = 'adfafa'
    $date['user] = '312'
    return view('welcome', $date);

    7:return view('greetings', ['name' => 'Victoria']);




//------------ in view ------------

------ send data ------ 

==remember to use ->Name('nameRoute'); in ur route

-- 1- HTTP request (form): to send data to a specific route contreller via http request
     (<form method="POST" action="{{ route('postSend') }}">)
@csrf// rembmer to use the protcation
    //remember to define the route by ->Name('routeName'); in ur route

    //to send multi data in input inside the form
      <select type="select" name="serviceid[]" class="form-control" multiple>

-- 2- (a href) to send data to a specific route contreller via (a href)
   
        1- <a href="{{ route('routeName', $item -> id) }}"><button class="btn btn-info"> more </button></a>

        2- for multi parameter
            ==<a href="{{ route('post.show',['FirstParamterNameFromRoute'=>$post->id,'SecondParamterNameFromRoute'=>$post->title]) }}">Show</a>
            ==  <a href="{{ route('test11', ['para1','para2']) }}">heeey</a>
            
-- to pass parameter to contraller recources
    mydomain/users -> index method.
    mydomain/users/1 -> show method.
    mydomain/users/1/edit -> edit method. etc...

------ to recive data from parameter ------

1- from compact(compactName) and (with())
    1- ($compactNameOrWithName) //we can do it with (foreach())
    2- ($compactNameOrWithName -> id) to get a speficic value inside the parameter
    3- @foreach ($compactNameOrWithName as $iteam)
            <option value="{{ $iteam->id }}">{{ $iteam->name }}</option>
@endforeach
        
    //if it is collecation array $compactNameOrWithName[0] -> name //we can do it with foreach()

2- from normal parameter ['name' => 'Victoria']
    {{ $name }}


3- get data from the realtionship ($users = User::select('first_name','avatar')->with('branch')->get();)
    in case it return an array ($iteam->branch['name'])
    // // // an object  ($article->poster->name)

//if we need to get the data of the relationship we put it another foreach inside the main foreach loop
@foreach($contents->posts as $role)
    {{ $role->title }}
@endforeach



------------------------------------------------ parameters





///// ------------------------ 11- Pagination and (Events and Listener) ------------------------ /////


------------- Pagination -------------

The paginate method automatically takes care of setting the query's "limit" and "offset" based on the current page being viewed by the user.
 //in other words, paginiation will devide the data into parts, an example of a table has 100 records, pagination will divide the 100 into 10 records per page and create page url for each page divided
//an exmaple http://localhost:8000/showuser?page=2


pagination in contller:

    $users = Usertest::select('id', 'name', 'email')->paginate(5); //5: how many recored per page, the defulat is 10

    return view('userposts', compact('users'));


pagination in view html:
    1- Laravel includes pagination views built using Bootstrap CSS. To use these views instead of the default Tailwind views,
    you may call the paginator's useBootstrap method within the boot method of your App\Providers\AppServiceProvider class:
        use Illuminate\Pagination\Paginator;
        public function boot()
        {
            Paginator::useBootstrap();
        }
    2- in html (view)
        {{ $users->links() }} //$users tha name of query that includes (paginate())
        -- or {!! $users->links() !!}




        
------------- Events and Listener -------------

events provide a simple observer pattern implementation, allowing you to subscribe and listen for various events that occur within your application.
for instance, login, a class can be created to monitor the activity of login, when a user logs in, the event class can execute some functions and for example notify the admn.

In simple words, think of event as something that has occurred in your application and listeners as a set of logic to respond with. Therefore, this allows us, developers,
to make announcements within the application that something has happened and perform a set of operations based on that specific event.

an example of a post. Once a post is created, the users will be notified about the post through emails.

another example, youtube, if u open an video (event), the views will be increased (listner)
A Listener is a class that listens to the (events) that they are mapped to and execute a task, that is they are the ones that perform a given task for an event.
Event classes are typically stored in the (app/Events) directory, while their listeners are stored in (app/Listeners)



---------- create ----------

//an example of inceasing the viewer of the video in every time the user open the page

1- to create an event termnal, (php artisan make:event Vidwoviewer)
2- to create an listener termnal, (php artisan make:listener Increasecounter)

3- After that, you need to register your events and listeners in file (app/Providers/EventServiceProvider.php) in ($listen =[])

        Vidwoviewer::class => [
            IncreaseCounter::class,
        ],
        //(Vidwoviewer is the even)(IncreaseCounter is the listner)

4- in databas, we need to add a new column to store the action, for example in youtube viedo is to store the views and incrase the number each time a user enter the video

5- in event, we pass the model(db) that we need to stroe the action in, and take value from it. 
then, making it (value) public and menthion it inside (__construct) to make the listern call it 

    use App\Models\Youtubevideo;
    public $eventvideo; //making it public
    public function __construct(Youtubevideo $video){$this->eventvideo = $video;}


6- connect event to listener, we put event name in (lisietner) (public function __construct()) parameter and take a value from it, note: puting the namespace of the event in the page top
//and also we create a func to deal with db and insert it in (handel) with passing the db query that comes from even
    use App\Events\VideoViewer;
    public function handle(Vidwoviewer $event){
        $this->updateview($event->eventvideo);
    }

7- in listener, we create a funcation to deal with the database, with a parameter that recive the database query (it passes via contller to event, to listner and finally to the func)
    function updateview($videoUpdate)
    {
        $videoUpdate->viewer = $videoUpdate->viewer + 1;
        $videoUpdate->save();
    }

8- in contller, we select the wanted db query then pass it to event, the event pass it to the listner
        event(new Vidwoviewer($video)); // to fire even
//Vidwoviewer($video) is the event name with the db query




------------------------------------------------ Pagination and (Events and Listener)




///// ------------------------ 12- task scheduler ------------------------ /////

The scheduler allows you to fluently and expressively define your command schedule within your Laravel application itself.

Applications require some tasks to be run periodically on the server.
It could be sending promotional emails, optimizing database, creating backups or generating site traffic report.
To automate these tasks, a task scheduling system is required. Laravel Cron Job offers an elegant Task Scheduling mechanism.

for example, send an email every day at midnight. or make a user can not acess to the website after a certin of time and edit the db user


------- create -------

1- to create a new task, in termnal, (php artisan make:command Dailyusersexpire) 
    //it is stored in (App\Console\commands)php artisan make:command Dailyusersexpire

2- in the wanted task (App\Console\commands) we change the task name and description
    protected $signature = 'usersexpire';
    protected $description = 'we send an email to the expitred user every 5 min';

3- insert all the wanted logic and actions in func (handle())
    public function handle(){
        $user = User::where('expire', '0')->get();
        foreach ($user as $iteam) {
            $user->update(['expire' => 1]);
        }
    }

4- to run the handle() every a certin of time, we link karnel to the task file by going to (app/Console/Kernel.php)
and in ($commands = []) we put the task path file:

    use App\Console\Commands\Dailyusersexpire;
    protected $commands = [
        Dailyusersexpire::class,
    ];

4- to run the task every certin of time in (app/Console/Kernel.php) in (schedule(Schedule $schedule){}) we put the period of time
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('usersexpire')->hourly();
    } //(usersexpire) the name of the task name file, which it is (protected $signature = 'usersexpiremail')

//we can change (->hourly()) by:
    ->everyMinute();
    ->everyFiveMinutes();
    ->hourlyAt(17);
    ->everySixHours();
    ->daily(); (Run the task every day at midnight)
    ->dailyAt('13:00');	
    ->twiceDaily(1, 13);
    ->weekly();	(Run the task every Sunday at 00:00)
    ->monthly(); (Run the task on the first day of every month at 00:00)
    ->sundays();
    ->fridays();	
    ->twiceMonthly(1, 16, '13:00'); (Run the task monthly on the 1st and 16th at 13:00)
    ->yearly();	
    ->days([Schedule::SUNDAY, Schedule::WEDNESDAY]);
    ->when(Closure);

        //->timezone('America/New_York');(Set the timezone for the task)
        $schedule->command('report:generate')
        ->timezone('Africa/Cairo')
        ->at('2:00')

// to test and run the task sechedule imdetely
    (php artisan schedule:run)




----- an example of sedning an email to all users every day  -----

1- follow all the pervious stepts
//but in (handle()) (App\Console\Commands\Dailyusersexpire) we will put different logic

2- generating mailables which is stored in (app/Mail)
    (php artisan make:mail DailyMailUser)

3- create a html view to be your email forma
4- to conect the html email forma to the mailables, open the wanted mailables in (app/Mail) and in (build())
        return $this->view('emailuser'); //(emailuser) is the html view

5- in ((handle())) (App\Console\Commands\Dailyusersexpire) we do our action
    public function handle(){
        $users_email = User::select('email', 'name')->get();
        $name = ['name' => 'amr', 'title' => 'welcome'];
        foreach ($users_email as $iteam) {
            //$name = $iteam->name; //if we want to send the user name

            Mail::to($iteam->email)->send(new DailyMailUser($name));
            //(Mail::to()->send();) is to send email
                //to() who you want to send the email
                //->send() we put the name of the wanted mailables (app/Mail)
                    //which we can pass data to to it to pass the data it to the html view
        }
    }

6- in case that there is data to recive in mailables in (app/Mail) that comes from (handle()) to pass it to the view
    6.1 in (__construct()) we put the passed parameter of the sent data from (handle())(->send();)
    6.2 we create a public var outside (__construct()) to use
    6.3 inside the (__construct()) we connect the public var to the passed parameter

        public $detiails;
        public function __construct($name)
        {
            $this->detiails = $name;
        }
    
    6.5 in (build()) we don't need to use compact()) to pass data to the view becuase this method bring all view insde it in php page,
    //so the html view will see the passed parameter without using anything
        public function build()
        {return $this->view('emailuser');}

    6.6 in the html email forma view we use the passed parameter like taht
        <h1>Hellllo <span>{{ $detiails['name'] //just ($detiails) use if we want to send the user name }}</span>, welcome to our website</h1>


------------------------------------------------ task scheduler


///// ------------------------ 13- multi language  ------------------------ /////

-- the folder of the languges are located in resources/lang and we add whatever language we need by creating a new folader with the langauge shortcut such as (ar)
-- we create a file called messages or any name in all langs folders
-- we put the same variber in both file in all lanagues files with the same name to refere and change the value depnds on the lang for ex
        //the folder of en with file called message for example
    'password' => 'The provided password is incorrect.',
            //the folder of ar with file called message for example
    'password' => 'الباسورد الذي ادخلته غير صحيح',

-- to print it in veiw blade or contrller
    1- {{ __('passwords.reset') }}
    - (trans(messages.hello))
-- so, it will work when we change the language

--Note: the defult lang of the website can be finded in app/config/app.php ('local' => en)



------ install mcamara Package

--1: Install the package via composer: composer require mcamara/laravel-localization
--2: then, In order to edit and contral the package and the default configuration you may execute:
php artisan vendor:publish --provider="Mcamara\LaravelLocalization\LaravelLocalizationServiceProvider"

--3: then going to config/laravellocalization.php then remoce (//) in the language u want to use

--4: register the package middleware in the app/Http/Kernel.php file and in $routeMiddleware:
protected $routeMiddleware = [
        'localize'                => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
        'localizationRedirect'    => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
        'localeSessionRedirect'   => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
        'localeCookieRedirect'    => \Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect::class,
        'localeViewPath'          => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class
    ];

5-- Usage: Add the following to your routes file to make the all route inside the given route have arabic and english or whatever language it is in the route:

    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
    Route::group(['prefix' => LaravelLocalization::setLocale()], function()
    {//});
    //Once this route group is added to the routes file, a user can access all locales added into supportedLocales (en and es by default). For example, the above route file creates the following addresses:

6-- it is opationl to use the middleware and it is forceed the user to put the ar or en in the url
    Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ //...
    });

7-- to creating a language selector in html
        <ul>
@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li>
                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                    </a>
                </li>
@endforeach
        </ul>
        
8-- to change css style depends on the language
@if(App::getLocale() == 'ar')
            <!-- own style -->
            <link href="{{ URL::asset('css/main-rtl.css') }}" rel="stylesheet">
@else
            <!-- own style -->
            <link href="{{ URL::asset('css/main.css') }}" rel="stylesheet">
@endif

9-- to set icon we insert new proprty in config/laravellocalization.php
        'ar'          => ['name' => 'Arabic',                 'script' => 'Arab', 'native' => 'العربية', 'regional' => 'ar_AE', 'icon' => 'uae.png'],
    9.1 in blade
        <img src="{{ URL::asset('img/dashboard/country_flags/' . $properties['icon']) }}">
    9.2 put the following to insert icon to the current language in vendor/mcamara/laravel-localization/src/Mcamara/LaravelLocalization/LaravelLocalization.php

    public function getCurrentLocaleIcon()
    {
        return $this->supportedLocales[$this->getCurrentLocale()]['icon'];
    }

    in blade
    <img class="me-1"
                    src="{{ URL::asset('img/dashboard/country_flags/' . LaravelLocalization::getCurrentLocaleIcon()) }}">
                {{ LaravelLocalization::getCurrentLocale() }}



//if we want to insert data in both arabic and english we need to have 2 columns in the table, one for ar and one for eng for example title_ar and title_en
//and if we need to select the data depnds on the languge we use the following:
        $que1 = Post::select('title_' . LaravelLocalization::getCurrentLocale(). ' as title', 'excerpt', 'user_id')->get();
{{ LaravelLocalization::getCurrentLocale() }} //to get the current languge using, it returns for example ar or en

------------------------------------------------ multi language 


///// ------------------------ 14- backup  ------------------------ /////

//-- 1 = You can install this package via composer using:
    (composer require spatie/laravel-backup)
//-- 2 = To publish the config file to config/backup.php run::
    (php artisan vendor:publish --provider="Spatie\Backup\BackupServiceProvider")
//-- 3= By default, the backup will be saved into the (public/laravel-backup/) directory of your laravel application.
//-- 4= After you have performed the basic installation you can start using the backup:run, backup:clean, backup:list and backup:monitor-commands.
//-- 5= you will find tha backuo in (/storage/app)
//-- in case we find error of not finding database dump we add the following to (confg/database.php) after ('mysql' => ['driver' => 'mysql',)
            'dump' => [
                'dump_binary_path' => '/Applications/XAMPP/xamppfiles/bin', // only the path, so without `mysqldump` or `pg_dump`
                'use_single_transaction',
                'timeout' => 60 * 5, // 5 minute timeout
             ] ,

//-- 6= to chnage backup file path, first we add new path to (config/filesystems.php) then we change ('disks' => [ 'local', ]) in (confg/backup.php) to wanted the name path we put in (filesystems.php)
//-- 7= to only backup the database we delete (base_path(),) in config/backup.php
    'include' => [
        base_path(),
    ],

//-- 5= Scheduling, The commands can be scheduled in Laravel's console kernel, just like any other command.
    // app/Console/Kernel.php
    protected function schedule(Schedule $schedule){
    $schedule->command('backup:clean')->daily()->at('01:00');
    $schedule->command('backup:run')->daily()->at('01:30');}
    }
    
------------------------------------------------ backup

///// ------------------------ 15- Recaptcha  ------------------------ /////

//-- 1 = Installation no-captcha package
            (composer require anhskohbo/no-captcha)
//-- 2 = In app/config/app.php add the following :
    1- The ServiceProvider to the providers array :
    Anhskohbo\NoCaptcha\NoCaptchaServiceProvider::class,
    2- The class alias to the aliases array :
    'NoCaptcha' => Anhskohbo\NoCaptcha\Facades\NoCaptcha::class,
    3- Publish the config file
    php artisan vendor:publish --provider="Anhskohbo\NoCaptcha\NoCaptchaServiceProvider"

//-- 1 = create an accoiunt from here:
    (https://www.google.com/recaptcha/admin/create)

//-- 4= then get the site key and secret key
    // site key
    6LcCSpceAAAAANIZY6QwMERLeph6GIms66kdENv4
    // site key
    6LcCSpceAAAAAFEzln1PxD3hK4rZn0IUFM2JMJqn

    2- Add NOCAPTCHA_SECRET and NOCAPTCHA_SITEKEY in (.env) file:
        NOCAPTCHA_SECRET=secret-key-here
        NOCAPTCHA_SITEKEY=site-key-here

    3- then restart the project for env file
//-- 4= Usage
        1- in view
            {!! NoCaptcha::display() !!}

        2- Then check for captcha errors in the Form :
@if($errors->has('g-recaptcha-response'))
                <span class="help-block">
                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                </span>
@endif

        2- in contraller
        $validate = Validator::make(Input::all(), [
            'g-recaptcha-response' => 'required|captcha'
        ]);

        Then check for captcha errors in the Form :

@if($errors->has('g-recaptcha-response'))
    <span class="help-block">
        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
    </span>
@endif

------------- without package -------------
//-- 1= create an accoiunt from here:
    (https://www.google.com/recaptcha/admin/create)

//-- 2= then get the site key and secret key
    // site key
    6LcCSpceAAAAANIZY6QwMERLeph6GIms66kdENv4
    // site key
    6LcCSpceAAAAAFEzln1PxD3hK4rZn0IUFM2JMJqn

//--  Make a custom validation rule (php artisan make:rule Recaptcha) and put the following
    class Recaptcha implements Rule{
        public function __construct(){ }
        public function passes($attribute, $value){
            $data = array(
                'secret'   => env('GOOGLE_RECAPTCHA_SECRET'),
                'response' => $value
            );
            try {
                $verify = curl_init();
                curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
                curl_setopt($verify, CURLOPT_POST, true);
                curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($verify);
                return json_decode($response)->success;
            } catch (\Exception $e) {
                return false;}
        }
        public function message(){return 'ReCaptcha verification failed.';}
    }

//-- Update env file Put the site key and secret key into env file which you got in step no 2.
    GOOGLE_RECAPTCHA_KEY=HereIsTheKey
    GOOGLE_RECAPTCHA_SECRET=HereIsTheKey

//-- 3= insert the following in html head and body (form)
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <div class="g-recaptcha" id="feedback-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
@error('g-recaptcha-response')
        <span class="error-msg-form">
            {{ $message }}
        </span>
@enderror

//-- reCaptcha validation
public function postContactForm(Request $request){

	$this->validate($request, [
    	'g-recaptcha-response' => ['required', new Recaptcha()]
	]);

	// Recaptcha passed, do what ever you need

}

//-- after that you can clean cache and config and run the app once again
php artisan cache:clear
php artisan config:clear
php artisan route:clear


------------------------------------------------ End Recaptcha

///// ------------------------ 16 - Zoom  ------------------------ /////
1- register in zoom, then going to markekt place and bulid app in (jwt) and get the api key and secret
2- You can install the package via composer
    (composer require macsidigital/laravel-zoom)
3-  Publish the configuration file 
    (php artisan vendor:publish --provider="MacsiDigital\Zoom\Providers\ZoomServiceProvider")
    //This will create a zoom.php config file within your config directory:-
4- You need to add ZOOM_CLIENT_KEY and ZOOM_CLIENT_SECRET into your .env file.
    ZOOM_CLIENT_KEY=ltJyQwO6TP2dOtKJJHnzeQ
    ZOOM_CLIENT_SECRET=xf2GcWQ3sKnZFBzzHZ6Ca3lvEQwzI6eM4XaA
5- create a table to conect zoom with it contaning id, topic, start_at, duration(optional) ,password(optional), start_url, join_url
6- to create meeting

    use MacsiDigital\Zoom\Facades\Zoom;
    
    $user = Zoom::user()->first(); //get the zoom account info

    $meeting = Zoom::meeting()->make([
      'topic' => 'New meeting',
      'type' => 8,
      'start_time' => new Carbon('2020-08-12 10:00:00'), // best to use a Carbon instance here.
      'timezone' => 'Africa/Cairo'
    ]);

    $meeting->settings()->make([
      'join_before_host' => true,
      'approval_type' => 1,
      'registration_type' => 2,
      'enforce_login' => false,
      'waiting_room' => false,
    ]);
    $user->meetings()->save($meeting);

     $appointment = appointment::create([ 
                'zoom_meeting_id' => $meeting->id,
                'zoom_start_url' => $meeting->start_url,
                'zoom_join_id' => $meeting->join_url,
    ]); 
7- others:
// End Meeting
$meeting = Zoom::meeting()->find('$id'); 
$meeting->endMeeting();
$meeting->delete()
// delete
$meeting->delete($scheduleForReminder); // Delete (destroy) meeting. ScheduleForReminder true by default

------------------------------------------------ Zoom



///// ------------------------ 17 - API  ------------------------ /////

1- API is to connect all the applications togther (mobile app)
2- Postman is working as a mobile developer to see the api comes from laravel (send and receive)
    1- we put in header (key:Accept value:application/json) to force make the postman use json back respon
3- we put all api route in api routs recomended and the defialt prefex is (/api/) EX (http://localhost:8000/api/patient/createcityajax/1)
    --you can change the default prefix in (App\Providers\RouteServiceProvider) in (function boot()) in (Route::prefix('api'))
4- every return must return Json 
    $test = "Hello World";  return response()->json($test);
5- we use authentication for api which is diferent to laravel authentication cuz laravel use sesstion but moible app ex not using
    //we use JWT (JSON Web Token) it's creating data with optional signature and/or optional encryption code whose payload holds JSON, The tokens are signed either using a private secret or a public/private key.
    //or recomended Sanctum is a simple package to issue API tokens to your users without the complication of OAuth. Sanctum uses Laravel's built-in cookie-based session authentication services.
    //or Passport simply lets you share cookies (even sessions) with other domains by some config in the .env file. So when a user logged in with laravel you will store some cookies and pass them to other domains as an active user (authenticated user).

    //every user must has token to enable them to enter the system from mobile app 
    //install jwt-auth (composer remove tymon/jwt-auth) for jwt

    //1- install sanctum (Sanctum allows you to issue API tokens / personal access tokens that may be used to authenticate API requests to your application. When making requests using API tokens)
        //which means that every user will have different token saved in table (personal_access_tokens) to acess to the app
        (composer require laravel/sanctum)
        //the user send email and password if it is correct the sanctum create token and save it in db in table (personal_access_tokens) then send another token which is authiacted to the token in database back which is be shown once to the user which can be used to be authtiacted and match the token that is saved in db
    //2- You should publish the Sanctum configuration and migration files
        (php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider")
        (php artisan migrate) (to create personal_access_tokens)

    //3- in (app/Http/Kernel.php) we put in ($middlewareGroups)
        'api' => [
        \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        'throttle:api',
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    //4- going to the user modal and put
        use Laravel\Sanctum\HasApiTokens;
        class User extends Authenticatable
        {
            use HasApiTokens, HasFactory, Notifiable;
        }
    //5- to create token 
        $token = $user->createToken('token-name')->plainTextToken;
    
    //6- register 
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);
        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    //7- login
        // Validate the form data
        $this->validate($request, [
            'phone_number'   => 'required|numeric',
            'password' => 'required',
            //'device_name' => 'required', for mobile app //need to be placed in token name
        ]);
        // Check email
        $user = User::where('email', $fields['email'])->first();
        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }
        $token = $user->createToken('myapptoken')->plainTextToken; //to create token
        $response = [
            'user' => $user,
            'token' => $token //to send back the token code
        ];
        return response($response, 201);
        
    //8- to logout
        auth()->user()->tokens()->delete();
        //or Revoke the token that was used to authenticate the current request...
        //$request->user()->currentAccessToken()->delete();
        return [
            'message' => 'Logged out'
        ];
    //9- after login we can use the token given from login form with the request to be authticated;

    //10- Token Abilities (roles) 
        return $user->createToken('token-name', ['server:update'])->plainTextToken; //server:update is the perimation
        -10.2 When handling an incoming request authenticated by Sanctum, you may determine if the token has a given ability (perimsation). to do it we use the tokenCan method in contraller:
            if ($user->tokenCan('server:update')) {
                //
            }else{return response()->json('not allowed to be here')}
            
            - 10.2.2 to check the ability (perimation) in middleware we need to add the following first to (app/Http/Kernel.php) in ($routeMiddleware)
                'abilities' => \Laravel\Sanctum\Http\Middleware\CheckAbilities::class,
                'ability' => \Laravel\Sanctum\Http\Middleware\CheckForAnyAbility::class,
            - 10.2.3 to use it in middleware (abilities middleware may be assigned to a route to verify that the incoming request's token has all of the listed abilities)
                Route::get('/orders', function () {
                    // Token has both "check-status" and "place-orders" abilities...
                })->middleware(['auth:sanctum', 'abilities:check-status,place-orders']);
            - 10.2.4 to use it in the middleware (The ability middleware may be assigned to a route to verify that the incoming request's token has at least one of the listed abilities)
                Route::get('/orders', function () {
                    // Token has the "check-status" or "place-orders" ability...
                })->middleware(['auth:sanctum', 'ability:check-status,place-orders']);

    //my way for auth, to use spetie laravel and get roles and store them in sanctum abilites
        $roles = $user->getRoleNames()->toArray();
        $token = $user->createToken('mymobile_token', $roles)->plainTextToken;
        //in route
        Route::resource('appointment', Appointment::class)->middleware('ability:Super-admin,Call-center');

//- for public authication route and all, we may bulid password for our route via middleware 
    -1- create middleware (checkApiPass) 
        (php artisan make:middleware checkApiPass)

    -2- regsiter in (app/Http/Kernel.php) in (protected $routeMiddleware = [])
        'checkApiPass' => \App\Http\Middleware\checkApiPass::class,

    -3- find in (app/Http/Middleware) and put
        public function handle($request, Closure $next){
            if( $request->api_password !== env('API_PASSWORD','WsewqsQc128iXcLAxanv0XLZcgh6sp013zetWNuqptk')){
                return response()->json(['message' => 'Unauthenticated.']);
            }
            return $next($request);
        }
    -in env file we put then refresh env (php artisan config:cache)
        (API_PASSWORD=WsewqsQc128iXcLAxanv0XLZcgh6sp013zetWNuqptk)
    
    -use it in middleware route
        Route::group(['middleware' => ['auth:sanctum','checkApiPass']], function () {
            Route::resource('appointment', Appointment::class)->middleware('ability:Super-admin,Call-center');
        });
    -to send api_password we use (key:api_password value:WsewqsQc128iXcLAxanv0XLZcgh6sp013zetWNuqptk)
------------------------------------------------ API


///// ------------------------ 18 - Zoom Google analytics  ------------------------ /////
install
        1- run composer
            (composer require spatie/laravel-analytics)
        2- Optionally, you can publish the config file of this package with this command:
            (php artisan vendor:publish --provider="Spatie\Analytics\AnalyticsServiceProvider")
        3- in config/app.php put in provider
                Spatie\Analytics\AnalyticsServiceProvider::class,
            2- and in Aliases
            //googla stat
            'Analytics' => Spatie\Analytics\AnalyticsFacade::class,


        4- open (https://console.cloud.google.com/apis)
            1- create new api project
            2- enable Google Analytics API
            3-  Click "Credentials" in the sidebar. You’ll want to create a "Service account key".
            4- Select "JSON" as the key type and click "Create" to download the JSON file.
            5- it will donwload a json file contining all acc info and name
            6- move it and name to the path that you can find in (config/analytics.php) in service_account_credentials_json
                //for example (app/analytics/service-account-credentials.json)
            7- create the pervious folder and put the file inside
            8- Granting permissions to your Analytics property
                1- I'm assuming that you've already created a Analytics account on the Analytics site. 
                2- in admin,add new property, click on "Advanced options" and make sure you enable Universal Analytics.
                3- Go to "User management" in the Admin-section of the property.
                4- On this screen you can grant access to the email address found in the client_email key from the json file you download in the previous step. 
                5- choose Analyst role.
                6- Go to "View setting" in the Admin-section of the property and get the view id.
                7- put the view id in env file (ANALYTICS_VIEW_ID=263607444)


usage:

//retrieve visitors and pageview data for the current day and the last seven days
$analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(7));

//retrieve visitors and pageviews since the 6 months ago
$analyticsData = Analytics::fetchVisitorsAndPageViews(Period::months(6));

//retrieve sessions and pageviews with yearMonth dimension since 1 year ago
$analyticsData = Analytics::performQuery(
    Period::years(1),
    'ga:sessions',
    [
        'metrics' => 'ga:sessions, ga:pageviews',
        'dimensions' => 'ga:yearMonth'
    ]
);



------------------------------------------------ API


///// ------------------------ other ------------------------ /////

------- rendom code -------

    protected function generateRandomString($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];}
        return "SM" . $randomString;
    }
    return  $this->generateRandomString(6); // it should be dynamic and unique 



------- adding funcations and classes --------

1- Create a file named helper.php in folder app/Helpers (first you have to create Helpers folder), put all your functions in that file.
2- "autoload": {
        ...
        "files": [
            "app/Helpers/helper.php"
        ]
    },

3 - For example :
    -helpers.php
        function showTest(){
            dd("ok");}

    -UserController.php
    public function index(Request $request) {
        showTest();
    }
4- then dp (composer dump-autoload)



----------------------
change the time zone in in app.php in confg
    'timezone' => 'Africa/Cairo	',

------- carbon --------

--1- get the age or the length of data
    (\Carbon\Carbon::parse($user->birth)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days');)


--2- for arabic date 
        Carbon::setLocale('ar');
        $appo_time_sms = Carbon::parse("2022-03-09 11:45:29")->translatedFormat('l j F Y H:i:s');
---------- create new conf file ----------
1- add a new file to the config folder which mighr be constants.php 
2- inside it 
    <?php
    return array(
        'pagination' => array(
            'items_per_page' => 10
        ),
    );
3- to access 
    config('constants.pagination.items_per_page');
4- We need to run php artisan config:cache after creating new config file otherwise it is not loaded
---------- Image compression ----------
1- install
    (composer require intervention/image)

2- Configure Package After install package successfully then must be configure it's service providers and aliaces in (config/app.php) file.

    'providers' => [
        ....
        Intervention\Image\ImageServiceProvider::class,
    ],
    'aliases' => [
        ....
        'Image' => Intervention\Image\Facades\Image::class,
    ],
3- the usage
    // create instance
    $img = Image::make('public/foo.jpg');

    // resize the image to a width of 300 and constrain aspect ratio (auto height)
    $img->resize(300, null, function ($constraint) {
        $constraint->aspectRatio();
    });

    //$img->save('public/bar.jpg', 60); or // save the same file as jpg with default quality
    $img->save('public/baz.jpg');

4- example:
        $xray_file = $request->file('x_ray_file');
        if($request->hasFile('x_ray_file')){
            //to remove the old avatar and also keep the default img
            $imagePath = public_path('img/lab/'.$lab->xray_file);
            if(File::exists($imagePath)){
                File::delete($imagePath);
            }
            $file_extension = $request->file('x_ray_file')->getClientOriginalExtension();
            $file_name = "LA" . time() . '.' . $file_extension;
            $path = public_path('img/lab/'. $file_name) ;
            Image::make($request->x_ray_file)
                ->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($path, 70);
            $lab->xray_file = $file_name; //new img file name to upload to database
            $lab->status = "1";}


---------- PDF genrator ----------
1- Download wkhtmltopdf
    https://wkhtmltopdf.org/downloads.html
-or 
    wkhtmltopdf binary as composer dependencies
    If you want to download wkhtmltopdf and wkhtmltoimage with composer you add to composer.json:

    $ composer require h4cc/wkhtmltopdf-i386 0.12.x
    $ composer require h4cc/wkhtmltoimage-i386 0.12.x
    or this if you are in 64 bit based system:

    $ composer require h4cc/wkhtmltopdf-amd64 0.12.x
    $ composer require h4cc/wkhtmltoimage-amd64 0.12.x

1- in composer.json, add snappy package:

   composer require barryvdh/laravel-snappy

    
2- Manual register: Open config/app.php file and this line in the providers array:

    Barryvdh\Snappy\ServiceProvider::class,

3- Configure Package After install package successfully then must be configure it's service providers and aliaces in (config/app.php) file.

    'providers' => [
        ....
        Barryvdh\Snappy\ServiceProvider::class,
    ],
    'aliases' => [
        ....
        'PDF' => Barryvdh\Snappy\Facades\SnappyPdf::class,
        'SnappyImage' => Barryvdh\Snappy\Facades\SnappyImage::class,
    ],
4- Then after publish vendor folder run by this command

    php artisan vendor:publish --provider="Barryvdh\Snappy\ServiceProvider"

5- Now open your config/snappy.php file and changes in it bith of 'binary' array key following way
    return array(
        'pdf' => array(
            'enabled' => true,
            'binary'  => '/usr/local/bin/wkhtmltopdf-amd64',
            'timeout' => false,
            'options' => array(),
            'env'     => array(),
        ),
        'image' => array(
            'enabled' => true,
            'binary'  => '/usr/local/bin/wkhtmltoimage-amd64',
            'timeout' => false,
            'options' => array(),
            'env'     => array(),
        ),
    );

6- to remove 
    composer remove barryvdh/laravel-snappy
------- pdf genteror 2 

1- install it
    (composer require barryvdh/laravel-dompdf)
2- Open config/app.php and insert the following

    'providers' => [
    Barryvdh\DomPDF\ServiceProvider::class,
    ],

    'aliases' => [
    'PDF' => Barryvdh\DomPDF\Facade::class,
    ]
3- Execute the following command to publish the assets from vendor.

    (php artisan vendor:publish)

    --A handful of packages list appeared on your terminal window,
    and we have to select the “Provider: Barryvdh\DomPDF\ServiceProvider” option from the list.
    It will create the new file config/dompdf.php, holding global configurations for the DomPDF plugin.
    
4- use it in contraller
    use Barryvdh\DomPDF\Facade as PDF;
        $data = Invoice::all();
        // share data to view
        view()->share('employee',$data);
        $pdf = PDF::loadView('test', $data);
        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');

        --- or 
            use PDF;
            $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate('string'));
            $pdf = PDF::loadView('test', compact('lab', 'qrcode'));
            // Output the generated PDF to Browser
            return $pdf->stream();

        --to use img in balde
            <img src="{{ public_path('img/dashboard/system/pc-loader.png') }}"
                                        style=" width: 100px;">
    

-------- pdf genartor 3  

1- install it
    (composer require carlos-meneses/laravel-mpdf)
2- To start using Laravel, add the Service Provider and the Facade to your config/app.php:

    'providers' => [
        // ...
        Meneses\LaravelMpdf\LaravelMpdfServiceProvider::class,
    ]
    'aliases' => [
        // ...
        'PDF' => Meneses\LaravelMpdf\Facades\LaravelMpdf::class,
    ]
3- to user
        $qrcode = base64_encode(QrCode::format('svg')->size(90)->errorCorrection('H')->generate('string'));
        $stylesheet = file_get_contents('css/kv-mpdf-bootstrap.css');
        $html = view('test', compact('lab', 'qrcode'))->render();
        $mpdf = new mPDF();
        $mpdf->WriteHTML($stylesheet, 1);
        $mpdf->WriteHTML($html);
        $mpdf->Output();

        //or ($mpdf->output($patient->username, 'd');) to download
        //to show the img error ($mpdf->showImageErrors = true;)
-- to delete (composer remove carlos-meneses/laravel-mpdf)

---------- QR genrator ----------

1- in composer:
    (composer require simplesoftwareio/simple-qrcode "~4")
2- to use in blade
    <div class="visible-print text-center">
        {!! QrCode::color(68, 95, 129)->size(90)->style('round')->eye('circle')->generate(Request::url()) !!}
        <p class="mt-2 mb-0 text-gray-300">Scan me now</p>
    </div>
3- or in contraller 
    $qrcode = base64_encode( QrCode::color(68, 95, 129)->size(80)->style('round')->eye('circle')->generate($lab->code));

----- other way to have qr
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
    
        $writer = new Writer(
            new ImageRenderer(
                new RendererStyle(200),
                new SvgImageBackEnd()
            )
        );
        return $writer->writeString('asd');


------ to have custom configrution 

--  add new file to config file
return array(
    'pagination' => array(
           'items_per_page' => 10
    ),
);

Config::get('constants.pagination.items_per_page');
config('constants.pagination.items_per_page');
i.e.
config('file_name.variable_name');

php artisan config:cache


------- Custom 403, 500, 419, 255 and 405 Page 
just put the error file in the path like that 
 resources/views/errors/404.blade.php
 
------------------------------------------------ other







------------------------------------------------ 
---------- to uploadt the laravel project to the server
1- zip our project and uploadt it to the serverand unizip it
2- put the public file in the main url server and put the other file inside a file
3- make the pointer to public file to be the main url
4- change .env to the new database setting and the new website url
5- add to index.php in public. the file name that contints the laravel project that we created
    | Register The Auto Loader
    require __DIR__.'/../proxima/vendor/autoload.php';
    | Run The Application
    $app = require_once __DIR__.'/../proxima/bootstrap/app.php';

6- in case showing the error in some intering the data. inter config/database.php in 'mysql' => [] and change 'strict' => true, to false
    'mysql' => [
        'strict' => false,
    ]

------ not that this method will cause some errors in public_path() espiclly in mpdf library 

--- other way is to upload the project by upload all the laravel project in the main url and make the pointer to the public folder.



----- access the Laravel app from another PC and share with anyone in the localhost

sudo php artisan serve --host YourLocalIp --port 80
//find it in network setting
------------------------------------------------







-------------------------- Vue js --------------------------

- vue is installed automaticlly in laravel
- download the vue from its website or use cdn, download (Vue.js devtools) and turn on (Allow access to file URLs) in extination in the broser to be working in localhost
- example one for selecting and insert

    <div id="welcome">
        Hello : {{ name }} - {{ showAge() }} //to show the data (binding) that stored in vue and methods
        <br>
        {{ daynamicName('Ahmmed') }} //method to insert parameter to func
        <br>
        {{ cars[1] }} //show array
        <br>
        {{ users[0].name + 'and his job is ' + users[0].job }} //show object of array
        <br>
        {{ isAdmin ? 'he is admin' : 'he is not admin' }} //if condation (data ? if : else)
        <br>
        <p v-bind:first_name="name" :class="status"> heey </p> //fetch data in attrubite
    </div>

    <script>
        var newapp = new Vue({
            el: "#welcome", //for selecting the div
            data: {
                name: 'ahmed',
                age: '21',
                cars: ['nesan', 'kia', 'bmw'],//array
                users: [
                    {
                        name: "Ali ibrahm",
                        job: "doctor"
                    },
                    {
                        name: "Lila ahmed",
                        job: "recipationist"
                    },
                ],//array of object
                isAdmin : true,//boolean data
                status: 'red', //to insert red class style to style div
            }, //to store data
            methods: { //to insert funcation
                showAge(){
                    return `${this.age}`; //to fetch data attr or other funcation, note to write (``) it's fined under esc
                },
                daynamicName(name){
                    return "my nickname is " + `${name}`; // to fetch the func parameter
                }
            },
        })
    </script>

----- fetch data (banding data) in html attrubite
        <p v-bind:name="name"></p>
        --or
        <p :name="name"></p>

----- two-way data bindings fetching data and passing data
-- using the v-model directive to create two-way data bindings on form input, textarea, and select elements.
It automatically picks the correct way to update the element based on the input type.

        <input type="checkbox" id="jack" value="Jack" v-model="checkedNames">
        <label for="jack">Jack</label>
        <input type="checkbox" id="mike" value="Mike" v-model="checkedNames">
        <label for="mike">Mike</label>
        <br>
        <span>Checked names: {{ checkedNames }}</span>

        new Vue({
            el: '...',
            data: {
                checkedNames: []
            }
        })

        --another example
        {{ username }}
        <input v-model="username" type="text">
        new Vue({
            el: '...',
            data: {
                username: 'ahmed2131',
            }
        })

---------- Listening to Events such as click, change, and checked;
We can use the (v-on) directive to listen to DOM events and run some JavaScript when they’re triggered.

    <div id="example-1">
    <button v-on:click="counter += 1">Add 1</button>
    <p>The button above has been clicked {{ counter }} times.</p>
    </div>

    var example1 = new Vue({
        el: '#example-1',
        data: {
            counter: 0
        }
    })
--- another example
    <div id="example-2">
    <!-- `greet` is the name of a method defined below -->
    <button v-on:click="greet">Greet</button> //or :click="" or @click=""
    </div>

    var example2 = new Vue({
        el: '#example-2',
        data: {
            name: 'Vue.js'
        },
        // define methods under the `methods` object
        methods: {
            greet: function (event) {
            // `this` inside methods points to the Vue instance
            alert('Hello ' + this.name + '!')
            // `event` is the native DOM event
            if (event) {
                alert(event.target.tagName)
            }
            }
        }
    })

--- v-on:input or @input()
is to use the input value to do something and it is used in input or text aread and it fires the event once the user write
        <input v-model="num1" type="text">
        <input v-model="num2" type="text">
        <input v-on:input="num3 = $event.target.value" type="text"> //to get the input value and change num3 attr
        <button @click="calculate()">Greet</button>
        {{ result }}

         var example1 = new Vue({

            calculate(){
                    return this.result =  parseInt(this.num1) + parseInt(this.num2)  + parseInt(this.num3);
                },
                
            )}

---------- form
<form v-on:submit="saveDate" method="GET" action=""> //to run the func on submit or we can use v-on:submit.prevent=""
            <input v-model="num1" type="text">
            <input v-model="num2" type="text">
            <button type="submit">Send</button>
</form>


saveDate(event){
    event.preventDefault(); //to stop sending the form
}


---------- vue with laravel
-- install
1- run npm install --save vue (or) npm install vue

 -or
    1- run composer require laravel/ui
    2- run php artisan ui vue //for just installing Vue.
    3- run php artisan ui vue --auth //for scaffolding out the auth views.
    4- run npm install && npm run dev 

2- in case we go with the first option of installing Add the following to your resources/js/app.js:
        require('./bootstrap');
        window.Vue = require('vue').default; //to call the vue
        Vue.component('example-component', require('./components/ExampleComponent.vue').default); //to get the compnent
        const app = new Vue({
            el: '#app',
        });

3- insert app id to wanted div to contrall to run vue in view
    <div id="app">
        <example-component /> //for cheaking 
    </div>
    <script src="{{ mix('/js/app.js') }}"></script> //to get all data from (resources/js/app.js) and move it to js/app.js to run vue

4-go to (webpack.mix.js) in the main route and insert it 

    mix.js('resources/js/app.js', 'public/js')
        .vue()
        .sass('resources/sass/app.scss', 'public/css');

5- (optional) Setup Vue router //which makes the move among the pages somthly and has many other features
//SPAs are great because they don't require page loads every time the route changes

        npm install vue-router

    5.2 put the following in (resources/js/app.js)
        import VueRouter from 'vue-router'
        import routes from '../routes/home'
        Vue.use(VueRouter)
        new Vue({    
            router,  //imprtant for route vue
        }).$mount('#app')

    5.3 create a routes folder and add a home.js in (resources/js/) 
            export default [
                {
                    path: '/home',
                    component: home,
                    name: 'home',
                },
            ]

    5.2 Displaying with router-view
        <router-link to='/profile'>Profile</router-link>


imprtant information
1- the default file for vue is locatied in (resources/js/app.js) and it calls another compontns in resources/js/components/ExampleComponent.vue
that we call with <example-component />

2- anything you do in vue is not saving unless you use (npm run dev) or (npm run watch) but the last one is the best to update the vue code
//because The Vue code that you write must be transpiled to vanilla javascript so that most of the browsers out there can understand it
//the plugin that do this transpiled to make the broswer understand vue is MIX which is located in the main route (webpack.mix.js)

3- using vue in the projects is divided into componants and you create it in (resources/js/app.js). and every compnants is html code



---- to create new vue and have the componants

    const app = new Vue({
        el: '#app',
        components: {Withdoctor},
    });

---- to call vue file to the mian app.js 
    (Vue.component('example-component', require('./components/ExampleComponent.vue').default);) // it does not need to be in the new vue fule func compnents
or
    (import Examplecomponent from './components/ExampleComponent.vue')

---- to get the componant in view
    (<withdoctor></withdoctor>)

---- inside the compnent we use html with (<template></template>) and (<script></script>)
//Vue.js uses an HTML-based template syntax that allows you to declaratively bind the rendered DOM to the underlying Vue instance’s data. All Vue.js templates are valid HTML 
        <template>
        <div class="container"></div>
        </template>
        <script>
        export default {
        methods() {
            console.log("test");
        },
        };
        </script>
---- run vue in view 

    <div id="app">
        <withdoctor></withdoctor> //get the comonant
    </div>
    <script src="{{ mix('/js/app.js') }}"></script> //to get all data from (resources/js/app.js) and move it to js/app.js to run vue


--------------------------

---------- to deal with contraller and database we use axios, There are several ways to do so, but a very popular approach is to use axios, a promise-based HTTP client

---- for insert data with SPA single page app (with compnant)
        <input type="text" v-model="post.name" name="category_name" />
        <input type="text" v-model="post.price" name="category_name" />
        <button class="btn btn-primary" v-on:click="createPost">Sent</button>
        <p>{{ status }}</p>
          
        export default {
        name: "AddCategory", //the form name
        data() {
            return {
            post: { name: "", price: "" },
            status: "",
            };
        },
        methods: {
            createPost() {
            axios
                .post("prox/ad/medicinecat", this.post)
                .then((response) => {
                if (response.status == 200) {
                    this.status = "sending successfully";
                }
                })
                .catch((error) => this.errors.record(error.response.data));
            },
        },
        };

----








--------------------------------------------------------
frequently using 
-----
1- date between 2 dates
    1- $date_serc = explode('to', $request->input('day_srch'));
            $date_1_serc = $date_serc[0];

            if (isset($date_serc[1])) {
                $date_2_serc = $date_serc[1];
            } else {
                $date_2_serc = $date_serc[0];
            }
            $appointment = $appointment->whereBetween('start_at', [
                Carbon::createFromFormat('Y-m-d', $date_1_serc)->startOfDay(), //2022-10-01 00:00:00.0
                Carbon::createFromFormat('Y-m-d', $date_2_serc)->endOfDay() // 2022-10-31 23:59:59.999999
            ]);
    2- ->whereDate('from','<=', $today)
            ->whereDate('to','>=', $today)

2- create date fromat 
    1- Carbon::createFromFormat('Y-m-d', $date_2_serc)
    2- date('Y-m-d')
    3- Carbon::today()
    4- date('h:i a d M ', strtotime($appointment->updated_at));


4- get everyday of 2 dates

        $startDate = Carbon::parse($from)->startOfDay();
        $endDate = Carbon::parse($to)->startOfDay();

        $different = $startDate->diffInDays($endDate);

        $period = CarbonPeriod::create($startDate, $endDate);
        $period->toArray();

        
*/