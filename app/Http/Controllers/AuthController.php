<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'no_induk' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::create([
            'no_induk' => $fields['no_induk'],
            'password' => Hash::make($fields['password'])
        ]);
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login (Request $request){
        $fields = $request->validate([
            'no_induk' => 'required|string',
            'password' => 'required|string'
        ]);

        $login = User::where(
            'no_induk', '1111'
        )->get()->first();

        // return $login->password .  '|\\|' . bcrypt($fields['password']);
        return Hash::check($fields['password'],$login->password) ? '1' : '0';

        if ($login) {
            if (bcrypt($fields['password']) == $login->password) {
                $token = $login->createToken('myapptoken')->plainTextToken;
                return response(
                    [
                        'user' => $login,
                        'token' => $token
                    ]
                    );
            } else {
                return response('user password salah', 401);
            }

        } else {
            return response('user tidak ada'.$login, 401);
        }
    }

    public function logout(Request $request){

    }
}
