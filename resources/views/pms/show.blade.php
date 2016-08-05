@extends('layouts.default')

@section('title')
{{{ $thread->title }}} - @parent
@stop

@section('description')
{{{ $thread->excerpt }}}
@stop

@section('content')

<div class="col-md-9 threads-show main-col">

  <!-- Reply List -->
  <div class="replies panel panel-default list-panel replies-index">
    <div class="panel-heading">
      <h1 class="panel-title thread-title">{{{ $thread->subject }}}</h1>
      <div class="total">{{ trans('hifone.replies.total') }}: <b>{{ $thread->messages->count() }}</b> </div>
    </div>

    <div class="panel-body">
      @if (count($thread->messages->count()))
        @include('pms.partials.replies')
      @else
         <div class="empty-block">{{ trans('hifone.replies.noitem') }}</div>
      @endif
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
            {!! Form::open(['route' => ['messages.update', $thread->id], 'method' => 'PUT']) !!}
      <input type="hidden" name="reply[thread_id]" value="{{ $thread->id }}" />
        {{--
            <!-- editor start -->
        @include('pms.partials.editor_toolbar')
        <!-- end -->
        --}}

        <!-- Message Form Input -->
        <div class="form-group">
            {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
        </div>

        {{--
        <div class="form-group">
            <select class="form-control selectpicker" name="thread[node_id]">
                <option value="">{{ trans('hifone.threads.pick_node') }}</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}"> - {{ $user->username }}</option>
                @endforeach
            </select>
        </div>
        --}}

        <div class="form-group status-post-submit">
            {!! Form::submit(trans('hifone.pms.send'), ['class' => 'btn btn-primary form-control']) !!}
            &nbsp;<span class="help-inline" title="Or Command + Enter">Ctrl+Enter</span>
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
