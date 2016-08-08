
@if (count($threads))

<ul class="list-group row thread-list">
    @foreach ($threads as $thread)
     <li class="list-group-item media {!! !$column ?'':'col-sm-6' !!}" style="margin-top: 0px;">

        <a class="pull-right" href="{{ route('thread.show', [$thread->id]) }}" >
            <span class="badge badge-reply-count"> {{ $thread->reply_count }} </span>
        </a>

        <div class="avatar pull-left">
            <a href="{{ $thread->author_url }}">
                <img class="media-object img-thumbnail avatar-48" alt="{{{ $thread->user->username }}}" src="{{ $thread->user->avatar_small}}"/>
            </a>
        </div>

        <div class="infos">

          <div class="media-heading">

            @if ($thread->icon && !Input::get('filter') && Route::currentRouteName() != 'excellent' )
                <i class="{{ $thread->icon }}"></i>
            @elseif ($thread->icon && !Input::get('filter') && Route::currentRouteName() != 'excellent' )
                <i class="{{ $thread->icon }}"></i>
            @endif

            <a href="{{ route('thread.show', [$thread->id]) }}" title="{{{ $thread->title }}}">
                {{{ $thread->title }}}
            </a>
            
          </div>
         
          <div class="media-body meta">
            @if ($thread->like_count > 0)
                <a href="{{ route('thread.show', [$thread->id]) }}" class="remove-padding-left" id="pin-{{ $thread->id }}">
                    <span class="fa fa-thumbs-o-up"> {{ $thread->like_count }} </span>
                </a>
                <span> • </span>
            @endif

            @if(!isset($node))
            <a href="{{ $thread->node->url }}" title="{{{ $thread->node->name }}}" {{ $thread->like_count == 0 || 'class="remove-padding-left"'}}>
                {{{ $thread->node->name }}}
            </a>
            <span> • </span>
                <!-- <span> • </span> -->
            @endif
            @if($thread->tagsList)
            <span class="tag-list hidden-xs">
                @foreach($thread->tags as $tag)
                <a href="/tag/{{ urlencode($tag->name) }}"><span class="tag">{{ $tag->name }}</span></a>
                @endforeach
            <span> • </span>
            </span>
            @endif
            @if ($thread->reply_count == 0)
                    @if($thread->user->nickname)
                        <a href="{{ $thread->author_url }}" title="{{ $thread->user->nickname }}">{{ $thread->user->nickname }}
                        </a>
                    @else
                        <a href="{{ $thread->author_url }}" title="{{ $thread->user->username }}">{{ $thread->user->username }}
                        </a>
                    @endif

                <span> • </span>
                <span class="timeago {{ $thread->highlight }}" data-toggle="tooltip" data-placement="top" title="{{ $thread->created_at }}">{{ $thread->created_at }}</span>
            @endif
            @if ($thread->reply_count > 0 && count($thread->lastReplyUser))
                <span>{{ trans('hifone.threads.last_reply_by') }}</span>
                <a href="{{ route('user.home', [$thread->lastReplyUser->username]) }}">
                  {{ $thread->lastReplyUser->username }}
                </a>
                <span> • </span>
                <span class="timeago {{ $thread->highlight }}" data-toggle="tooltip" data-placement="top" title="{{ $thread->updated_at }}">{{ $thread->updated_at }}</span>
            @endif
          </div>

        </div>

    </li>
    @endforeach
</ul>

@else
   <div class="empty-block">{{ trans('hifone.noitem') }}</div>
@endif
