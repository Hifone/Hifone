<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Config\Repository;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;

class Localize
{
    /**
     * Array of languages Hifone can use.
     *
     * @var array
     */
    protected $langs;

    /**
     * The config repository instance.
     *
     * @var \Illuminate\Config\Repository
     */
    protected $config;

    /**
     * Constructs a new localize middleware instance.
     *
     * @param \Illuminate\Config\Repository $config
     *
     * @return void
     */
    public function __construct(Repository $config)
    {
        $this->config = $config;
        $this->langs = $config->get('langs');
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $userLanguage = Auth::check() && Auth::user()->locale ? Auth::user()->locale : null;

        if (!$userLanguage) {
            $supportedLanguages = $request->getLanguages();
            $userLanguage = $this->config->get('app.locale');

            foreach ($supportedLanguages as $language) {
                $language = str_replace('_', '-', $language);

                if (isset($this->langs[$language])) {
                    $userLanguage = $language;
                    break;
                }
            }
        }

        app('translator')->setLocale($userLanguage);
        Date::setLocale($userLanguage);

        return $next($request);
    }
}
