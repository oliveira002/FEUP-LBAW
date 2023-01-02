<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Auth;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:30|unique:user',
            'email' => 'required|string|email|max:50|unique:user|unique:systemmanager',
            'firstname' => 'required|string|max:30|alpha_dash',
            'lastname' => 'required|string|max:30|alpha_dash',
            'password' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'
            ]
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $lastId = User::selectRaw('idclient')->orderBy('idclient','desc')->first()->idclient;

        return User::create([
            'idclient' => $lastId+1,
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'email' => $data['email'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'balance' => '0',
            'isbanned' => 'False',
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  Request  $request
     * @return \App\Models\User
     */
    protected function createAdm(Request  $request)
    {
        if(!Auth::guard('admin')->check()){
            abort(403);
        }

        $lastId = User::selectRaw('idclient')->orderBy('idclient','desc')->first()->idclient;

        $user = User::create([
            'idclient' => $lastId+1,
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'email' => $request->input('email'),
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'balance' => '0',
            'isbanned' => 'False',
        ]);
        if(Auth::guard('admin')->check()){
            SystemManagerLog::create([
                'idsysman' => Auth::guard('admin')->id(),
                'logdescription' => 'Created User id: ' . $user->idclient,
                'logdate' => date('Y-m-d H:i:s'),
                'logtype' => 'Create User',
            ]);
        }
        return redirect()->route('profile',['username' => $request->input('username')]);
    }
}
