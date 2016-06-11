@extends('layouts.dashboard')

@section('content')
@if(isset($sub_menu))
@include('dashboard.partials.sub-sidebar')
@endif
<div class="content-wrapper">
    <div class="header sub-header">
        <span class="uppercase">
            <i class="ion ion-ios-information-outline"></i> {{ trans('dashboard.locations.locations') }}
        </span>
        <a class="btn btn-sm btn-success pull-right" href="{{ route('dashboard.location.create') }}">
            {{ trans('dashboard.locations.add.title') }}
        </a>
        <div class="clearfix"></div>
    </div>
    <div class="row">
    <div class="col-sm-12">
        @include('partials.errors')
        <div class="striped-list" id="item-list" data-item-name="location">
            @forelse($locations as $location)
            <div class="row striped-list-item" data-item-id="{{ $location->id }}">
                <div class="col-md-1">
                    <i class="fa fa-navicon drag-handle"></i>
                </div>
                <div class="col-md-7">
                    {{$location->name}}
                </div>
                <div class="col-md-4 text-right">
                    <a href="{{ route('dashboard.location.edit',['id'=>$location->id]) }}" class="btn btn-default btn-sm">{{ trans('forms.edit') }}</a>
                    <a data-url="{{ route('dashboard.location.destroy',['id'=>$location->id]) }}" class="btn btn-danger btn-sm confirm-action" data-method='delete'>{{ trans('forms.delete') }}</a>
                </div>
            </div>
            @empty
            <div class="list-group-item text-danger">{{ trans('dashboard.locations.add.message') }}</div>
            @endforelse
        </div>
        <div class="text-right">
            <!-- Pager -->
            {!! $locations->appends(Request::except('page', '_pjax'))->render() !!}
        </div>
    </div>
</div>
@stop