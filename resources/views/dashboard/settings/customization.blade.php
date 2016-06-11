@extends('layouts.dashboard')

@section('content')
@if(isset($sub_menu))
@include('dashboard.partials.sub-sidebar')
@endif
<div class="content-wrapper">
    <div class="header sub-header" id="application-setup">
        <span class="uppercase">
            {{ trans('dashboard.settings.customization.customization') }}
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
                                <label>{{ trans('dashboard.settings.customization.controller') }}</label>
                                <input name="home_controller" class="form-control" value="{{ Config::get('setting.home_controller','PagesController') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>{{ trans('dashboard.settings.customization.method') }}</label>
                                <input name="home_method" class="form-control" value="{{ Config::get('setting.home_method','excellent') }}" />
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
