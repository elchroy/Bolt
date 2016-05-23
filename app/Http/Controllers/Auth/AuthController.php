<?php

namespace Bolt\Http\Controllers\Auth;

use Auth;
use Bolt\User;
use Validator;
use Socialite;
use Illuminate\Http\Request;
use Bolt\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Redirect the user to the Social authentication page.
     *
     * @return Response
     */
    public function redirectToProvider(Request $request)
    {
        $link = $request->link;
        return Socialite::driver($link)->redirect();
    }

    /**
     * Obtain the user information from Socail Network.
     *
     * @return Response
     */
    public function handleProviderCallback(Request $request)
    {
        $link = $request->link;
        try {
            $user = Socialite::driver($link)->user();
        } catch (Exception $e) {
            return redirect("auth/$link");
        }

        if ($link === 'twitter') {
            $user->email = $user->id . time() . '@twitter.com';
        }

        return $this->continueHandling($user, $link);
    }

    private function continueHandling($user, $link)
    {

        $authUser = $this->findOrCreateSocialUser($user, $link);

        Auth::login($authUser, true);

        return redirect('dashboard');
    }

    /**
     * Return user if exists; create and return if it doesn't
     *
     * @param $socialUser
     * @return User
     */
    private function findOrCreateSocialUser($socialUser, $socialLink)
    {
        if ($authUser = User::where('social_id', $socialUser->id)->first()) {
            return $authUser;
        }

        return User::create([
            'name' => $socialUser->name,
            'email' => $socialUser->email,
            'social_id' => $socialUser->id,
            'social_link' => $socialLink,
            'password' => bcrypt('mybolt'),
            'avatar' => $socialUser->avatar
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
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
