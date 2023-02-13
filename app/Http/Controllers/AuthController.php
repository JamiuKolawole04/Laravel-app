<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use \App\Http\Requests\StoreUserRequest;
use \App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    use HttpResponses;

    public function login(LoginUserRequest $request) 
    {
        // $request-> validated($request->only('email', 'password'));

        // checking validation for only email and password
        // if (!Auth::attempt($request->only("email", "password"))) {
        //     return $this->error("", "credentials do not match", 401);
        // }

        $request-> validated($request->all());
        if (!Auth::attempt($request->only(["email", "password"]))) {
            return $this->error("", "credentials do not match", 401);
        }

        
        return "this is my login  route";
    }

    public function register(StoreUserRequest $request) 
    {
        $request->validated($request->all());

        $user = User::create([
            "name" =>  $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);
        // return response()->json("this is my register route");
        return $this->success([
            "user" => $user,
            "token" => $user->createToken("API token of " . $user->name)->plainTextToken
        ]);
    }

     public function logout() 
    {
        return response()->json("this is my logout route");
    }}