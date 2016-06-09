@extends('layouts.dashboard')

@section('content')
    <div class="header">
        <div class="sidebar-toggler visible-xs">
            <i class="fa fa-navicon"></i>
        </div>
        <span class="uppercase">
            <i class="fa fa-dashboard"></i> {{ trans('dashboard.dashboard') }}
        </span>
    </div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info hidden" id="update-alert">{!! trans('cachet.system.update') !!}</div>
            </div>
        </div>
        <h4 class="sub-header">最新动态</h4>
        <div class="row">
        <div class="col-sm-12 col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">最新话题</div>
                <div class="panel-body">
                    <ol>
                   @foreach($recent_threads as $thread)
                   <li><a href="{{ $thread->url }}"  target="_blank"> {{ $thread->title }}</a></li>
                   @endforeach
                   </ol>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">新进会员</div>
                <div class="panel-body">
                    <ol>
                   @foreach($recent_users as $user)
                   <li><a href="{{ $user->url }}" target="_blank"> {{ Str::words($user->username, 5) }}</a></li>
                   @endforeach
                   </ol>
                </div>
            </div>
        </div>
        </div>
        <h4 class="sub-header">统计图表</h4>
        <div class="row">
            <div class="col-sm-12 col-lg-6">
                <div class="stats-widget">
                    <div class="stats-top">
                        <span class="stats-value"><a href="{{ route('dashboard.thread.index') }}">{{ $threads->map(function($thread) { return count($thread); })->sum() }}</a></span>
                        <span class="stats-label">{{ trans('dashboard.threads.threads') }}</span>
                    </div>
                    <div class="stats-chart">
                        <div class="sparkline" data-type="line" data-resize="true" data-height="80" data-width="100%" data-line-width="2" data-min-spot-color="#e65100" data-max-spot-color="#ffb300" data-line-color="#3498db" data-spot-color="#00838f" data-fill-color="#3498db" data-highlight-line-color="#00acc1" data-highlight-spot-color="#ff8a65" data-spot-radius="false" data-data="[{{ $threads->map(function ($thread) { return count($thread); } )->implode(',') }}]"></div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-lg-6">
                <div class="stats-widget">
                    <div class="stats-top">
                        <span class="stats-value"><a href="{{ route('dashboard.user.index') }}">{{ $users->map(function($users) { return count($users); })->sum() }}</a></span>
                        <span class="stats-label">{{ trans('hifone.users.users') }}</span>
                    </div>
                    <div class="stats-chart">
                        <div class="sparkline" data-type="line" data-resize="true" data-height="80" data-width="100%" data-line-width="2" data-min-spot-color="#e65100" data-max-spot-color="#ffb300" data-line-color="#3498db" data-spot-color="#00838f" data-fill-color="#3498db" data-highlight-line-color="#00acc1" data-highlight-spot-color="#ff8a65" data-spot-radius="false" data-data="[{{ $users->map(function ($user) { return count($user); } )->implode(',') }}]"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop