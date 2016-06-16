<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Events\Dispatcher;

class ResetCommand extends Command
{
    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'hifone:reset';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Resets and installs the application';

    /**
     * The events instance.
     *
     * @var \Illuminate\Contracts\Events\Dispatcher
     */
    protected $events;

    /**
     * Create a new instance.
     *
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     *
     * @return void
     */
    public function __construct(Dispatcher $events)
    {
        $this->events = $events;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->events->fire('command.resetting', $this);
        $this->events->fire('command.generatekey', $this);
        $this->events->fire('command.cacheconfig', $this);
        $this->events->fire('command.cacheroutes', $this);
        $this->events->fire('command.publishvendors', $this);
        $this->events->fire('command.resetmigrations', $this);
        $this->events->fire('command.runmigrations', $this);
        $this->events->fire('command.runseeding', $this);
        $this->events->fire('command.updatecache', $this);
        $this->events->fire('command.extrastuff', $this);
        $this->events->fire('command.reset', $this);
    }

    /**
     * Get the events instance.
     *
     * @return \Illuminate\Contracts\Events\Dispatcher
     */
    public function getEvents()
    {
        return $this->events;
    }
}
