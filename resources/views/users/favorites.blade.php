@extends('layouts.default')

@section('title')
{{{ $user->username }}} {{ trans('hifone.favorites.favorites') }}_@parent
@stop

@section('content')


<div class="users-show">

  <div class="col-md-3 box">
    @include('users.partials.basicinfo')
  </div>

<div class="col-md-9 left-col">


  <div class="panel panel-default">

    <div class="panel-body">
      @include('users.partials.infonav')
      @if (count($threads))
	      @include('users.partials.threads')
	      <div class="pull-right add-padding-vertically"> {{ $threads->render() }} </div>
      @else
        <div class="empty-block">{{ trans('hifone.favorites.noitem') }}</div>
      @endif

    </div>

  </div>
  </div>
</div>

@stop
