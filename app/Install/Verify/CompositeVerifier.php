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

class CompositeVerifier extends AbstractVerifier
{
    public function __construct($name, array $verifiers)
    {
        $this->name = $name;
        $this->verifiers = $verifiers;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * Verifies one or more verifiers.
     *
     * @return bool TRUE when verifiers return TRUE, FALSE otherwise
     */
    public function verify()
    {
        foreach ($this->verifiers as $verifier) {
            if (!$verifier->verify()) {
                return false;
            }
        }

        return true;
    }

    public function getVerifiers()
    {
        return $this->verifiers;
    }
}
