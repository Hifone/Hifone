<div class="panel-footer operate">

  <div class="pull-left" style="font-size:15px;">
    <a class="" href="http://service.weibo.com/share/share.php?url={!! urlencode(Request::url()) !!}&type=3&pic=&title={{{ $thread->title }}}" target="_blank" title="{{ trans('hifone.threads.share2weibo') }}">
      <i class="fa fa-weibo"></i>
    </a>
    <a href="https://twitter.com/intent/tweet?url={!! urlencode(Request::url()) !!}&text={{{ $thread->title }}}&via=hifone.com" class=""  target="_blank" title="{{ trans('hifone.threads.share2twitter') }}">
      <i class="fa fa-twitter"></i>
    </a>
    <a href="http://www.facebook.com/sharer.php?u={!! urlencode(Request::url()) !!}" class=""  target="_blank" title="{{ trans('hifone.threads.share2facebook') }}">
      <i class="fa fa-facebook"></i>
    </a>
    <a href="https://plus.google.com/share?url={!! urlencode(Request::url()) !!}" class=""  target="_blank" title="{{ trans('hifone.threads.share2google') }}">
      <i class="fa fa-google-plus"></i>
    </a>
  </div>

  <div class="pull-right">
    @if($thread->tagsList)
      <span class="tag-list hidden-xs">
      Tags: 
      @foreach($thread->tags as $tag)
      <a href="/tag/{{ urlencode($tag->name) }}"><span class="tag">{{ $tag->name }}</span></a>
      @endforeach
      </span>
    @endif
    @if (Auth::user() && $thread->follows()->forUser(Auth::user()->id)->count())
      <a class="followable active" data-action="unfollow" data-id="{{ $thread->id }}" data-type="Thread" href="javascript:void(0);" data-url="{{ route('follow.createOrDelete', $thread->id) }}">
        <i class="fa fa-eye"></i> <span>{{ trans('hifone.follow') }}</span>
      </a>
    @else
      <a class="followable" data-action="follow" data-id="{{ $thread->id }}" data-type="Thread" href="javascript:void(0);" data-url="{{ route('follow.createOrDelete', $thread->id) }}">
        <i class="fa fa-eye"></i> <span>{{ trans('hifone.follow') }}</span>
      </a>
    @endif

    @if (Auth::user() && \Hifone\Models\Favorite::isUserFavoritedThread(Auth::user(), $thread->id))
      <a class="favoriteable active" data-type="Thread" data-id="{{ $thread->id }}" href="javascript:void(0);" data-url="{{ route('favorite.createOrDelete', $thread->id) }}">
        <i class="fa fa-bookmark"></i> <span>{{ trans('hifone.favorite') }}</span>
      </a>
    @else
      <a class="favoriteable" data-type="Thread" data-id="{{ $thread->id }}" href="javascript:void(0);" data-url="{{ route('favorite.createOrDelete', $thread->id) }}">
        <i class="fa fa-bookmark"></i> <span>{{ trans('hifone.favorite') }}</span>
      </a>
    @endif

    @if (Auth::user() && Auth::user()->can("manage_threads") )
        <a data-method="post" id="thread-recommend-button" href="javascript:void(0);" data-url="{{ route('thread.recommend', [$thread->id]) }}" class="admin {!! $thread->is_excellent ? 'active' :'';!!}" title="{{ trans('hifone.threads.mark_excellent') }}">
        <i class="fa fa-trophy"></i>
        </a>

        @if ($thread->order >= 0)
          <a data-method="post" id="thread-pin-button" href="javascript:void(0);" data-url="{{ route('thread.pin', [$thread->id]) }}" class="admin {!! $thread->order > 0 ? 'active' : '' !!}" title="{{ trans('hifone.threads.mark_stick') }}">
            <i class="fa fa-thumb-tack"></i>
          </a>
        @endif

        @if ($thread->order <= 0)
            <a data-method="post" id="thread-sink-button" href="javascript:void(0);" data-url="{{ route('thread.sink', [$thread->id]) }}" class="admin {!! $thread->order < 0 ? 'active' : '' !!}" title="{{ trans('hifone.threads.mark_sink') }}">
                <i class="fa fa-anchor"></i>
            </a>
        @endif

        <a data-method="delete" id="thread-delete-button" href="javascript:void(0);" data-url="{{ route('thread.destroy', [$thread->id]) }}" title="{{ trans('forms.delete') }}" class="admin confirm-action">
            <i class="fa fa-trash-o"></i>
        </a>
    @endif

    @if ( Auth::user() && (Auth::user()->can("manage_threads") || Auth::user()->id == $thread->user_id) )
      <a id="thread-append-button" href="javascript:void(0);" title="{{ trans('hifone.appends.appends') }}" class="admin" data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-plus"></i>
      </a>

      <a id="thread-edit-button" href="{{ route('thread.edit', [$thread->id]) }}" title="{{ trans('forms.edit') }}" class="admin">
        <i class="fa fa-pencil-square-o"></i>
      </a>
    @endif

  </div>
  <div class="clearfix"></div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="" aria-labelledby="exampleModalLabel" >
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">{{ trans('hifone.appends.content') }}</h4>
      </div>

     {!! Form::open(['route' => ['thread.append', $thread->id],'method' => 'post']) !!}

        <div class="modal-body">

          <div class="alert alert-warning">
              {{ trans('hifone.appends.notice') }}
          </div>

          <div class="form-group">
            {!! Form::textarea('content', null, ['class' => 'form-control',
                                                'style' => 'min-height:20px',
                                          'placeholder' => trans('hifone.markdown_support')]) !!}

          </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('forms.close') }}</button>
            <button type="submit" class="btn btn-primary">{{ trans('forms.submit') }}</button>
          </div>

      {!! Form::close() !!}

    </div>
  </div>
</div>
