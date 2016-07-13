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
		<ul class="list-group">

   <li class="list-group-item" >

        {!! $pm->meta->body !!}

      <span class="meta">
        <a href="" title="">
		{{ $pm->user->username }}
        </a>
        <span> • </span>
        <span class="timeago">{!! $pm->created_at !!}</span>
      </span>
  </li>

</ul>

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