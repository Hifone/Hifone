<div class="meta inline-block" >

  <a href="{{ $thread->node->url }}" class="remove-padding-left">
    {{{ $thread->node->name }}}
  </a>
  •
  <a href="{{ route('user.home', $thread->user->username) }}">
    {{{ $thread->user->username }}}
  </a>

  @if ($thread->user->hasBadge)
    <span class="label label-warning" style="position: relative;">{{{ $thread->user->badgeName }}}</span>
  @endif
  •
  {{ trans('hifone.at') }} <abbr title="{{ $thread->created_at }}" class="timeago">{{ $thread->created_at }}</abbr>
  •

  @if (count($thread->lastReplyUser))
    {{ trans('hifone.threads.last_reply_by') }}
      <a href="{{ route('user.home', [$thread->lastReplyUser->username]) }}">
        {{{ $thread->lastReplyUser->username }}}
      </a>
     {{ trans('hifone.at') }} <abbr title="{{ $thread->updated_at }}" class="timeago">{{ $thread->updated_at }}</abbr>
    •
  @endif

  {{ $thread->view_count }} {{ trans('hifone.view_count') }}
</div>
<div class="clearfix"></div>
