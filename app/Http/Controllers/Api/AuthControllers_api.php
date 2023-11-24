<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Branch\Appointment as BranchAppointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthControllers_api extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {    
        // Validate the form data
        $this->validate($request, [
            'phone_number'   => 'required|numeric',
            'password' => 'required',
            //'device_name' => 'required', for mobile app //need to be placed in token name
        ]);

        $user = User::where('phone_number', $request->input('phone_number'))->first();

        // Check password
        if(!$user || !Hash::check($request->input('password'), $user->password)) {
            return response([
                'message' => 'The phone number or passowrd is not correct'
            ], 401);
        }

        $roles = $user->getRoleNames()->toArray();

        $token = $user->createToken('mymobile_token', $roles)->plainTextToken;

        $response = [
            'status' => 200,
            'message' => 'You have logged in',
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
        
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}