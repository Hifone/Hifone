@if (count($threads))

    <ul class="list-group row thread-list">
        @foreach ($threads as $thread)
            <li class="list-group-item media {!! !$column ?'':'col-sm-6' !!}" style="margin-top: 0px;">

                <a class="pull-right" href="{{ route('thread.show', [$thread->id]) }}">

                    @if ($thread->isUnread($currentUserId))
                        <span class="badge badge-reply-count" style="background-color: green;">
                            {{ trans('hifone.pms.unreaded') }}
                        </span>
                    @endif

                    <span class="badge badge-reply-count">
                        {{ $thread->messages->count() }}
                    </span>

                </a>

                <div class="avatar pull-left">
                    <a href="{{-- $thread->author_url --}}">
                        <img class="media-object img-thumbnail avatar-48" alt="{{ $thread->creator()->username }}"
                             src="{{ $thread->creator()->avatar_small }}"/>
                    </a>
                </div>

                <div class="infos">

                    <div class="media-heading">
                        {!! link_to('messages/' . $thread->id, $thread->subject) !!}
                    </div>

                    <div class="media-body meta">
                        <a href="{{ route('user.home', $thread->creator()->username) }}">
                            {{ $thread->creator()->username }}
                        </a>
                        <span> • </span>
                        <span class="timeago" data-toggle="tooltip" data-placement="top"
                              title="{{ $thread->updated_at }}">{{ $thread->updated_at }}</span>
                    </div>

                </div>

            </li>
        @endforeach
    </ul>

@else
    <div class="empty-block">{{ trans('hifone.noitem') }}</div>
@endif
