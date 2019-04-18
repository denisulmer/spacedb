<?php

namespace SpaceDB\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Contracts\Factory as Socialite;
use SpaceDB\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use SpaceDB\User;

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

    /**
     * Redirect the user to the Google authentication page.
     *
     * @param Socialite $socialite
     * @return Response
     */
    public function redirectToGoogle(Socialite $socialite)
    {
        return $socialite->driver('google')->redirect();
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @param Socialite $socialite
     * @return Response
     */
    public function redirectToGithub(Socialite $socialite)
    {
        return $socialite->driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @param Socialite $socialite
     * @param RegisterController $registerController
     * @return Response
     */
    public function handleGithubCallback(Socialite $socialite, RegisterController $registerController)
    {
        $googleUser = $socialite->driver('google')->user();
        $user = User::whereEmail($googleUser->getEmail())->first();
        if (is_null($user)) {
            $user = $registerController->createFromGoogleUser($googleUser);
        }
        Auth::login($user);
        return redirect()->to($this->redirectTo);
    }
}
