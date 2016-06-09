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

use Illuminate\Support\Facades\View;

class PhpExtensionVerifier extends AbstractVerifier
{
    public function __construct($extension)
    {
        $this->extension = $extension;
    }

    public function getName()
    {
        return "PHP Extension: '".$this->extension."'";
    }

    /**
     * Verifies is a certain PHP extension is loaded.
     *
     * @return bool TRUE when the extension is loaded, FALSE otherwise
     */
    public function verify()
    {
        return extension_loaded($this->extension);
    }

    /**
     * Returns a view explaing how to make this verifier verify as OK.
     *
     * @return View
     */
    public function getHelpView()
    {
        return View::make('install.verify.phpextension')
            ->withEextension($this->extension);
    }
}
