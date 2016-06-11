@extends('layouts.dashboard')

@section('content')
@if(isset($sub_menu))
@include('dashboard.partials.sub-sidebar')
@endif
<div class="content-wrapper">
    <div class="header sub-header" id="aboutus">
        <span class="uppercase">
            {{ trans('dashboard.settings.aboutus.aboutus') }}
        </span>
    </div>
    <div class="row">
        <div class="col-sm-12">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @include('partials.errors')
                <div class="row">
                    <div class="col-xs-12">
                        <label>Hifone</label>
                        <div id="banner-view" class="well">
                            <img src="/images/hifone-logo.png" style="max-width: 100%">
                        </div>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <label>{{ trans('dashboard.settings.aboutus.version') }}</label>
                        </div>
                        <div class="col-xs-6">
                            {{ HIFONE_VERSION }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-6">
                            <label>{{ trans('dashboard.settings.aboutus.php') }}</label>
                        </div>
                        <div class="col-xs-6">
                                {{ PHP_VERSION }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <label>{{ trans('dashboard.settings.aboutus.webserver') }}</label>
                        </div>
                        <div class="col-xs-6">
                        {{ Request::server('SERVER_SOFTWARE') }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <label>{{ trans('dashboard.settings.aboutus.db') }}</label>
                        </div>
                        <div class="col-xs-6">
                            {{ Config::get('database.default') }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <label>{{ trans('dashboard.settings.aboutus.cache') }}</label>
                        </div>
                        <div class="col-xs-6">
                            {{ Config::get('cache.default') }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <label>{{ trans('dashboard.settings.aboutus.session') }}</label>
                        </div>
                        <div class="col-xs-6">
                            {{ Config::get('session.driver') }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-6">
                            <label>{{ trans('dashboard.settings.aboutus.team') }}</label>
                        </div>
                        <div class="col-xs-6">
                            The Hifone Team
                        </div>
                    </div>
        </div>
    </div>
</div>
@stop
