<?php
/*

----------------------------------------------

//test area
Route::get('/test', [PostCont::class, 'test']);


Route::get('test1', function () {
    return view('test1');
});

Route::get('/test11/{userid}/{postid}', [PostCont::class, 'test1'])->Name('test11');


----------------------------------------------

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\infoRquest;
use App\Models\Post;
use App\Models\User;
use App\Models\Usertest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PostCont extends Controller
{
    public function show()
    {
        $user = Usertest::with(['posts' => function ($q) {
            $q->select('title', 'user_id');
        }])->where('name', 'hesham')->get();


        $usertest = Usertest::find(2)->posts;


        $post = Post::find(2);

        $posttest = $post->user;

        $test = DB::table('users')->get();

        return response()->json($user);

        //return view('showtable', compact('user'));
    }

    public function send(infoRquest $request)
    {

        Post::create([
            'title' => $request->input('title'),
            'excerpt' => $request->input('excerpt'),
            'user' => $request->input('user'),
        ]);

        return redirect()->back()->with(['success' => 'the info has already sent']);
    }

    public function update()
    {
    }


    public function showuser()
    {
        $users = Usertest::select('id', 'name', 'email')->get();

        return view('userposts', compact('users'));
    }


    public function loginData(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            //$request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    public function userposts($userid)
    {
        $users = Usertest::find($userid);
        $posts = $users->posts;

        return view('posts', compact('posts'));
    }


    public function deletepost($userid)
    {
        $users = Usertest::find($userid);
        $users->posts()->delete();
        $users->delete();
        //return $users;
        return 'the info has been deleted';
    }



    public function test()
    {
        $users = Usertest::where('group_id', '2')->get();
        //$posts = $users->posts;

        return $users;
    }


    public function registerstore(Request $request)
    {
        $attr = request()->validate([
            'name' => ['required', 'min:2'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $password_hash =  bcrypt($request->input('password'));
        Usertest::create([
            'name' => $attr['name'],
            'email' => $request->input('email'),
            'password' => $password_hash,
            'group_id' => '1',

        ]);
    }

    //test area 
    public function test1($userid, $postid)
    {

        $pass = $userid . $postid;


        return $pass;
    }
}



----------------------------------------------

            @if (isset($user) && $user -> count() > 0 )
                
                @foreach ($user as $item)
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



----------------------------------------------
in middleware

        $grouptype = Auth::user()->group_id;

        if ($grouptype == 1) {
            return $next($request);
        }
        return redirect('login');

----------------------------------------------
in gurad 


    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'usersa',
        ],
    ],

    'providers' => [
        'usersa' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
    ],
    
----------------------------------------------

in view 





----------------------------------------------
ajax send data 


  $(document).on('click', '#submetpost', function(e){
    e.preventDefault();
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




----------------------------------------------
ajax delete data 

<script>
$(document).on('click', '#deleteajax', function(e){
  e.preventDefault();
  var postid = $(this).attr('data-postid');
  $.ajax({
      type: "post",
      enctype: 'multipart/form-data',
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
      },
      error: function()
      {
      }
});
}) 
</script>

//in conterller

    public function delete(Request $request)
    {
        $post = Post::find($request->postid);
        $post->delete();

        if ($post)
            return response()->json([
                'poststatue' => true,
                'msg' => 'info has been deleted',
                'idpost' => $request->postid,
            ]);
        else
            return response()->json([
                'poststatue' => false,
                'msg' => 'sorry, we could not save the data'
            ]);
    }

----------------------------------------------
authtication resgster and login with diffreent table (admin for example)

    public function loginData(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function registerstore(Request $request)
    {
        request()->validate([
            'name' => ['required', 'min:2'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $password_hash =  bcrypt($request->input('password'));
        $user = Admin::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $password_hash,
        ]);
        Auth::guard('admin')->login($user);
    }

    //test area 
    public function test1()
    {
        return Auth::guard('admin')->user();
    }

===============
spatie 
        $users = User::select(['id','first_name', 'second_name', 'avatar', 'started_work', 'deactivate', 'branch_id'])->with(['branch' => function ($q) {
            $q->select('id', 'name');
        }, 'roles' => function ($q) {
            $q->select('id', 'name');
        },])->get();

        =$permissions = $user->getDirectPermissions();
                                        @foreach ($iteam->roles as $roles)
                                            <span class="badge rounded-pill pend-color-btn badge-padd-l">
                                                {{ $roles->name }}
                                            </span>
                                        @endforeach
*/