@extends('layouts.default')

@section('title')
编辑个人资料_@parent
@stop

@section('content')

<div class="users-show">

  <div class="col-md-3 box">
    @include('users.partials.basicinfo')
  </div>

  <div class="col-md-9 left-col">

    <div class="panel panel-default">

      <div class="panel-body ">
        <ul class="nav nav-tabs" role="tablist">
          <li @if(!$tab) class="active" @endif><a href="{{ route('user.edit',['id'=>$user->id]) }}">个人信息</a></li>
          <li @if($tab=='avatar') class="active" @endif><a href="{{ route('user.edit',['id'=>$user->id,'tab'=>'avatar']) }}">头像更新</a></li>
          <li @if($tab=='password') class="active" @endif><a href="{{ route('user.edit',['id'=>$user->id,'tab'=>'password']) }}">密码设置</a></li>
        </ul>
        @if($tab == 'avatar')
        <form class="form-horizontal" method="post" action="/settings/update-avatar" enctype="multipart/form-data" id="avatar-form">
                {{ csrf_field() }}
                <h5><i class="fa fa-image"></i>&nbsp;&nbsp;头像设置</h5><hr>
                <div class="form-group">
                    <div class="col-sm-4 avatar-setting-container">
                       <img src="{{Auth::user()->avatar}}" id="avatar" class="upload-btn" style="cursor: pointer;">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 status-post-submit">
                    <button type="button" class="btn btn-primary upload-btn">
                        上传新头像
                    </button>
                    <span class="loading"></span>
                    <input type="file" id="avatarinput" name="avatar" class="hide">
                    <span class="help-block">
                        头像支持jpg和png格式，上传的文件大小不超过 2M</span>
                    <button type="submit" class="btn btn-primary hidden" id="avatarinput-submit">更新</button>
                    </div>
                </div>
        </form>
        @elseif($tab == 'password')
        <form class="form-horizontal" method="post" action="/settings/resetPassword" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <h5><i class="fa fa-wrench"></i>&nbsp;&nbsp;密码设置</h5><hr>
            <div class="form-group">
                <div class="col-sm-4">
                <input type="password" name="old_password" placeholder="请输入您当前的密码" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4">
                <input type="password" name="password" placeholder="请输入新密码" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4">
                <input type="password" name="password_confirmation" placeholder="请再次输入新密码" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4 status-post-submit">
                <button type="submit" class="btn btn-primary" id="update-password">更  新</button>
                </div>
            </div>
      </form>
      @else
      {!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'patch']) !!}
          <h5><i class="fa fa-tasks"></i>&nbsp;&nbsp;个人信息</h5>
          <div class="form-group">
            {!! Form::text('nickname', null, ['class' => 'form-control', 'placeholder' => trans('hifone.users.nickname')]) !!}
          </div>
          <div class="form-group">
            {!! Form::text('location', null, ['class' => 'form-control', 'placeholder' => trans('hifone.users.location')]) !!}
            <div class="help-block">{{ trans('hifone.users.location_help') }}</div>
          </div>
          <div class="form-group">
            {!! Form::text('company', null, ['class' => 'form-control', 'placeholder' => trans('hifone.users.company')]) !!}
          </div>
          <div class="form-group">
            {!! Form::text('website', null, ['class' => 'form-control', 'placeholder' => trans('hifone.users.website')]) !!}
          </div>
          <div class="form-group">
            {!! Form::textarea('signature', null, ['class' => 'form-control',
                                              'rows' => 3,
                                              'placeholder' => trans('hifone.users.signature')]) !!}
          </div>
          <div class="form-group">
            {!! Form::textarea('bio', null, ['class' => 'form-control',
                                              'rows' => 3,
                                              'placeholder' => trans('hifone.users.bio')]) !!}
          </div>
          <div class="form-group">
              <label>{{ trans('hifone.users.locale') }}</label>
              <select name="locale" class="form-control" required>
                  <option value="">Select Language</option>
                  @foreach($langs as $key => $lang)
                      <option value="{{ $key }}" {{ $user->locale == $key ? "selected" : null }}>{{ $lang }}</option>
                  @endforeach
              </select>
          </div>
          <div class="form-group status-post-submit">
            {!! Form::submit(trans('forms.update'), ['class' => 'btn btn-primary', 'id' => 'user-edit-submit']) !!}
          </div>
        {!! Form::close() !!}
      @endif
      </div>
    </div>
  </div>


</div>

@stop
