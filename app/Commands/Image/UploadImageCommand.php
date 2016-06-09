<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Commands\Image;

final class UploadImageCommand
{
    public $file;

    public function __construct($file)
    {
        $this->file = $file;
    }
}
