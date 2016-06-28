<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Http\Controllers\Auth;

use AltThree\Validator\ValidationException;
use Hifone\Commands\Identity\AddIdentityCommand;
use Hifone\Events\User\UserWasAddedEvent;
use Hifone\Events\User\UserWasLoggedinEvent;
use Hifone\Hashing\PasswordHasher;
use Hifone\Http\Controllers\Controller;
use Hifone\Models\Identity;
use Hifone\Models\Provider;
use Hifone\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Input;
use Laravel\Socialite\Two\InvalidStateException;

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
    //注册后返回主页
    protected $redirectPath = '/';

    protected $hasher;

    public function __construct(PasswordHasher $hasher)
    {
        $this->hasher = $hasher;
        $this->middleware('guest', ['except' => ['logout', 'getLogout']]);
    }

    public function getLogin()
    {
        $providers = Provider::orderBy('created_at', 'desc')->get();

        return $this->view('auth.login')
            ->withCaptcha(route('captcha', ['random' => time()]))
            ->withConnectData(Session::get('connect_data'))
            ->withProviders($providers)
            ->withPageTitle(trans('dashboard.login.login'));
    }

    public function landing()
    {
        return $this->view('auth.landing')
            ->withConnectData(Session::get('connect_data'))
            ->withPageTitle('');
    }

    /**
     * Logs the user in.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin()
    {
        $loginData = Input::only(['login', 'password', 'verifycode']);
        if (!Config::get('setting.site_captcha_login_disabled')) {
            $verifycode = array_pull($loginData, 'verifycode');
            if ($verifycode != Session::get('phrase')) {
                // instructions if user phrase is good
                return Redirect::to('auth/login')
                ->withInput(Input::except('password'))
                ->withError(trans('hifone.captcha.failure'));
            }
        }
        // Login with username or email.
        $loginKey = Str::contains($loginData['login'], '@') ? 'email' : 'username';
        $loginData[$loginKey] = array_pull($loginData, 'login');
        // Validate login credentials.
        if (Auth::validate($loginData)) {

            // We probably want to add support for "Remember me" here.
            Auth::attempt($loginData, false);

            if (Session::has('connect_data')) {
                $connect_data = Session::get('connect_data');
                dispatch(new AddIdentityCommand(Auth::user()->id, $connect_data));
            }

            event(new UserWasLoggedinEvent(Auth::user()));

            return Redirect::intended('/')
                ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.login.success')));
        }

        return redirect('/auth/login')
            ->withInput(Input::except('password'))
            ->withError(trans('hifone.login.invalid'));
    }

    public function getRegister()
    {
        $connect_data = Session::get('connect_data');

        return $this->view('auth.register')
            ->withCaptcha(route('captcha', ['random' => time()]))
            ->withConnectData($connect_data)
            ->withPageTitle(trans('dashboard.login.login'));
    }

    public function postRegister()
    {
        // Auto register
        $connect_data = Session::get('connect_data');
        $from = '';
        if ($connect_data && isset($connect_data['extern_uid'])) {
            $registerData = [
                'username' => $connect_data['nickname'].'_'.$connect_data['provider_id'],
                'nickname' => $connect_data['nickname'],
                'password' => $this->hashPassword(str_random(8), ''),
                'email'    => $connect_data['extern_uid'].'@'.$connect_data['provider_id'],
                'salt'     => '',
            ];
            $from = 'provider';
        } else {
            $registerData = Input::only(['username', 'email', 'password', 'password_confirmation', 'verifycode']);

            if ($registerData['verifycode'] != Session::get('phrase') && Config::get('setting.site_captcha_reg_disabled')) {
                return Redirect::to('auth/register')
                    ->withTitle(sprintf('%s %s', trans('hifone.whoops'), trans('dashboard.users.add.failure')))
                    ->withInput(Input::all())
                    ->withErrors([trans('hifone.captcha.failure')]);
            }
        }
        try {
            $user = $this->create($registerData);
        } catch (ValidationException $e) {
            return Redirect::to('auth/register')
                ->withTitle(sprintf('%s %s', trans('hifone.whoops'), trans('dashboard.users.add.failure')))
                ->withInput(Input::all())
                ->withErrors($e->getMessageBag());
        }

        if ($from == 'provider') {
            dispatch(new AddIdentityCommand($user->id, $connect_data));
        }

        event(new UserWasAddedEvent($user));

        Auth::guard($this->getGuard())->login($user);

        return redirect($this->redirectPath());
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
        $salt = $this->generateSalt();

        $password = $this->hashPassword($data['password'], $salt);

        $user = User::create([
            'username'     => $data['username'],
            'email'        => $data['email'],
            'salt'         => $salt,
            'password'     => $password,
        ]);

        return $user;
    }

    /**
     * hash user's raw password.
     *
     * @param string $password plain text form of user's password
     * @param string $salt     salt
     *
     * @return string hashed password
     */
    private function hashPassword($password, $salt)
    {
        return $this->hasher->make($password, ['salt' => $salt]);
    }

    /**
     * generate salt for hashing password.
     *
     * @return string
     */
    private function generateSalt()
    {
        return str_random(16);
    }

    public function provider($slug)
    {
        return \Socialite::with($slug)->redirect();
    }

    public function callback($slug)
    {
        if (Input::has('code')) {
            $provider = Provider::where('slug', '=', $slug)->firstOrFail();
            try {
                $extern_user = \Socialite::with($slug)->user();
            } catch (InvalidStateException $e) {
                return Redirect::to('/auth/landing')
                    ->withErrors(['授权失效']);
            }

            //检查是否已经连接过
            $identity = Identity::where('provider_id', '=', $provider->id)->where('extern_uid', '=', $extern_user->id)->first();

            if (is_null($identity)) {
                Session::put('connect_data', ['provider_id' => $provider->id, 'extern_uid' => $extern_user->id, 'nickname' => $extern_user->nickname]);

                return Redirect::to('/auth/landing');
            }
            //已经连接过，找出user_id, 直接登录
            $user = User::find($identity->user_id);

            if (!Auth::check()) {
                Auth::login($user, true);
            }

            return Redirect::to('/')
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.login.success')));
        }
    }

    public function userBanned()
    {
        if (Auth::check() && !Auth::user()->is_banned) {
            return redirect(route('home'));
        }
        //force logout
        Auth::logout();

        return Redirect::to('/');
    }

    // 用户屏蔽
    public function userIsBanned($user)
    {
        return Redirect::route('user-banned');
    }
}
