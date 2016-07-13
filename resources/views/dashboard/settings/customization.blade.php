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
                                <label>{{ trans('dashboard.settings.general.new_thread_dropdowns') }}</label>
                                <div class='markdown-control'>
                                    <textarea name="new_thread_dropdowns" class="form-control autosize" rows="4">{!! $new_thread_dropdowns !!}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{ trans('dashboard.settings.general.footer_html') }}</label>
                                <div class='markdown-control'>
                                    <textarea name="footer_html" class="form-control autosize" rows="4">{!! $footer_html !!}</textarea>
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
