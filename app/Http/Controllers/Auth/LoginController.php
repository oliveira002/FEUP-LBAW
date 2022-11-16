<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SystemManager;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function getUser(){
        return $request->user();
    }

    public function home() {
        return redirect('login');
    }
    public function authenticate(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            echo "success";
            //return redirect()->intended(route('home'));
        }

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            echo "success admin";
            //return redirect()->intended(route('admin.dashboard'));
        }
        echo "failed";
        exit();
    }
}
