<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Presenters\Traits;

use Hifone\Services\Dates\DateFactory;

trait TimestampsTrait
{
    /**
     * Present formatted date time.
     *
     * @return string
     */
    public function created_at()
    {
        return app(DateFactory::class)->make($this->wrappedObject->created_at)->toDateTimeString();
    }

    /**
     * Present formatted date time.
     *
     * @return string
     */
    public function updated_at()
    {
        return app(DateFactory::class)->make($this->wrappedObject->updated_at)->toDateTimeString();
    }

    /**
     * Present formatted date time.
     *
     * @return string
     */
    public function deleted_at()
    {
        return app(DateFactory::class)->make($this->wrappedObject->deleted_at)->toDateTimeString();
    }
}
