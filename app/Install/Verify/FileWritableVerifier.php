<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Install\Verify;

class FileWritableVerifier extends AbstractVerifier
{
    public function __construct($path)
    {
        $this->path = $path;
    }

    public function getName()
    {
        return "File path: '".$this->path."'";
    }

    /**
     * Verifies if a file or directory is writable.
     *
     * @return bool TRUE when writable, FALSE otherwise
     */
    public function verify()
    {
        return \File::isWritable($this->path);
    }
}
