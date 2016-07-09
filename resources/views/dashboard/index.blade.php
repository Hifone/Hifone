@extends('layouts.dashboard')

@section('content')
<div class="content-wrapper">
  <div class="header sub-header">
          <div class="sidebar-toggler visible-xs">
            <i class="fa fa-navicon"></i>
          </div>
          <span class="uppercase">
              <i class="fa fa-dashboard"></i> {{ trans('dashboard.overview.title') }}
          </span>
          <div class="clearfix"></div>
  </div>
  <div class="row">
      <div class="col-md-12">
          <div class="alert alert-info hidden" id="update-alert">{!! trans('hifone.system.update') !!}</div>
      </div>
  </div>
  <div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">{{ trans('dashboard.overview.systemstate.title') }} </div>
        <div class="panel-body">
           <div class="col-sm-4">
              <h4>{{ trans('dashboard.overview.systemstate.statistics') }}</h4>
              <hr>
              <p>Sections/Nodes <span class="pull-right">{{ $section_count }}/{{ $node_count }}</span></p>
              <p>Threads<span class="pull-right">{{ $thread_count }}</span></p>
              <p>Replies<span class="pull-right">{{ $reply_count }}</span></p>
              <p>Users<span class="pull-right">{{ $user_count }}</span></p>
              <p>Photos<span class="pull-right">{{ $photo_count }}</span></p>
           </div>
           <div class="col-sm-4">
              <h4>{{ trans('dashboard.overview.systemstate.modules') }}</h4>
              <hr>
                <p>hifone<span class="pull-right">{{ HIFONE_VERSION }}</span></p>
                @foreach($components as $index => $component)
                <p>{{ $component->name }}<span class="pull-right">{{ $component->version }}</span></p>
               @endforeach
           </div>
           <div class="col-sm-4">
              <h4>{{ trans('dashboard.overview.systemstate.system') }}</h4>
              <hr>
              <p>PHP<span class="pull-right">{{ PHP_VERSION }}</span></p>
              <p>{{ trans('dashboard.settings.aboutus.webserver') }}<span class="pull-right">{{ Request::server('SERVER_SOFTWARE') }}</span></p>
              <p>{{ trans('dashboard.settings.aboutus.db') }}<span class="pull-right">{{ Config::get('database.default') }}</span></p>
              <p>{{ trans('dashboard.settings.aboutus.cache') }}<span class="pull-right">{{ Config::get('cache.default') }}</span></p>
              <p>{{ trans('dashboard.settings.aboutus.session') }}<span class="pull-right">{{ Config::get('session.driver') }}</span></p>
           </div>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">{{ trans('dashboard.overview.messages.title') }}</div>
      <div class="panel-body">
        <div class="col-sm-4">
        <h4>{{ trans('dashboard.overview.messages.newest_threads') }}</h4>
        <hr>
         @foreach($recent_threads as $index => $thread)
            <p> {{ $index+1 }}. <a href="{{ $thread->url }}"  target="_blank"> {{ $thread->title }}</a></p>
        @endforeach
        </div>
        <div class="col-sm-6">
        <h4>{{ trans('dashboard.overview.messages.newest_replies') }}</h4>
        <hr>
         @foreach($recent_replies as $index => $reply)
            <p> {{ $index+1 }}. <a href="{{ $reply->url }}"  target="_blank"><small>{{ Str::words($reply->body_original,5) }}</small></a></p>
        @endforeach
        </div>
        <div class="col-sm-2">
        <h4>{{ trans('dashboard.overview.messages.newest_users') }}</h4>
        <hr>
         @foreach($recent_users as $index => $user)
          <p>{{ $index+1 }}. <a href="{{ $user->url }}"  target="_blank"> {{ $user->username }}</a></p>
         @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@stop