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
use Hifone\Services\Dates\DateFactory;
use Hifone\Services\Tag\AddTag;

class UpdateThreadCommandHandler
{
    /**
     * The date factory instance.
     *
     * @var \Hifone\Services\Dates\DateFactory
     */
    protected $dates;

    /**
     * Create a new report issue command handler instance.
     *
     * @param \Hifone\Services\Dates\DateFactory $dates
     */
    public function __construct(DateFactory $dates)
    {
        $this->dates = $dates;
    }

    public function handle(UpdateThreadCommand $command)
    {
        $thread = $command->thread;
        $original_node_id = $thread->node_id;

        if (isset($command->data['body']) && $command->data['body']) {
            $command->data['body_original'] = $command->data['body'];
            $command->data['excerpt'] = Thread::makeExcerpt($command->data['body']);
            $command->data['body'] = app('parser.markdown')->convertMarkdownToHtml(app('parser.at')->parse($command->data['body']));
        }

        $thread->update($this->filter($command->data));

        // The thread was added successfully, so now let's deal with the tags.
        $tags = isset($command->data['tags']) ? $command->data['tags'] : [];
        app(AddTag::class)->attach($thread, $tags);

        if (isset($command->data['is_excellent'])) {
            event(new ThreadWasMarkedExcellentEvent($thread));
        }

        if (isset($command->data['node_id']) && $original_node_id != $command->data['node_id']) {
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
