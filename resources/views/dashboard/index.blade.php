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
        <div class="row">
            <div class="panel panel-default">
                    <div class="panel-heading">
                        <p>Welcome to Hifone! We've assembled some links to get your started:</p>
                    </div>
                    <div class="panel-body">
                       <div class="col-sm-4">
                           <h4>Get Stared</h4>
                           <hr>
                           <p><a href="/dashboard/settings/general" class="btn btn-info">Customize Your Site</a></p>
                           <p>or, change your theme completely.</p>
                       </div>
                       <div class="col-sm-4">
                           <h4>Next Steps</h4>
                           <hr>
                           <p><i class="fa fa-sitemap"></i> <a href="/dashboard/node">Node manage</a></p>
                           <p><i class="fa fa-plus"></i> <a href="/dashboard/page/create">Add an About page</a></p>
                           <p><i class="fa fa-desktop"></i> <a href="/">View your site</a>
                       </div>
                       <div class="col-sm-4">
                           <h4>More Actions</h4>
                           <hr>
                           <p><i class="fa fa-tint"></i> <a href="/dashboard/tip">Tip manage</a></p>
                           <p><i class="fa fa-audio-description"></i> <a href="/dashboard/advertisement">Advertisement manage</a></p>
                           <p><i class="fa fa-link"></i> <a href="/dashboard/link">Friend links</a></p>
                       </div>
                    </div>
            </div>
        </div>
        <h4 class="sub-header">最新动态</h4>
        <div class="row">
            <div class="col-sm-4">
                <div class="panel panel-default corner-radius">
                    <div class="panel-heading">最新话题</div>
                    <ul class="list-group">
                           @foreach($recent_threads as $index => $thread)
                           <li class="list-group-item"> {{ $index+1 }}. <a href="{{ $thread->url }}"  target="_blank"> {{ $thread->title }}</a></li>
                           @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-sm-6">
               <div class="panel panel-default corner-radius">
                    <div class="panel-heading">最新回帖</div>
                    <ul class="list-group">
                           @foreach($recent_replies as $index => $reply)
                           <li class="list-group-item"> {{ $index+1 }}. <a href="{{ $reply->url }}"  target="_blank"><small>{{ Str::words($reply->body_original,5) }}</small></a></li>
                           @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-sm-2">
                 <div class="panel panel-default corner-radius">
                    <div class="panel-heading">新进用户</div>
                    <ul class="list-group">
                           @foreach($recent_users as $index => $user)
                           <li class="list-group-item"> {{ $index+1 }}. <a href="{{ $user->url }}"  target="_blank"> {{ $user->username }}</a></li>
                           @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop