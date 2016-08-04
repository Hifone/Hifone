<ul class="list-group row">
  @foreach ($thread->messages as $index => $reply)
   <li class="list-group-item media {{ $reply->highlight }}" id="reply{{$reply->id}}">
    <div class="avatar pull-left">
      <a href="{!! route('user.show', [$reply->user_id]) !!}">
        <img class="media-object img-thumbnail avatar" alt="{!! $reply->user->username !!}" src="{!! $reply->user->avatar_small !!}"  style="width:48px;height:48px;"/>
      </a>
    </div>
    <div class="infos">

      <div class="media-heading meta">

        <a href="{!! route('user.show', [$reply->user_id]) !!}" title="{!! $reply->user->username !!}" class="remove-padding-left author">
            {!! $reply->user->username !!}
        </a>
        <abbr class="timeago" title="{!! $reply->created_at !!}">{!! $reply->created_at !!}</abbr>

        <span class="opts pull-right">
          <span class="hideable">
            @if (Auth::user() && (Auth::user()->can("manage_threads") || Auth::user()->id == $reply->user_id) )
            <a class="fa fa-trash-o" id="reply-delete-{!! $reply->id !!}" data-method="delete"  href="javascript:void(0);" data-url="{!! route('reply.destroy', [$reply->id]) !!}" title="{!! trans('forms.delete') !!}"></a>
          @endif
          </span>
        </span>

      </div>

      <div class="media-body markdown-reply content-body">
      {!! $reply->body !!}
      </div>
    </div>
  </li>
  @endforeach
</ul>