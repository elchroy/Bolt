<?php

namespace Bolt\Http\Controllers\Auth;

use Auth;
use Bolt\Http\Controllers\Controller;
use Bolt\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Socialite;
use Validator;

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
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users',
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
            $user->email = $user->id.time().'@twitter.com';
        }

        return $this->continueHandling($user, $link, $request);
    }

    private function continueHandling($user, $link, Request $request)
    {
        $authUser = $this->findOrCreateSocialUser($user, $link);

        if ($authUser) {
            Auth::login($authUser, true);

            return redirect('dashboard');
        }

        $request->session()->flash('error', "There is a problem with this account on the $link network. Ensure that your name and email are public.");

        return redirect()->back();
    }

    /**
     * Return user if exists; create and return if it doesn't.
     *
     * @param $socialUser
     *
     * @return User
     */
    private function findOrCreateSocialUser($socialUser, $socialLink)
    {
        if ($authUser = User::where('social_id', $socialUser->id)->first()) {
            return $authUser;
        }

        $data = [
            'name'        => $socialUser->name,
            'email'       => $socialUser->email,
            'social_id'   => $socialUser->id,
            'social_link' => $socialLink,
            'password'    => bcrypt('mybolt'),
            'avatar'      => $socialUser->avatar,
        ];

        $validator = $this->validateSocialUser($data);

        if ($validator->fails()) {
            return false;
        }

        return User::create($data);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateSocialUser(array $data)
    {
        return Validator::make($data, [
            'name'      => 'required|max:255',
            'email'     => 'required|unique:users',
            'social_id' => 'required|unique:users',
            'avatar'    => 'required|unique:users',
        ]);
    }
}
