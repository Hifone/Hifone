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
    </div>
@stop