<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use \App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    use HttpResponses;

    public function login() 
    {
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