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

class PhpVersionVerifier extends AbstractVerifier
{
    private $majorVersion;
    private $minorVersion;

    public function __construct($majorVersion, $minorVersion)
    {
        $this->majorVersion = $majorVersion;
        $this->minorVersion = $minorVersion;
    }

    public function getName()
    {
        return 'PHP Versie >= '.$this->majorVersion.'.'.$this->minorVersion.' ('.PHP_MAJOR_VERSION.'.'.PHP_MINOR_VERSION.')';
    }

    /**
     * Verify is the current PHP version is equal or higher than the given major and minor version.
     *
     * @return bool TRUE when major and minor versions are equal or higher than the given is met, FALSE otherwise
     */
    public function verify()
    {
        return version_compare(PHP_VERSION, $this->majorVersion.'.'.$this->minorVersion, '>=');
    }

    /**
     * Returns a view explaing how to make this verifier verify as OK.
     *
     * @return View
     */
    public function getHelpView()
    {
        return View::make('install.verify.phpversion')
            ->withMajor($this->majorVersion)
            ->withMinor($this->minorVersion)
            ->withActualVersion(PHP_VERSION);
    }
}
