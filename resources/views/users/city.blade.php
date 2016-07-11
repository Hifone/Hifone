@extends('layouts.default')

@section('title')
{{ trans('hifone.users.info') }}_@parent
@stop

@section('content')
 <div id="users" class="box">
    <div id="hot_users" class="panel panel-default user-list">
        <div class="panel-heading">{{ $location->name }} {{ trans('hifone.member') }}</div>
        <div class="panel-body row">
            @foreach($users as $user)
            <div class="user col-sm-1">
                <div class="avatar">
                    <a href="{{ route('user.home', $user->username) }}"><img class="media-object avatar-48" src="{{ $user->avatar }}"></a>
                </div>
                <div class="name"><a href="{{ route('user.home', $user->username) }}">{{ $user->username }}</a></div>
            </div>
            @endforeach
        </div>
        <div class="panel-footer clearfix">
            {!! $users->appends(Request::except('page', '_pjax'))->render() !!}
        </div>
    </div>
</div>
@stop