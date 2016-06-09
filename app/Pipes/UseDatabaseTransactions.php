<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Pipes;

use Closure;
use Illuminate\Support\Facades\DB;

class UseDatabaseTransactions
{
    /**
     * Handle the current command in the pipeline.
     *
     * @param mixed    $command
     * @param \Closure $next
     *
     * @return bool
     */
    public function handle($command, Closure $next)
    {
        return DB::transaction(function () use ($command, $next) {
            return $next($command);
        });
    }
}
