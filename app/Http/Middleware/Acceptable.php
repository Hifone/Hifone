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

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;

class Acceptable
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string                   $type
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $type = null)
    {
        if (!$request->accepts($type ?: 'accept:application/json')) {
            throw new NotAcceptableHttpException();
        }

        return $next($request);
    }
}
