@extends('layouts.default')

@section('content')

<div class="panel panel-default list-panel">
  <div class="panel-heading">
    <h3 class="panel-title text-center">
      {{ trans('hifone.threads.excellent') }} &nbsp;
      <a href="{{ route('feed') }}" style="color: #E5974E; font-size: 14px;" target="_blank">
         <i class="fa fa-rss"></i>
      </a>
    </h3>

  </div>

  <div class="panel-body">
    @include('threads.partials.threads', ['column' => true])
  </div>

  <div class="panel-footer text-right">

  	<a href="thread?filter=excellent">
  		{{ trans('hifone.threads.more') }}...
  	</a>
  </div>
</div>

<!-- Nodes Listing -->
@include('nodes.partials.list')

@stop
