@extends('layouts.dashboard')

@section('content')
@if(isset($sub_menu))
@include('dashboard.partials.sub-sidebar')
@endif
<div class="content-wrapper">
    <div class="header sub-header" id="general">
        <span class="uppercase">
            {{ trans('dashboard.settings.general.general') }}
        </span>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <form id="settings-form" name="SettingsForm" class="form-vertical" role="form" action="/dashboard/settings" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @include('partials.errors')
                <fieldset>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>{{ trans('dashboard.settings.general.site_name') }}</label>
                                <input type="text" class="form-control" name="site_name" value="{{ $site_name }}" required />
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>{{ trans('dashboard.settings.general.site_domain') }}</label>
                                <input type="text" class="form-control" name="site_domain" value="{{ $site_domain }}" required />
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>{{ trans('dashboard.settings.general.site_logo') }}</label>
                                <input type="text" class="form-control" name="site_logo" value="{{ $site_logo }}" required />
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>{{ trans('dashboard.settings.general.site_cdn') }}</label>
                                <input type="text" class="form-control" name="site_cdn" value="{{ $site_cdn }}" />
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>{{ trans('dashboard.settings.general.site_about') }}</label>
                                <div class='markdown-control'>
                                    <textarea name="site_about" class="form-control autosize" rows="4">{{ $raw_site_about }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>{{ trans('dashboard.settings.general.site_captcha_reg_disabled') }}</label>
                                <input type="text" class="form-control" name="site_captcha_reg_disabled" value="{{ $site_captcha_reg_disabled }}" placeholder="1 or 0">
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>{{ trans('dashboard.settings.general.site_captcha_login_disabled') }}</label>
                                <input type="text" class="form-control" name="site_captcha_login_disabled" value="{{ $site_captcha_login_disabled }}" placeholder="1 or 0">
                            </div>
                        </div>
                    </div>
                </fieldset>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">{{ trans('forms.save') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
