@extends('layouts.default')

@section('title')
{{ $thread->title }} - @parent
@stop

@section('description')
{{ $thread->excerpt }}
@stop

@section('content')

<div class="col-md-9 threads-show main-col">

  <!-- Thread Detial -->
  <div class="thread panel panel-default">
    <div class="infos panel-heading">

      <div class="pull-right avatar">
        <a href="{{ route('user.home', $thread->user->username) }}">
          <img src="{{ $thread->user->avatar }}" class="media-object img-thumbnail avatar-64" />
        </a>
      </div>

      <h1 class="panel-title thread-title">{{ $thread->title }}</h1>

      <div class="likes">
            <a href="javascript:void(0);" data-action="like" data-type="Thread" data-url="{{ route('like.store') }}" title="{{ trans('hifone.like') }}" class="fa fa-chevron-up likeable like" data-id="{{ $thread->id }}"> {{ $thread->like_count }}</a>
            <a href="javascript:void(0);" data-action="unlike" data-type="Thread" data-url="{{ route('like.destroy', $thread->id) }}" title="{{ trans('hifone.unlike') }}" class="fa fa-chevron-down likeable like" data-id="{{ $thread->id }}"></a>
      </div>

      @include('threads.partials.meta')
    </div>

    <div class="panel-body content-body">

      @include('threads.partials.body', array('body' => $thread->body))

      @include('threads.partials.ribbon')
    </div>

    @foreach ($thread->appends as $index => $append)

        <div class="appends">
            <span class="meta">{{ trans('hifone.appends.appends') }} {{ $index + 1 }} &nbsp;k·&nbsp; <abbr title="{!! $append->created_at !!}" class="timeago">{{ $append->created_at }}</abbr></span>
            <div class="sep5"></div>
            <div class="markdown-reply append-content">
                {!! $append->content !!}
            </div>
        </div>

    @endforeach

    @include('threads.partials.thread_operate')
  </div>

  <!-- Reply List -->
  <div class="replies panel panel-default list-panel replies-index">
    <div class="panel-heading">
      <div class="total">{{ trans('hifone.replies.total') }}: <b>{{ $replies->total() }}</b> </div>
    </div>

    <div class="panel-body">

      @if (count($replies))
        @include('threads.partials.replies')
      @else
         <div class="empty-block">{{ trans('hifone.replies.noitem') }}</div>
      @endif

      <!-- Pager -->
      <div class="pull-right" style="padding-right:20px">
        {!! $replies->appends(Request::except('page'))->render(); !!}
      </div>
    </div>
  </div>

  <!-- Reply Box -->
<div class="panel panel-default">
  <div class="panel-heading">
  {{ trans('hifone.replies.add') }}
  </div>
  <div class="panel-body">
    <div class="reply-box form">
    @if($current_user)
    {!! Form::open(['route' => 'reply.store', 'id' => 'reply_create_form', 'class' => 'create_form', 'method' => 'post']) !!}
      <input type="hidden" name="reply[thread_id]" value="{{ $thread->id }}" />
        <!-- editor start -->
        @include('threads.partials.editor_toolbar')
        <!-- end -->
        <div class="form-group">
              {!! Form::textarea('reply[body]', null, ['class' => 'post-editor form-control',
                                                'rows' => 5,
                                                'placeholder' => trans('hifone.markdown_support'),
                                                'style' => "overflow:hidden",
                                                'id' => 'body_field']) !!}
        </div>

        <div class="form-group status-post-submit">
              {!! Form::submit(trans('forms.publish'), ['class' => 'btn btn-primary', 'id' => 'reply-create-submit']) !!}
            &nbsp;<span class="help-inline" title="Or Command + Enter">Ctrl+Enter</span>
            <span class="pull-right">
              <small>{!! trans('hifone.photos.drag_drop') !!}</small>
            </span>
        </div>
    {!! Form::close() !!}
    @else
    <div style="padding:20px;">
    {!! trans('hifone.threads.login_needed') !!}
  </div>
    @endif
    </div>
  </div>
</div>

</div>

@include('partials.sidebar')

@stop
