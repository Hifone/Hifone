@extends('layouts.default')
@section('title')
	{{ trans('hifone.errors.403.title') }}_@parent
@stop

@section('content')
	<div class="panel panel-default users-index">
		<div class="panel-heading text-center">
			<h1>{{ trans('hifone.errors.403.title') }}</h1>
		</div>
		<div class="panel-body">
			{{ trans('hifone.errors.403.desc') }}
		</div>
	</div>
@stop