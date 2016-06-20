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
            'Hifone\Handlers\Events\Advertisement\RemoveAdvertisementCacheHandler',
        ],
         // Append
        'Hifone\Events\Append\AppendWasAddedEvent' => [
            'Hifone\Handlers\Events\Notification\SendAppendNotificationHandler',
        ],

        // Favorite
        'Hifone\Events\Favorite\FavoriteWasAddedEvent' => [
            'Hifone\Handlers\Events\Notification\SendSingleNotificationHandler',
        ],

         //
        'Hifone\Events\Follow\FollowWasAddedEvent' => [
            'Hifone\Handlers\Events\Notification\SendSingleNotificationHandler',
        ],

        // Image

        'Hifone\Events\Image\ImageWasUploadedEvent' => [
            'Hifone\Handlers\Events\Photo\AddPhotoRecordHandler',
            'Hifone\Handlers\Events\Stats\UpdateStatsHandler',
            'Hifone\Handlers\Events\User\UpdateScoreHandler',
        ],

        // 按赞
        'Hifone\Events\Like\LikeWasAddedEvent' => [
            'Hifone\Handlers\Events\Notification\SendSingleNotificationHandler',
        ],

        // Links
        'Hifone\Events\Link\LinkWasUpdatedEvent' => [
            'Hifone\Handlers\Events\Link\RemoveLinkCacheHandler',
        ],

        // 回帖
        'Hifone\Events\Reply\ReplyWasAddedEvent' => [
            'Hifone\Handlers\Events\Notification\SendReplyNotificationHandler',
            'Hifone\Handlers\Events\Stats\UpdateStatsHandler',
            'Hifone\Handlers\Events\User\UpdateScoreHandler',
        ],
        'Hifone\Events\Reply\ReplyWasRemovedEvent' => [
            'Hifone\Handlers\Events\Reply\UpdateReplyThreadHandler',
        ],

        //
        'Hifone\Events\Thread\ThreadWasAddedEvent' => [
            'Hifone\Handlers\Events\Notification\SendThreadNotificationHandler',
            'Hifone\Handlers\Events\Stats\UpdateStatsHandler',
            'Hifone\Handlers\Events\User\UpdateScoreHandler',
        ],

        //
        'Hifone\Events\Thread\ThreadWasMarkedExcellentEvent' => [
            'Hifone\Handlers\Events\Notification\SendSingleNotificationHandler',
        ],

        //
        'Hifone\Events\Thread\ThreadWasMovedEvent' => [
            'Hifone\Handlers\Events\Notification\SendSingleNotificationHandler',
            'Hifone\Handlers\Events\Thread\UpdateThreadNodesHandler',
        ],

        //
        'Hifone\Events\Thread\ThreadWasRemovedEvent' => [
            'Hifone\Handlers\Events\Thread\CleanupThreadRepliesHandler',
        ],

        //
        'Hifone\Events\Thread\ThreadWasUpdatedEvent' => [
            //
        ],

        'Hifone\Events\User\UserWasAddedEvent' => [
            'Hifone\Handlers\Events\Stats\UpdateStatsHandler',
            'Hifone\Handlers\Events\Identity\ChangeUsernameHandler',
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
