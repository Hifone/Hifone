@extends('layouts.default')

@section('title')
{!! trans('hifone.notifications.my') !!} @parent
@stop

@section('content')

<div class="panel panel-default">

    <div class="panel-heading">
      {!! trans('hifone.notifications.my') !!}
    </div>

    @if (count($notifications))

        <div class="panel-body remove-padding-horizontal notification-index">

            <ul class="list-group row">
                @foreach ($notifications as $notification)
                 <li class="list-group-item media" style="margin-top: 0px;">

                    @if (count($notification->user))
                        <div class="avatar pull-left">
                            <a href="{!! route('user.show', [$notification->from_user_id]) !!}">
                                <img class="media-object img-thumbnail avatar" alt="{!! $notification->fromUser->username !!}" src="{!! $notification->fromUser->avatar30 !!}"  style="width:38px;height:38px;"/>
                            </a>
                        </div>

                        <div class="infos">

                          <div class="media-heading">

                            <a href="{!! route('user.show', [$notification->from_user_id]) !!}">
                                {!! $notification->fromUser->username !!}
                            </a>
                             •
                            {!! $notification->labelUp !!}
                            @if($notification->type != 'user_follow')
                            <a href="{!! route('thread.show', [$notification->thread->id]) !!}{!! !empty($notification->reply_id) ? '#reply' . $notification->reply_id : '' !!}" title="{!! $notification->thread->title !!}">
                                {!! str_limit($notification->thread->title, '100') !!}
                            </a>
                            @endif
                            <span class="meta">
                                 • {!! trans('hifone.at') !!} • <span class="timeago">{!! $notification->created_at !!}</span>
                            </span>
                          </div>
                          <div class="media-body markdown-reply content-body">
{!! $notification->body !!}
                          </div>

                        </div>
                    @else
                      <div class="deleted text-center">{!! trans('hifone.notifications.deleted') !!}</div>
                    @endif
                </li>
                @endforeach
            </ul>


        </div>

        <div class="panel-footer text-right remove-padding-horizontal pager-footer">
            <!-- Pager -->
            {!! $notifications->render() !!}
        </div>

    @else
        <div class="panel-body">
            <div class="empty-block">{!! trans('hifone.notifications.noitem') !!}</div>
        </div>
    @endif

</div>


@stop
