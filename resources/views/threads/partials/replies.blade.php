<ul class="list-group row">

  @foreach ($replies as $index => $reply)
   <li class="list-group-item media"
           @if($reply->like_count >= 1)
                style="margin-top: 0px; background-color: #fffce9"
           @else
                style="margin-top: 0px;"
           @endif
           >

    <div class="avatar pull-left">
      <a href="{!! route('user.show', [$reply->user_id]) !!}">
        <img class="media-object img-thumbnail avatar" alt="{!! $reply->user->username !!}" src="{!! $reply->user->avatar30 !!}"  style="width:48px;height:48px;"/>
      </a>
    </div>

    <div class="infos">

      <div class="media-heading meta">

        <a href="{!! route('user.show', [$reply->user_id]) !!}" title="{!! $reply->user->username !!}" class="remove-padding-left author">
            {!! $reply->user->username !!}
        </a>
        <abbr class="timeago" title="{!! $reply->created_at !!}">{!! $reply->created_at !!}</abbr>
        <a name="reply{!! $thread->replyFloorFromIndex($index) !!}" class="anchor" href="#reply{!! $thread->replyFloorFromIndex($index) !!}" aria-hidden="true">#{!! $thread->replyFloorFromIndex($index) !!}</a>

        <span class="operate pull-right">
          <a data-method="post" id="reply-like-{!! $reply->id !!}" href="javascript:void(0);" data-url="{!! route('reply.like', $reply->id) !!}" title="{!! trans('hifone.like') !!}">
             <i class="fa fa-thumbs-o-up"></i> {!! $reply->like_count ?: '' !!}
          </a>
          <a class="fa fa-reply btn-reply2reply" data-username="{{ $reply->user->username }}" href="javascript:void(0)" title="回复 {!! $reply->user->username !!}"></a>

          @if (Auth::user() && (Auth::user()->can("manage_threads") || Auth::user()->id == $reply->user_id) )
          <a id="reply-delete-{!! $reply->id !!}" data-method="delete"  href="javascript:void(0);" data-url="{!! route('reply.destroy', [$reply->id]) !!}" title="{!! trans('forms.delete') !!}">
              <i class="fa fa-trash-o"></i>
          </a>
          @endif
        </span>

      </div>

      <div class="media-body markdown-reply content-body">
{!! $reply->body !!}
      </div>

    </div>

  </li>
  @endforeach

</ul>
