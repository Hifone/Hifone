<div class="meta inline-block" >

  <a href="{{ route('user.home', $thread->creator()->username) }}">
    {{ $thread->creator()->username }}
  </a>

  @if ($thread->creator()->hasBadge)
    <span class="label label-warning" style="position: relative;">{{ $thread->creator()->badgeName }}</span>
  @endif
  •
  {{ trans('hifone.at') }} <abbr title="{{ $thread->created_at }}" class="timeago">{{ $thread->created_at }}</abbr>

</div>
<div class="clearfix"></div>
