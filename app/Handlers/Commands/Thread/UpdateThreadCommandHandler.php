<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Handlers\Commands\Thread;

use Hifone\Commands\Thread\UpdateThreadCommand;
use Hifone\Events\Thread\ThreadWasMarkedExcellentEvent;
use Hifone\Events\Thread\ThreadWasMovedEvent;
use Hifone\Models\Node;
use Hifone\Models\Thread;

class UpdateThreadCommandHandler
{
    public function handle(UpdateThreadCommand $command)
    {
        $thread = $command->thread;
        $original_node_id = $thread->node_id;

        $command->updateData['body_original'] = $command->updateData['body'];
        $command->updateData['excerpt'] = Thread::makeExcerpt($command->updateData['body']);
        $command->updateData['body'] = app('parser.markdown')->convertMarkdownToHtml(app('parser.at')->parse($command->updateData['body']));

        $thread->update($this->filter($command->updateData));

        if (isset($command->updateData['is_excellent'])) {
            event(new ThreadWasMarkedExcellentEvent($thread));
        }

        if ($original_node_id != $command->updateData['node_id']) {
            $originalNode = Node::findOrFail($original_node_id);
            event(new ThreadWasMovedEvent($command->thread, $originalNode));
        }

        return $thread;
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
