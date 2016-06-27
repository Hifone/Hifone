<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Handlers\Commands\Pm;

use Hifone\Commands\Pm\AddPmCommand;
use Hifone\Events\Pm\PmWasAddedEvent;
use Hifone\Models\Pm;
use Hifone\Services\Dates\DateFactory;

class AddPmCommandHandler
{
    /**
     * The date factory instance.
     *
     * @var \Hifone\Services\Dates\DateFactory
     */
    protected $dates;

    /**
     * Create a new report pm command handler instance.
     *
     * @param \Hifone\Services\Dates\DateFactory $dates
     */
    public function __construct(DateFactory $dates)
    {
        $this->dates = $dates;
    }

    /**
     * Handle the report pm command.
     *
     * @param \Hifone\Commands\Pm\AddPmCommand $command
     *
     * @return \Hifone\Models\Pm
     */
    public function handle(AddPmCommand $command)
    {
        if ($command->user_id === $command->author_id) {
            throw new \Exception('Recipient ID and sender ID have the same value.');
        }

        $rootId = $rootId ?: dechex(mt_rand(0, 0x7fffffff));

        // Create the pm meta
        $meta = Meta::create([
            'body' => $command->body,
        ]);

        $data = [
            'root_id'            => $rootId,
            'meta_id'            => $meta->id,
            'created_at'         => Carbon::now()->toDateTimeString(),
        ];

        // we need to create two records. one for recipient and one for message author.
        Pm::create($data + ['user_id' => $command->user_id, 'author_id' => $command->author_id, 'folder' => Pm::INBOX]);
        $pm = Pm::create($data + ['user_id' => $command->author_id, 'author_id' => $command->user_id, 'folder' => Pm::OUTBOX]);

        event(new PmWasAddedEvent($pm));

        return $pm;
    }
}
