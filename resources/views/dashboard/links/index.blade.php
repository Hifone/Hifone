@extends('layouts.dashboard')

@section('content')
    <div class="header fixed">
        <div class="sidebar-toggler visible-xs">
            <i class="fa fa-navicon"></i>
        </div>
        <span class="uppercase">
            <i class="fa fa-link"></i> {{ trans('dashboard.links.links') }}
        </span>
        <a class="btn btn-sm btn-success pull-right" href="{{ route('dashboard.link.create') }}">
            {{ trans('dashboard.links.add.title') }}
        </a>
        <div class="clearfix"></div>
    </div>
    <div class="content-wrapper header-fixed">
        <div class="row">
            <div class="col-sm-12">
                @include('partials.errors')
                <div class="striped-list" id="link-list">
                    @forelse($links as $link)
                    <div class="row striped-list-item" data-link-id="{{ $link->id }}">
                        <div class="col-md-6">
                            <span class="drag-handle"><i class="fa fa-navicon"></i></span> <i class="{{ $link->icon }}"></i> <strong>{{ $link->title }}</strong>
                            @if($link->description)
                            <p><small>{{ Str::words($link->description, 5) }}</small></p>
                            @endif
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('dashboard.link.edit',['id'=>$link->id]) }}" class="btn btn-default">{{ trans('forms.edit') }}</a>
                            <a href="{{ route('dashboard.link.destroy',['id'=>$link->id]) }}" class="btn btn-danger confirm-action" data-method='delete'>{{ trans('forms.delete') }}</a>
                        </div>
                    </div>
                    @empty
                    <div class="list-group-item text-danger">{{ trans('dashboard.links.add.message') }}</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@stop