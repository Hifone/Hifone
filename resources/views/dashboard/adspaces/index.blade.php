@extends('layouts.dashboard')

@section('content')
@if(isset($sub_menu))
@include('dashboard.partials.sub-sidebar')
@endif
<div class="content-wrapper">
    <div class="header sub-header">
        <span class="uppercase">
            <i class="ion ion-ios-information-outline"></i> {{ trans('dashboard.adspaces.adspaces') }}
        </span>
        <a class="btn btn-sm btn-success pull-right" href="{{ route('dashboard.adspace.create') }}">
            {{ trans('dashboard.adspaces.add.title') }}
        </a>
        <div class="clearfix"></div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            @include('partials.errors')
            <div class="striped-list" id="item-list" data-item-name="adspace">
                @foreach($adspaces as $adspace)
                <div class="row striped-list-item" data-item-id="{{ $adspace->id }}">
                    <div class="col-xs-1">
                        <span class="drag-handle"><i class="fa fa-navicon"></i></span> 
                    </div>
                    <div class="col-xs-5">
                        {{ $adspace->name }}
                        @if($adspace->adblock)
                        (<small>{{ $adspace->adblock->name }}</small>)
                        @endif
                    </div>
                    <div class="col-xs-3">
                        {{ trans('dashboard.adspaces.position') }}: {{ $adspace->position }}
                    </div>
                    <div class="col-xs-3 text-right">
                        <a href="/dashboard/adspace/{{ $adspace->id }}/edit" class="btn btn-default btn-sm">{{ trans('forms.edit') }}</a>
                        <a data-url="/dashboard/adspace/{{ $adspace->id }}/delete" class="btn btn-danger btn-sm confirm-action" data-method='delete'>{{ trans('forms.delete') }}</a>
                    </div>
                </div>
                @endforeach
            </div>
             <div class="text-right">
            <!-- Pager -->
            {!! $adspaces->appends(Request::except('page', '_pjax'))->render() !!}
        </div>
        </div>
    </div>
</div>
@stop
