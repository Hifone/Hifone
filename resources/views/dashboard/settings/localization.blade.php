@extends('layouts.dashboard')

@section('content')
@if(isset($sub_menu))
@include('dashboard.partials.sub-sidebar')
@endif
<div class="content-wrapper">
    <div class="header sub-header" id="localization">
        <span class="uppercase">
            {{ trans('dashboard.settings.localization.localization') }}
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
                                <label>{{ trans('dashboard.settings.localization.localization') }}</label>
                                <select name="site_locale" class="form-control" required>
                                    <option value="">Select Language</option>
                                    @foreach($langs as $key => $lang)
                                        <option value="{{ $key }}" @if($site_locale === $key) selected @endif>{{ $lang }}</option>
                                    @endforeach
                                </select>
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