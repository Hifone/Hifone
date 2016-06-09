@extends('layouts.dashboard')

@section('content')
    <div class="content-panel">
        @if(isset($sub_menu))
        @include('dashboard.partials.sub-sidebar')
        @endif
        <div class="content-wrapper">
            <div class="header sub-header" id="security">
                <span class="uppercase">
                    {{ trans('dashboard.settings.security.security') }}
                </span>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <form name="SettingsForm" class="form-vertical" role="form" action="/dashboard/settings" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @include('partials.errors')
                        <fieldset>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="hidden" name="allowed_captcha" value="0">
                                            <input type="checkbox" value="1" name="allowed_captcha" {{ Config::get('setting.allowed_captcha') ? 'checked' : null }}>
                                            {{ trans('dashboard.settings.security.allowed_captcha') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>{{ trans('dashboard.settings.security.allowed-domains') }}</label>
                                        <textarea class="form-control" name="allowed_domains" rows="5" placeholder="http://hifone.com, http://hifone.herokuapp.com">{{ Config::get('setting.allowed_domains') }}</textarea>
                                        <div class="help-block">
                                            {{ trans('dashboard.settings.security.allowed-domains-help') }}
                                        </div>
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
    </div>
@stop
