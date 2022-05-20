<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use illuminate\Support\Fascades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'no_induk' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::create([
            'no_induk' => $fields['no_induk'],
            'password' => bcrypt($fields['password'])
        ]);
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login (Request $request){

    }

    public function logout(Request $request){

    }
}
