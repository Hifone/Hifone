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

use Auth;
use Carbon\Carbon;
use Hifone\Commands\Thread\AddThreadCommand;
use Hifone\Services\Dates\DateFactory;
use Hifone\Events\Thread\ThreadWasAddedEvent;
use Hifone\Models\Thread;
use Hifone\Services\Parsers\Markdown;
use Hifone\Services\Parsers\ParseAt;

class AddThreadCommandHandler
{
    /**
     * The date factory instance.
     *
     * @var \Hifone\Services\Dates\DateFactory
     */
    protected $dates;

    protected $markdown;

    protected $parseAt;

    /**
     * Create a new report issue command handler instance.
     *
     * @param \Hifone\Services\Dates\DateFactory $dates
     */
    public function __construct(DateFactory $dates, Markdown $markdown, ParseAt $parseAt)
    {
        $this->dates = $dates;
        $this->markdown = $markdown;
        $this->parseAt = $parseAt;
    }

    /**
     * Handle the report thread command.
     *
     * @param \Hifone\Commands\Thread\AddThreadCommand $command
     *
     * @return \Hifone\Models\Thread
     */
    public function handle(AddThreadCommand $command)
    {
        $data = [
            'user_id'       => $command->user_id,
            'title'         => $command->title,
            'excerpt'       => Thread::makeExcerpt($command->body),
            'node_id'       => $command->node_id,
            'body'          => $this->markdown->convertMarkdownToHtml($this->parseAt->parse($command->body)),
            'body_original' => $command->body,
            'created_at'    => Carbon::now()->toDateTimeString(),
            'updated_at'    => Carbon::now()->toDateTimeString(),
        ];
        // Create the thread
        $thread = Thread::create($data);

        // Update the node.
        if ($thread->node) {
            $thread->node->increment('thread_count', 1);
        }

        Auth::user()->increment('thread_count', 1);

        event(new ThreadWasAddedEvent($thread));

        return $thread;
    }
}
