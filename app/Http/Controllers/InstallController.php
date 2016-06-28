<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Http\Controllers;

use Hifone\Hashing\PasswordHasher;
use Hifone\Install\Verify\CompositeVerifier;
use Hifone\Install\Verify\FileWritableVerifier;
use Hifone\Install\Verify\PhpExtensionVerifier;
use Hifone\Install\Verify\PhpVersionVerifier;
use Hifone\Models\Node;
use Hifone\Models\Role;
use Hifone\Models\Section;
use Hifone\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class InstallController extends Controller
{
    /**
     * Array of cache drivers.
     *
     * @var string[]
     */
    protected $cacheDrivers = [
        'apc'       => 'APC(u)',
        'array'     => 'Array',
        'file'      => 'File',
        'database'  => 'Database',
        'memcached' => 'Memcached',
        'redis'     => 'Redis',
    ];
    /**
     * Array of step1 rules.
     *
     * @var string[]
     */
    protected $rulesStep1;
    /**
     * Array of step2 rules.
     *
     * @var string[]
     */
    protected $rulesStep2;
    /**
     * Array of step3 rules.
     *
     * @var string[]
     */
    protected $rulesStep3;

    protected $hasher;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PasswordHasher $hasher)
    {
        $this->hasher = $hasher;

        $this->rulesStep1 = [
            'env.cache_driver'   => 'required|in:'.implode(',', array_keys($this->cacheDrivers)),
            'env.session_driver' => 'required|in:'.implode(',', array_keys($this->cacheDrivers)),
        ];
        $this->rulesStep2 = [
            'settings.site_name'     => 'required',
            'settings.site_domain'   => 'required',
            'settings.show_support'  => 'bool',
        ];
        $this->rulesStep3 = [
            'user.username' => ['required', 'regex:/\A(?!.*[:;]-\))[ -~]+\z/'],
            'user.email'    => 'email|required',
            'user.password' => 'required',
        ];
    }

    /**
     * Returns the install page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $supportedLanguages = Request::getLanguages();
        $userLanguage = Config::get('app.locale');
        foreach ($supportedLanguages as $language) {
            $language = str_replace('_', '-', $language);
            if (isset($this->langs[$language])) {
                $userLanguage = $language;
                break;
            }
        }

        return $this->view('install.index')
            ->withCacheDrivers($this->cacheDrivers)
            ->withPageTitle(trans('install.title'))
            ->withEnvCheck($this->verify())
            ->withUserLanguage($userLanguage)
            ->withSiteUrl(Request::root());
    }

    /**
     * Handles validation on step zero of the install form.
     *
     * @return \Illuminate\Http\Response
     */
    public function postStep0()
    {
        return Response::json(['status' => 1]);
    }

    /**
     * Handles validation on step one of the install form.
     *
     * @return \Illuminate\Http\Response
     */
    public function postStep1()
    {
        $postData = Request::all();
        $v = Validator::make($postData, $this->rulesStep1);
        if ($v->passes()) {
            return Response::json(['status' => 1]);
        }

        return Response::json(['errors' => $v->getMessageBag()], 400);
    }

    /**
     * Handles validation on step two of the install form.
     *
     * @return \Illuminate\Http\Response
     */
    public function postStep2()
    {
        $postData = Request::all();
        $v = Validator::make($postData, $this->rulesStep1 + $this->rulesStep2);
        if ($v->passes()) {
            return Response::json(['status' => 1]);
        }

        return Response::json(['errors' => $v->getMessageBag()], 400);
    }

    /**
     * Handles the actual app install, including user, settings and env.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function postStep3()
    {
        $postData = Request::all();
        $v = Validator::make($postData, $this->rulesStep1 + $this->rulesStep2 + $this->rulesStep3);
        if ($v->passes()) {

            // Default node
            $section = Section::create([
                'name' => 'Hifone',
            ]);

            Node::create([
                'section_id'   => $section->id,
                'name'         => 'Default',
                'slug'         => 'default',
            ]);

            // Pull the user details out.
            $userDetails = array_pull($postData, 'user');
            // Create Roles
            $founder = new Role();
            $founder->name = 'Founder';
            $founder->display_name = trans('install.role_founder');
            $founder->save();
            $admin = new Role();
            $admin->name = 'Admin';
            $admin->display_name = trans('install.role_admin');
            $admin->save();

            $userDetails['salt'] = str_random(16);

            $user = User::create([
                'username'     => $userDetails['username'],
                'email'        => $userDetails['email'],
                'password'     => $this->hasher->make($userDetails['password'], ['salt' => $userDetails['salt']]),
                'salt'         => $userDetails['salt'],
            ]);
            // Attach Roles to user
            $user->roles()->attach($founder->id);

            Auth::login($user);
            $setting = app('setting');
            $settings = array_pull($postData, 'settings');

            // Other Default Settings
            $settings['captcha_login_disabled'] = '0';
            $settings['captcha_register_disabled'] = '0';

            foreach ($settings as $settingName => $settingValue) {
                $setting->set($settingName, $settingValue);
            }
            $envData = array_pull($postData, 'env');
            // Write the env to the .env file.
            foreach ($envData as $envKey => $envValue) {
                $this->writeEnv($envKey, $envValue);
            }
            Session::flash('install.done', true);
            if (Request::ajax()) {
                return Response::json(['status' => 1]);
            }

            return Redirect::to('dashboard');
        }
        if (Request::ajax()) {
            return Response::json(['errors' => $v->getMessageBag()], 400);
        }

        return Redirect::route('install')->withInput()->withErrors($v->getMessageBag());
    }

    protected function verify()
    {
        $verifiers = [
            new PhpVersionVerifier(5, 6),

            new PhpExtensionVerifier('mcrypt'),
            new PhpExtensionVerifier('mbstring'),
            new PhpExtensionVerifier('json'),

            new FileWritableVerifier(base_path('bootstrap/cache')),
            new FileWritableVerifier(storage_path('')),
            new FileWritableVerifier(public_path('uploads/avatar')),
            new FileWritableVerifier(public_path('uploads/images')),
       ];

        $rootVerifier = new CompositeVerifier('Requirements', $verifiers);

        View::share([
            'root_verifier' => $rootVerifier,
            'verifiers'     => $verifiers,
        ]);

        return View::make('install.verify');
    }

    /**
     * Writes to the .env file with given parameters.
     *
     * @param string $key
     * @param mixed  $value
     */
    protected function writeEnv($key, $value)
    {
        static $path = null;
        if ($path === null || ($path !== null && file_exists($path))) {
            $path = base_path('.env');
            file_put_contents($path, str_replace(
                env(strtoupper($key)), $value, file_get_contents($path)
            ));
        }
    }
}
