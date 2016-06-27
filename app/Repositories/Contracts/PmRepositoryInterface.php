<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Repositories\Contracts;

interface PmRepositoryInterface extends RepositoryInterface
{
    public function inbox($userId);

    public function outbox($userId);

    public function submit($userId, $authorId, $body, $rootId);
}
