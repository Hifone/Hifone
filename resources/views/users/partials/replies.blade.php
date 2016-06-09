
<ul class="list-group">
  @foreach ($replies as $index => $reply)
   <li class="list-group-item">

    @if (count($reply->thread))
      <a href="{!! route('thread.show', [$reply->thread_id]) !!}" title="{!! $reply->thread->title !!}" class="remove-padding-left">
          {!! $reply->thread->title !!}
      </a>
      <span class="meta">
         at <span class="timeago" title="{!! $reply->created_at !!}">{!! $reply->created_at !!}</span>
      </span>
      <div class="reply-body markdown-reply content-body">
{!! $reply->body !!}
      </div>
    @else
      <div class="deleted text-center">{!! trans('hifone.deleted') !!}</div>
    @endif

  </li>
  @endforeach
</ul>
