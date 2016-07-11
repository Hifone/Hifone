<div class="sidebar">
    <div class="sidebar-inner">
        <div class="profile">
            <a href="{{ url('dashboard/user') }}">
                <span class="avatar"><img src="{{ $current_user->avatar }}"></span>
            </a>
            <a href="{{ url('dashboard/user') }}">
                <h4 class="username">{{ $current_user->username }}</h4>
            </a>
        </div>
        <div class="clearfix"></div>
        <hr />
        <ul>
            <li {!! set_active('dashboard') !!}>
                <a href="{{ route('dashboard.index') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>{{ trans('dashboard.overview.title') }}</span>
                </a>
            </li>
            <li {!! set_active('dashboard/thread*') !!} {!! set_active('dashboard/reply*') !!} {!! set_active('dashboard/page*') !!} {!! set_active('dashboard/photo*') !!}>
                <a href="{{ route('dashboard.thread.index') }}">
                    <i class="fa fa-comments-o"></i>
                    <span>{{ trans('dashboard.content.content') }}</span>
                </a>
            </li>
            <li {!! set_active('dashboard/node*') !!} {!! set_active('dashboard/section*') !!}>
                <a href="{{ route('dashboard.node.index') }}">
                    <i class="fa fa-sitemap"></i>
                    <span>{{ trans('dashboard.nodes.nodes') }}</span>
                </a>
            </li>
            <li {!! set_active('dashboard/adspace*') !!} {!! set_active('dashboard/advertisement*') !!} {!! set_active('dashboard/adblock*') !!}>
                <a href="{{ route('dashboard.advertisement.index') }}">
                    <i class="fa fa-audio-description"></i>
                    <span>{{ trans('dashboard.advertisements.advertisements') }}</span>
                </a>
            </li>
            <li {!! set_active('dashboard/user*') !!}>
                <a href="{{ route('dashboard.user.index') }}">
                    <i class="fa fa-user"></i>
                    <span>{{ trans('dashboard.users.users') }}</span>
                </a>
            </li>
            <li {!! set_active('dashboard/settings*') !!}>
                <a href="{{ route('dashboard.settings.general') }}">
                    <i class="fa fa-gears"></i>
                    <span>
                        {{ trans('dashboard.settings.settings') }}
                    </span>
                </a>
            </li>
        </ul>
        <div class="bottom-menu-sidebar">
            <ul>
                <li data-toggle="tooltip" data-placement="top" title="{{ trans('dashboard.help') }}">
                    <a href="https://docs.hifone.com" target="_blank"><i class="fa fa-question"></i></a>
                </li>
                <li data-toggle="tooltip" data-placement="top" title="{{ trans('dashboard.home') }}">
                    <a href="{{ url('/') }}" data-pjax="no"><i class="fa fa-desktop"></i></a>
                </li>
                <li data-toggle="tooltip" data-placement="top" title="{{ trans('dashboard.logout') }}">
                    <a href="{!! url('auth/logout') !!}"><i class="fa fa-sign-out"></i></a>
                </li>
            </ul>
        </div>
    </div>
</div>