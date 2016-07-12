@extends('layouts.default')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ trans('hifone.login.oauth.landing.title') }}</div>
                    <div class="panel-body">
                    <div class="row">
                        <div class="panel-body">{{ $connect_data['nickname'] }} {{ trans('hifone.login.oauth.landing.welcome') }}</div>
                    </div>
                        <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">1. {{ trans('hifone.login.oauth.landing.choice_1') }}</div>
                        <div class="panel-body text-center">
                            <a href="/auth/login" class="btn btn-success btn-lg">{{ trans('hifone.login.login') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">2. 还没有Hifone账号</div>
                        <div class="panel-body text-center">
                            <a data-url="/auth/register" class="btn btn-info btn-lg" data-method='post'>自动注册</a>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                <div class="panel-footer">
                    <i class="fa fa-user"></i> 以上两种方式都会自动将Gitlab账号: {{ $connect_data['nickname'] }} 与你的Hifone账号进行绑定。
                </div>
            </div>
                    </div>
                </div>
            </div>
            
            </div>
        </div>
    </div>
</div>
@endsection
