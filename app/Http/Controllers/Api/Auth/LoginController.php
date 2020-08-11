<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use Auth;

class LoginController extends Controller
{
    //
    public function login(Request $request) {


        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'exists:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 404);
        }

        $data = [
            'name' => $request->name,
            'password' => $request->password,
        ];

        if(Auth::attempt($data)){

            $user = $request->user();
            Auth::login($user);
            $token_name = now()."-".Auth::user()->email;
            $token_scope = ["role-".Auth::user()->role];
            // return $token_scope;

            $token = $request->user()->createToken($token_name, $token_scope)->accessToken;

            return response(array(
                'user' => Auth::user(),
                'token' => $token,

            ), 200);
        }


        return response(array(
        'message' => 'password is invalid',
        ), 401);
    }



    public function logout(Request $request) {
        return response(array(
            'message' => "logout successfull!!",

        ), 200);
    }

    public function getUser() {

        // if(Auth::check()) {
        //     return response()->json([
        //         'user' => auth('api')->user(),
        //     ], 200);
        // }

        return response()->json([
            'user' => auth('api')->user(),
        ], 200);
    }
}
