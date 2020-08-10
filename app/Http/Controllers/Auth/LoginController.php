<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username() {
        return "name";
    }

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

    protected function authenticated(Request $request, $user)
    {
        // $user = Auth::user();

        // if ($user->role == 'admin') {
        //     $request->request->add([
        //         'scope' => 'role-admin',
        //     ]);
        // } else if ($user->role == 'manager'){
        //     $request->request->add([
        //         'scope' => 'role-manager'
        //     ]);
        // }
        // else {
        //     $request->request->add([
        //         'scope' => 'role-worker'
        //     ]);
        // }

        // $tokenRequest = Request::create(
        //     '/oauth/token',
        //     'post'
        // );
        // return Route::dispatch($tokenRequest);
    }

}
