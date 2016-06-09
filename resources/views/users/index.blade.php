@extends('layouts.default')

@section('title')
{{ trans('hifone.users.list') }}_@parent
@stop

@section('content')

<div class="panel panel-default users-index">

    <div class="panel-heading text-center">
        {{ trans('hifone.users.list') }} ( {{ trans('hifone.users.total') }} {{ $stats['user_count'] }} )
    </div>

    <div class="panel-body">
    @foreach ($users as $user)
        <div class="col-md-1 remove-padding-right">
            <div class="avatar">
              <a href="{{ route('user.show', $user->username) }}" class="users-index-{{ $user->id }}">
                <img src="{{ $user->avatar_small }}" class="img-thumbnail avatar"  style="width:48px;height:48px;margin-bottom: 20px;"/>
              </a>
            </div>
        </div>
    @endforeach
    </div>

</div>
@stop
