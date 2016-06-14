@extends('layouts.default')

@section('title')
{{{ $thread->title }}} - @parent
@stop

@section('description')
{{{ $thread->excerpt }}}
@stop

@section('content')

<div class="col-md-9 threads-show main-col">

  <!-- Thread Detial -->
  <div class="thread panel panel-default">
    <div class="infos panel-heading">

      <div class="pull-right avatar">
        <a href="{{ route('user.show', $thread->user->id) }}">
          <img src="{{ $thread->user->avatar }}" class="media-object img-thumbnail avatar-64" />
        </a>
      </div>

      <h1 class="panel-title thread-title">{{{ $thread->title }}}</h1>

      <div class="likes">
            <li data-method="post" data-url="{{ route('thread.like', $thread->id) }}" title="{{ trans('hifone.like') }}" class="fa fa-chevron-up like" id="like"> {{ $thread->like_count }}</li>
            <li data-method="post" data-url="{{ route('thread.unlike', $thread->id) }}" title="{{ trans('hifone.unlike') }}" class="fa fa-chevron-down like" id="unlike"></li>
      </div>

      @include('threads.partials.meta')
    </div>

    <div class="panel-body content-body">

      @include('threads.partials.body', array('body' => $thread->body))

      @include('threads.partials.ribbon')
    </div>

    @foreach ($thread->appends as $index => $append)

        <div class="appends">
            <span class="meta">{!! trans('hifone.appends.appends') !!} {!! $index !!} &nbsp;·&nbsp; <abbr title="{!! $append->created_at !!}" class="timeago">{{ $append->created_at }}</abbr></span>
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
  {{ trans('hifone.replies.replies') }}
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
              {!! Form::textarea('reply[body]', null, ['class' => 'topic-editor form-control',
                                                'rows' => 5,
                                                'placeholder' => trans('hifone.markdown_support'),
                                                'style' => "overflow:hidden",
                                                'id' => 'body_field']) !!}
        </div>

        <div class="form-group status-post-submit">
              {!! Form::submit(trans('hifone.replies.replies'), ['class' => 'btn btn-primary', 'id' => 'reply-create-submit']) !!}
            &nbsp;<span class="help-inline" title="Or Command + Enter">Ctrl+Enter</span>
        </div>
    {!! Form::close() !!}
    @else
    <div style="padding:20px;">
    需要 <a class="btn btn-success" href="/auth/login">登录</a> 后方可回复, 如果你还没有账号请点击这里 <a class="btn btn-primary" href="/auth/register">注册</a>。
  </div>
    @endif
    </div>
  </div>
</div>

</div>

@include('partials.sidebar')

@stop
