<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Hashing;

use Illuminate\Contracts\Hashing\Hasher as HasherContract;

/**
 * customized hasher dedicated for securing user's password.
 */
class PasswordHasher implements HasherContract
{
    /**
     * @see \Illuminate\Contracts\Hashing\Hasher::make()
     *
     * @param $options    avialable options are:
     *                    - salt     salt that adds randomness to the hashing result
     */
    public function make($value, array $options = [])
    {
        // possibly we get salt from options
        $salt = array_get($options, 'salt', '');

        return md5(md5($value).$salt);
    }

    /**
     * (non-PHPdoc).
     *
     * @see \Illuminate\Contracts\Hashing\Hasher::check()
     *
     * @param $options    avialable options are:
     *                    - salt     salt that goes along with the hashed value
     */
    public function check($value, $hashedValue, array $options = [])
    {
        return $hashedValue == $this->make($value, ['salt' => array_get($options, 'salt', '')]);
    }

    /**
     * (non-PHPdoc).
     *
     * @see \Illuminate\Contracts\Hashing\Hasher::needsRehash()
     */
    public function needsRehash($hashedValue, array $options = [])
    {
        // currently we don't take rehash into consideration
        return false;
    }
}
