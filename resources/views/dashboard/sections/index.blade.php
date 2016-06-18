@extends('layouts.dashboard')

@section('content')
@if(isset($sub_menu))
@include('dashboard.partials.sub-sidebar')
@endif
<div class="content-wrapper">
    <div class="header sub-header">
        <span class="uppercase">
            <i class="ion ion-ios-browsers-outline"></i> {{ trans('dashboard.sections.sections') }}
        </span>
        <a class="btn btn-sm btn-success pull-right" href="{{ route('dashboard.section.create') }}">
            {{ trans('dashboard.sections.add.title') }}
        </a>
        <div class="clearfix"></div>
    </div>
    @include('partials.errors')
    <div class="row">
        <div class="col-sm-12 striped-list" id="item-list" data-item-name="section">
            @forelse($sections as $section)
            <div class="row striped-list-item" data-item-id="{{ $section->id }}">
                <div class="col-xs-1">
                    @if($sections->count() > 1)
                    <span class="drag-handle"><i class="fa fa-navicon"></i></span>
                    @endif
                </div>
                <div class="col-xs-6">
                    <a href="/dashboard/section/{{ $section->id }}">{{ $section->name }}</a>
                </div>
                <div class="col-xs-5 text-right">
                    <a href="/dashboard/section/{{ $section->id }}/edit" class="btn btn-default btn-sm">{{ trans('forms.edit') }}</a>
                    <a data-url="/dashboard/section/{{ $section->id }}/delete" class="btn btn-danger btn-sm confirm-action" data-method="delete">{{ trans('forms.delete') }}</a>
                </div>
            </div>
            @empty
            <div class="list-group-item"><a href="{{ route('dashboard.section.create') }}">{{ trans('dashboard.sections.add.message') }}</a></div>
            @endforelse
        </div>
    </div>
</div>
@stop
