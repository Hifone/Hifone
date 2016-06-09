<ul class="list-group">

  @foreach ($threads as $index => $thread)
   <li class="list-group-item" >

      <a href="{!! route('thread.show', [$thread->id]) !!}" title="{!! $thread->title !!}">
        {!! str_limit($thread->title, '100') !!}
      </a>

      <span class="meta">

        <a href="{!! $thread->node->url !!}" title="{!! $thread->node->name !!}">
          {!! $thread->node->name !!}
        </a>
        <span> • </span>
        {!! $thread->reply_count !!} {!! trans('hifone.replies.replies') !!}
        <span> • </span>
        <span class="timeago">{!! $thread->created_at !!}</span>

      </span>

  </li>
  @endforeach

</ul>
