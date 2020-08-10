<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function login(Request $request) {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);

        $data = [
            'name' => $request->name,
            'password' => $request->password,
        ];

        if(Auth::attempt($data)){

            $user = $request->user();

            $token_name = now()."-".Auth::user()->email;
            $token_scope = ["role-".Auth::user()->role];
            // return $token_scope;

            $token = $request->user()->createToken($token_name, $token_scope)->accessToken;

            return response(array(
                'users' => Auth::user(),
                'token' => $token,

            ), 200);
        }


        return response(array(
        'message' => 'Unauthorized, check your credentials.',
        ), 401);
    }
}
