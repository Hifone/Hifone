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
use Hifone\Models\Pm\Meta;
use Hifone\Services\Dates\DateFactory;
use Hifone\Repositories\Contracts\PmRepositoryInterface;

class AddPmCommandHandler
{
    /**
     * The date factory instance.
     *
     * @var \Hifone\Services\Dates\DateFactory
     */
    protected $dates;

	protected $pm;

    /**
     * Create a new report pm command handler instance.
     *
     * @param \Hifone\Services\Dates\DateFactory $dates
     */
    public function __construct(DateFactory $dates, PmRepositoryInterface $pm)
    {
        $this->dates = $dates;
		$this->pm = $pm;
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

		$pm = $this->pm->submit($command->user_id, $command->author_id, $command->body);

        event(new PmWasAddedEvent($pm));

        return $pm;
    }
}
