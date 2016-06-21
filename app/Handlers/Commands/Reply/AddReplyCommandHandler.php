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

use Auth;
use Carbon\Carbon;
use Hifone\Commands\Reply\AddReplyCommand;
use Hifone\Services\Dates\DateFactory;
use Hifone\Events\Reply\ReplyWasAddedEvent;
use Hifone\Models\Reply;
use Hifone\Services\Parsers\Markdown;
use Hifone\Services\Parsers\ParseAt;

class AddReplyCommandHandler
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
     * @param \Hifone\Services\Commands\Reply\AddReplyCommand $command
     *
     * @return \Hifone\Models\Reply
     */
    public function handle(AddReplyCommand $command)
    {
        $data = [
            'user_id'       => $command->user_id,
            'thread_id'     => $command->thread_id,
            'body'          => $this->markdown->convertMarkdownToHtml($this->parseAt->parse($command->body)),
            'body_original' => $command->body,
            'created_at'    => Carbon::now()->toDateTimeString(),
            'updated_at'    => Carbon::now()->toDateTimeString(),
        ];
        // Create the reply
        $reply = Reply::create($data);

         // Add the reply user
        if ($reply->thread) {
            $reply->thread->last_reply_user_id = $reply->user_id;
            $reply->thread->reply_count++;
            $reply->thread->updated_at = Carbon::now()->toDateTimeString();
            $reply->thread->save();
        }

        Auth::user()->increment('reply_count', 1);

        event(new ReplyWasAddedEvent($reply));

        return $reply;
    }
}
