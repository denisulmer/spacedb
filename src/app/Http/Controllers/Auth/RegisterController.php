<?php

namespace SpaceDB\Http\Controllers\Auth;

use Illuminate\Support\Facades\Log;
use SpaceDB\Camera;
use SpaceDB\Mount;
use SpaceDB\Optics;
use SpaceDB\User;
use SpaceDB\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
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
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
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
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        if (env('APP_ENV') != 'production') {
            Log::debug('Seeding random equipment to new user');
            $user->mounts()->attach(Mount::inRandomOrder()->first());
            $user->optics()->attach(Optics::inRandomOrder()->first());
            $user->cameras()->attach(Camera::inRandomOrder()->first());
        }
        return $user;
    }

    public function createFromGoogleUser($user)
    {
        return $this->create([
            'name' => $user->name,
            'email' => $user->email,
            'password' => bcrypt(str_random())
        ]);
    }
}
