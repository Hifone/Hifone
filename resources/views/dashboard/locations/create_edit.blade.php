@extends('layouts.dashboard')

@section('content')
@if(isset($sub_menu))
@include('dashboard.partials.sub-sidebar')
@endif
<div class="content-wrapper">
    <div class="header sub-header">
        <span class="uppercase">
            <i class="fa fa-tint"></i> {{ trans('dashboard.locations.locations') }}
        </span>
        <small>{{ trans(isset($location) ? 'dashboard.locations.edit.title': 'dashboard.locations.add.title') }}</small>
        <div class="clearfix"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('partials.errors')
            @if(isset($location))
                {!! Form::model($location, ['route' => ['dashboard.location.update', $location->id], 'id' => 'location-edit-form', 'method' => 'patch']) !!}
                <input type="hidden" name="id" value={{$location->id}}>
            @else
                {!! Form::open(['route' => 'dashboard.location.store','id' => 'location-create-form', 'method' => 'post']) !!}
            @endif
                <fieldset>
                    <div class="form-group">
                        <label for="location-name">{{ trans('dashboard.locations.name') }}</label>
                        <input type="text" class="form-control" name="location[name]" id="location-name" required value="{{ isset($location) ? $location->name : null }}">
                    </div>
                </fieldset>
                <div class='form-group'>
                    <div class='btn-group'>
                        <button type="submit" class="btn btn-success">{{ trans('forms.save') }}</button>
                        <a class="btn btn-default" href="{{ route('dashboard.location.index') }}">{{ trans('forms.cancel') }}</a>
                    </div>
                </div>
            </form>
    </div>
</div>
@stop