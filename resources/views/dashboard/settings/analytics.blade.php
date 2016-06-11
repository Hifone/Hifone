@extends('layouts.dashboard')

@section('content')
@if(isset($sub_menu))
@include('dashboard.partials.sub-sidebar')
@endif
<div class="content-wrapper">
    <div class="header sub-header" id="application-setup">
        <span class="uppercase">
            {{ trans('dashboard.settings.analytics.analytics') }}
        </span>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <form id="settings-form" name="SettingsForm" class="form-vertical" role="form" action="/dashboard/settings" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @include('partials.errors')
                <fieldset>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>{{ trans('dashboard.settings.analytics.analytics_code') }}</label>
                                <textarea class="form-control" name="analytics_code" rows="10" placeholder="">{!! Config::get('setting.analytics_code') !!}</textarea>
                                <div class="help-block">
                                    {{ trans('dashboard.settings.analytics.help') }}
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
@stop
