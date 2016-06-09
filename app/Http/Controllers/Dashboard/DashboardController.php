<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Http\Controllers\Dashboard;

use Hifone\Models\Node;
use Hifone\Models\Thread;
use Hifone\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Jenssegers\Date\Date;

class DashboardController extends Controller
{
    /**
     * Start date.
     *
     * @var \Jenssegers\Date\Date
     */
    protected $startDate;
    /**
     * The timezone the status page is running in.
     *
     * @var string
     */
    protected $timeZone;

    /**
     * Creates a new dashboard controller.
     *
     * @return void
     */
    public function __construct()
    {
        $this->startDate = new Date();
        $this->dateTimeZone = Config::get('hifone.timezone');
    }

    public function index()
    {
        $nodes = Node::orderBy('order')->get();
        $threads = $this->getThreads();
        $users = $this->getUsers();
        $recentThreads = Thread::orderBy('created_at', 'desc')->take(10)->get();
        $recentUsers = User::orderBy('created_at', 'desc')->take(10)->get();

        return View::make('dashboard.index')
            ->withThreads($threads)
            ->withUsers($users)
            ->withRecentThreads($recentThreads)
            ->withRecentUsers($recentUsers)
            ->withNodes($nodes);
    }

    /**
     * Fetches all of the threads over the last 30 days.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function getThreads()
    {
        $allThreads = Thread::whereBetween('created_at', [
            $this->startDate->copy()->subDays(30)->format('Y-m-d').' 00:00:00',
            $this->startDate->format('Y-m-d').' 23:59:59',
        ])->orderBy('created_at', 'desc')->get()->groupBy(function (Thread $thread) {
            return (new Date($thread->created_at))
                ->setTimezone($this->dateTimeZone)->toDateString();
        });
        // Add in days that have no threads
        foreach (range(0, 30) as $i) {
            $date = (new Date($this->startDate))->setTimezone($this->dateTimeZone)->subDays($i);
            if (!isset($allThreads[$date->toDateString()])) {
                $allThreads[$date->toDateString()] = [];
            }
        }
        // Sort the array so it takes into account the added days
        $allThreads = $allThreads->sortBy(function ($value, $key) {
            return strtotime($key);
        }, SORT_REGULAR, false);

        return $allThreads;
    }

    /**
     * Fetches all of the users over the last 30 days.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function getUsers()
    {
        $allUsers = User::whereBetween('created_at', [
            $this->startDate->copy()->subDays(30)->format('Y-m-d').' 00:00:00',
            $this->startDate->format('Y-m-d').' 23:59:59',
        ])->orderBy('created_at', 'desc')->get()->groupBy(function (User $user) {
            return (new Date($user->created_at))
                ->setTimezone($this->dateTimeZone)->toDateString();
        });
        // Add in days that have no users
        foreach (range(0, 30) as $i) {
            $date = (new Date($this->startDate))->setTimezone($this->dateTimeZone)->subDays($i);
            if (!isset($allUsers[$date->toDateString()])) {
                $allUsers[$date->toDateString()] = [];
            }
        }
        // Sort the array so it takes into account the added days
        $allUsers = $allUsers->sortBy(function ($value, $key) {
            return strtotime($key);
        }, SORT_REGULAR, false);

        return $allUsers;
    }
}
