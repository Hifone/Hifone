@extends('layouts.default')

@section('title')
{{ trans('hifone.pms.add') }}_@parent
@stop

@section('content')

<div class="pm_create">

  <div class="col-md-9 main-col">
    <div class="panel panel-default corner-radius">
    <div class="panel-heading">
	
		@include('pms.partials.nav')
	
	</div>
    <div class="panel-body">
    <div class="reply-box form box-block">
      @if (isset($pm))
        {!! Form::model($pm, ['route' => ['pm.update', $pm->id], 'id' => 'pm_edit_form', 'method' => 'patch']) !!}
      @else
        {!! Form::open(['route' => 'pm.store','id' => 'pm_create_form', 'class' => 'create_form', 'method' => 'post']) !!}
      @endif
		<div class="form-group">
			{!! Form::text('pm[username]', isset($recipient) ? $recipient->username : null, ['class' => 'form-control', 'id' => 'username', 'placeholder' => trans('hifone.pms.recipient')]) !!}
		</div>
        <!-- editor start -->
        @include('threads.partials.editor_toolbar')
        <!-- end -->
        <div class="form-group">
          {!! Form::textarea('pm[body]', isset($pm) ? $pm->body_original : null, ['class' => 'post-editor form-control',
                                            'rows' => 15,
                                            'style' => "overflow:hidden",
                                            'id' => 'body_field',
                                            'placeholder' => trans('hifone.markdown_support')]) !!}
        </div>

        <div class="form-group status-post-submit">
          {!! Form::submit(trans('forms.publish'), ['class' => 'btn btn-primary col-xs-2', 'id' => 'pm-create-submit']) !!}
          <div class="pull-right">
            <small>{!! trans('hifone.photos.drag_drop') !!}</small>
            <a href="/markdown" target="_blank"><i class="fa fa-lightbulb-o"></i> {{ trans('hifone.photos.markdown_desc') }}</a>
            </small>
          </div>
        </div>

        <div class="box preview markdown-body" id="preview-box" style="display:none;"></div>

      {!! Form::close() !!}
    </div>
    </div>
    </div>
    
  </div>

  <div class="col-md-3 side-bar">
    <div class="panel panel-default">
    <div class="panel-body">
      <a href="/pm/create" class="btn btn-success btn-block">{{ trans('hifone.pms.new_pm') }}</a>
    </div>
    <div class="panel-footer"><a href="/pm?tab=inbox">{{ trans('hifone.pms.view_inbox') }}</a></div>
    </div>

  </div>
</div>

@stop
