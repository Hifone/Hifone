<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Handlers\Commands\Reply;

use Hifone\Commands\Reply\UpdateReplyCommand;
use Hifone\Models\Reply;

class UpdateReplyCommandHandler
{
    public function handle(UpdateReplyCommand $command)
    {
        $reply = $command->reply;

        $reply->update($this->filter($command->updateData));

        return $reply;
    }

    /**
     * Filter the data.
     *
     * @param array $data
     *
     * @return array
     */
    protected function filter($data)
    {
        return array_filter($data, function ($val) {
            return $val !== null;
        });
    }
}
