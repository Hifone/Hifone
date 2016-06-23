<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        // Advertisement
        'Hifone\Events\Advertisement\AdvertisementWasUpdatedEvent' => [
            'Hifone\Handlers\Listeners\Advertisement\RemoveAdvertisementCacheHandler',
        ],
         // Append
        'Hifone\Events\Append\AppendWasAddedEvent' => [
            'Hifone\Handlers\Listeners\Notification\SendAppendNotificationHandler',
        ],

        // Credit
        'Hifone\Events\Credit\CreditWasAddedEvent' => [
            'Hifone\Handlers\Listeners\Notification\SendSingleNotificationHandler',
        ],

        // Favorite
        'Hifone\Events\Favorite\FavoriteWasAddedEvent' => [
            'Hifone\Handlers\Listeners\Notification\SendSingleNotificationHandler',
        ],

         //
        'Hifone\Events\Follow\FollowWasAddedEvent' => [
            'Hifone\Handlers\Listeners\Notification\SendSingleNotificationHandler',
        ],

        // Image

        'Hifone\Events\Image\ImageWasUploadedEvent' => [
            'Hifone\Handlers\Listeners\Photo\AddPhotoRecordHandler',
            'Hifone\Handlers\Listeners\Stats\UpdateStatsHandler',
            'Hifone\Handlers\Listeners\Credit\AddCreditHandler',
        ],

        // 按赞
        'Hifone\Events\Like\LikeWasAddedEvent' => [
            'Hifone\Handlers\Listeners\Notification\SendSingleNotificationHandler',
        ],

        // Links
        'Hifone\Events\Link\LinkWasUpdatedEvent' => [
            'Hifone\Handlers\Listeners\Link\RemoveLinkCacheHandler',
        ],

        // 回帖
        'Hifone\Events\Reply\ReplyWasAddedEvent' => [
            'Hifone\Handlers\Listeners\Notification\SendReplyNotificationHandler',
            'Hifone\Handlers\Listeners\Stats\UpdateStatsHandler',
            'Hifone\Handlers\Listeners\Credit\AddCreditHandler',
        ],
        'Hifone\Events\Reply\ReplyWasRemovedEvent' => [
            'Hifone\Handlers\Listeners\Reply\UpdateReplyThreadHandler',
            'Hifone\Handlers\Listeners\Credit\AddCreditHandler',
        ],

        //
        'Hifone\Events\Thread\ThreadWasAddedEvent' => [
            'Hifone\Handlers\Listeners\Notification\SendThreadNotificationHandler',
            'Hifone\Handlers\Listeners\Stats\UpdateStatsHandler',
            'Hifone\Handlers\Listeners\Credit\AddCreditHandler',
        ],

        //
        'Hifone\Events\Thread\ThreadWasMarkedExcellentEvent' => [
            'Hifone\Handlers\Listeners\Notification\SendSingleNotificationHandler',
        ],

        //
        'Hifone\Events\Thread\ThreadWasMovedEvent' => [
            'Hifone\Handlers\Listeners\Notification\SendSingleNotificationHandler',
            'Hifone\Handlers\Listeners\Thread\UpdateThreadNodesHandler',
        ],

        //
        'Hifone\Events\Thread\ThreadWasRemovedEvent' => [
            'Hifone\Handlers\Listeners\Thread\CleanupThreadRepliesHandler',
        ],

        //
        'Hifone\Events\Thread\ThreadWasUpdatedEvent' => [
            //
        ],

        //
        'Hifone\Events\Thread\ThreadWasViewedEvent' => [
            'Hifone\Handlers\Listeners\Thread\UpdateThreadViewCountHandler',
        ],

        'Hifone\Events\User\UserWasAddedEvent' => [
            'Hifone\Handlers\Listeners\Stats\UpdateStatsHandler',
            'Hifone\Handlers\Listeners\Identity\ChangeUsernameHandler',
            'Hifone\Handlers\Listeners\Credit\AddCreditHandler',
        ],

        'Hifone\Events\User\UserWasLoggedinEvent' => [
            'Hifone\Handlers\Listeners\Credit\AddCreditHandler',
        ],

        'SocialiteProviders\Manager\SocialiteWasCalled' => [
            'SocialiteProviders\Qq\QqExtendSocialite@handle',
            'SocialiteProviders\Weibo\WeiboExtendSocialite@handle',
            'SocialiteProviders\GitLab\GitLabExtendSocialite@handle',
            //'SocialiteProviders\Weixin\WeixinExtendSocialite@handle',
        ],

    ];

    /**
     * Register any other events for your application.
     *
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     *
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
