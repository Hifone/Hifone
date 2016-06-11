@extends('layouts.dashboard')

@section('content')
@if(isset($sub_menu))
@include('dashboard.partials.sub-sidebar')
@endif
<div class="content-wrapper">
    <div class="header sub-header" id="theme">
        <span class="uppercase">
            {{ trans('dashboard.settings.theme.theme') }}
        </span>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <form name="SettingsForm" class="form-vertical" role="form" action="/dashboard/settings" method="POST"  enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @include('partials.errors')
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label>{{ trans('dashboard.settings.general.logo') }}</label>
                            @if($site_logo)
                            <div id="logo-view" class="well">
                                <img src="{{ $site_logo }}" style="max-width: 100%">
                                <br><br>
                                <button id="remove-logo" class="btn btn-danger">{{ trans('dashboard.remove') }}</button>
                            </div>
                            <input type="hidden" name="remove_logo" value="0">
                            @endif
                            <input type="file" name="site_logo" class="form-control">
                            <span class="help-block">{{ trans('dashboard.settings.general.logo_help') }}</span>
                        </div>
                    </div>
                </div>
                <hr>
                <fieldset>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>{{ trans('dashboard.settings.theme.background-color') }}</label>
                                <input type="text" class="form-control color-code" name="style.background_color" value="{{ $theme_background_color }}">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>{{ trans('dashboard.settings.theme.text-color') }}</label>
                                <input type="text" class="form-control color-code" name="style.text_color" value="{{ $theme_text_color }}">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>{{ trans('dashboard.settings.theme.reds') }}</label>
                                <input type="text" class="form-control color-code" name="style.reds" value="{{ $theme_reds }}">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>{{ trans('dashboard.settings.theme.blues') }}</label>
                                <input type="text" class="form-control color-code" name="style.blues" value="{{ $theme_blues }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>{{ trans('dashboard.settings.theme.greens') }}</label>
                                <input type="text" class="form-control color-code" name="style.greens" value="{{ $theme_greens }}">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>{{ trans('dashboard.settings.theme.yellows') }}</label>
                                <input type="text" class="form-control color-code" name="style.yellows" value="{{ $theme_yellows }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>{{ trans('dashboard.settings.theme.oranges') }}</label>
                                <input type="text" class="form-control color-code" name="style.oranges" value="{{ $theme_oranges }}">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>{{ trans('dashboard.settings.theme.metrics') }}</label>
                                <input type="text" class="form-control color-code" name="style.metrics" value="{{ $theme_metrics }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>{{ trans('dashboard.settings.theme.links') }}</label>
                                <input type="text" class="form-control color-code" name="style.links" value="{{ $theme_links }}">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>{{ trans('dashboard.settings.theme.background-fills') }}</label>
                                <input type="text" class="form-control color-code" name="style.background_fills" value="{{ $theme_background_fills }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>{{ trans('dashboard.settings.theme.per_page') }}</label>
                                <input type="number" max="100" name="per_page" class="form-control" value="{{ Config::get('setting.per_page', 15) }}">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="checkbox">
                                <label>
                                    <input type="hidden" name="dashboard_login_link" value="0">
                                    <input type="checkbox" value="1" name="dashboard_login_link" {{ Config::get('setting.dashboard_login_link') ? 'checked' : null }}>
                                    {{ trans('dashboard.settings.theme.dashboard-login') }}
                                </label>
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
