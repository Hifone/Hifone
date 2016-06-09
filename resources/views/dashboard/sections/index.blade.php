@extends('layouts.dashboard')

@section('content')
    <div class="content-panel">
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
                <div class="col-sm-12 striped-list" id="section-list">
                    @forelse($sections as $section)
                    <div class="row striped-list-item" data-section-id="{{ $section->id }}">
                        <div class="col-xs-6">
                            <h4>
                                @if($sections->count() > 1)
                                <span class="drag-handle"><i class="fa fa-navicon"></i></span>
                                @endif
                                {{ $section->id }}. {{ $section->name }} <small>{{ $section->human_status }}</small>
                            </h4>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="/dashboard/section/{{ $section->id }}/edit" class="btn btn-default">{{ trans('forms.edit') }}</a>
                            <a href="/dashboard/section/{{ $section->id }}/delete" class="btn btn-danger confirm-action" data-method="delete">{{ trans('forms.delete') }}</a>
                        </div>
                    </div>
                    @empty
                    <div class="list-group-item"><a href="{{ route('dashboard.section.create') }}">{{ trans('dashboard.sections.add.message') }}</a></div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@stop
