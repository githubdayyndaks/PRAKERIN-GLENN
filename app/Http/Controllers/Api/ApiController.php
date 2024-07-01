<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiController extends Controller
{
    //register
    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => "1"
        ]);

        return response()->json([
            "status" => true,
            "message" => "User berhasil ditambah"
        ]);

    }

    //login api
    public function login(Request $request){
        //data validasi
        $request->validate([
            "email"=> "required",
            "password"=> "required"
        ]);

        //jwtauth attempt
        $token = JWTAuth::attempt([
            "email"=> $request->email,
            "password"=> $request->password
        ]);

        if(!empty($token)){
        //respon
        return response()->json([
            "status" => true,
            "message" => "User berhasil login",
            "token" =>$token
        ]);
        }
        return response()->json([
            "status" => false,
            "message" => "invalid login",
        ]);
    }

    //profile api
    public function profile(){
        $userData = auth()->user();
        return response()->json([
            "status" => true,
            "message" =>"Profile Data",
            "user" => $userData
        ]);
    }

    //refresh token
    public function refreshtoken(){
        $newToken = auth()->refresh();
        return response()->json([
            "status" => true,
            "message" =>"Token berhasil diubah",
            "token" => $newToken
        ]
        );

    }

    public function logout(){
        auth()->logout();

        return response()->json([
            "status" => true,
            "message" => "Berhasil logout"
        ]);

    }
}
