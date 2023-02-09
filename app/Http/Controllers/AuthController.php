<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\HttpResponses;

class AuthController extends Controller
{
    //
    use HttpResponses;

    public function login() 
    {
        return "this is my login  route";
    }

    public function register() 
    {
        return response()->json("this is my register route");
    }

     public function logout() 
    {
        return response()->json("this is my logout route");
    }}