<div class="header">
    <nav class="navbar navbar-inverse navbar-fixed-top navbar-default">
      <div class="container">
        <div class="navbar-header" id="navbar-header">
          <a href="/" class="navbar-brand">@if(Config::get('setting.site_logo'))<img src="{{ Config::get('setting.site_logo') }}">
        @else
        {{ Config::get('setting.site_name') }}
        @endif</a>
        </div>
        <div id="main-nav-menu">
          <ul class="nav navbar-nav">
          <li {!! set_active('/') !!}><a href="{!! route('home') !!}"><i class="fa fa-home"></i> <span class="hidden-xs hidden-sm">{!! trans('hifone.home') !!}</span></a></li>
          <li {!! set_active('thread*',['hidden-sm hidden-xs']) !!}><a href="{!! route('thread.index') !!}"><i class="fa fa-comments-o"></i> {!! trans('hifone.threads.threads') !!}</a></li>
          <li {!! set_active('excellent*') !!}><a href="{!! route('excellent') !!}"><i class="fa fa-diamond"></i> <span class="hidden-xs hidden-sm">{!! trans('hifone.excellent') !!}</span></a></li>
          </ul>
        </div>
        @if(Auth::check())
        <ul class="nav user-bar navbar-nav navbar-right">
          <li {!! set_active('users*', ['dropdown']) !!}>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ $current_user->username }} <span class="caret"></span></a>
            <button class="navbar-toggle" type="button" data-toggle="dropdown" role="button" aria-expanded="false">
              <span class="sr-only">Toggle</span>
              <i class="fa fa-reorder"></i>
            </button>
            <ul class="dropdown-menu" role="menu"><li class=""><a href="{{ route('user.home', $current_user->username) }}">{{ trans('hifone.users.profile') }}</a></li>
            <li><div class='divider'></div></li>
                <li><a href="{!! route('user.edit', Auth::user()->id) !!}">{{ trans('hifone.users.edit.title') }}</a></li>
                <li><a href="{{ route('user.favorites',$current_user->id) }}">{{ trans('hifone.users.favorites') }}</a></li>
                <li><a href="{{ route('credit.index')}}">{{ trans('hifone.users.credits') }}</a></li>
                <li class='divider'></li>
                <li><a href="{!! url('auth/logout') !!}" onclick=" return confirm('{!! trans('hifone.logout_confirm') !!}')"><i class="fa fa-sign-out"></i> {!! trans('hifone.logout') !!}
                    </a></li>
            </ul>
          </li>
        </ul>
      @endif

        <ul class="nav navbar-nav navbar-right">
          <li class="nav-search hidden-xs hidden-sm">
            {!! Form::open(['method'=>'get', 'class'=>'navbar-form form-search active', 'target'=>'_blank']) !!}
              <div class="form-group">
                {!!Form::input('search','q',null,['placeholder'=>trans('hifone.search'),'class'=>'form-control'])!!}
              </div>
              <i class="fa fa-search"></i>
            {!! Form::close() !!}
          </li>
          @if(Auth::check())
            @if($current_user->hasRole(['Founder','Admin']))
                 <li>
                   <a href="/admin" data-pjax="no" title="{{ trans('hifone.dashboard') }}"><i class="fa fa-wrench"></i> <span class="hidden-xs hidden-sm">{{ trans('hifone.dashboard') }}</span></a>
                 </li>
            @endif
          <li {!! set_active('notification*', ['notification']) !!}>
            <a href="{!! route('notification.index') !!}" class="notification-count {{ $current_user->notification_count ? 'new' : null }}"><i class="fa fa-bell"></i><span class="count">{{ $current_user->notification_count ?: null }}</span></a>
          </li>
          @else
          <li {!! set_active('auth/register') !!}><a href="{!! url('auth/register') !!}" id="signup-btn">{!! trans('hifone.signup') !!}</a></li>
              <li {!! set_active('auth/login') !!}><a href="{!! url('auth/login') !!}" id="login-btn">{!! trans('hifone.login.login') !!}</a></li>
          @endif
        </ul>
      </div>
    </nav>
  </div>