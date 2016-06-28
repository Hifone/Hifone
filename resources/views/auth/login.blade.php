@extends('layouts.default')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-5 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('hifone.login.login') }}</div>
				<div class="panel-body">
					@if($connect_data)
					<div class="alert alert-info">
						登录成功后，即可自动与你的账号 {{  $connect_data['nickname'] }} 进行关联。
					</div>
					@endif
					<form role="form" method="POST" action="/auth/login">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						@if(Session::has('error'))
            				<p class="alert alert-danger">{{ Session::get('error') }}</p>
            			@endif
						<div class="form-group">
							<input type="login" class="form-control" name="login" value="{{ Input::old('login') }}" placeholder="{{ trans('hifone.login.login_placeholder') }}">
						</div>

						<div class="form-group">
							<input type="password" class="form-control" name="password" placeholder="{{ trans('hifone.login.password') }}">
						</div>
						@if(!$captcha_login_disabled)
							@include('partials.captcha')
						@endif
						<div class="form-group checkbox">
							<label for="remember_me">
								<input type="checkbox" name="remember">{{ trans('hifone.login.remember') }}
							</label>
						</div>
						<div class="form-group">
							<input type="submit" name="commit" value="{{ trans('forms.login') }}" class="btn btn-primary btn-lg btn-block">
						</div>
					</form>
				</div>
				<div class="panel-footer">
					<a href="/auth/register">{{ trans('forms.register') }}</a>
					<!--<a href="/password/email">忘记密码?</a>-->
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">用其他平台的帐号登录</div>
				<ul class="list-group">
					<li class="list-group-item">
						@foreach($providers as $provider)
						<a href="/auth/{{ $provider->slug }}" class="btn btn-default btn-lg btn-block"><i class="{{ $provider->icon ? $provider->icon : 'fa fa-user' }}"></i> {{ $provider->name }}</a>
						@endforeach
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
@endsection
