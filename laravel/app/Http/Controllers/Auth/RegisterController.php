<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
            'user_id' => 'required|max:255',
            'password' => 'required|min:6|confirmed',
            'name' => 'required|max:255',
            'family' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'telegram_id' => 'max:255',
            'telephone' => 'max:255',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'user_id' => $data['user_id'],
            'password' => bcrypt($data['password']),
            'name' => $data['name'],
            'family' => $data['family'],
            'email' => $data['email'],
            'telegram_id' => $data['telegram_id'],
            'telephone' => $data['telephone'],
            'whatsapp_id' => NULL,
            'verified' => 0,
        ]);
    }
}
