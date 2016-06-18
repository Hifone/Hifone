@extends('layouts.dashboard')

@section('content')
@if(isset($sub_menu))
@include('dashboard.partials.sub-sidebar')
@endif
<div class="content-wrapper">
    <div class="header sub-header">
        <span class="uppercase">
            <i class="ion ion-ios-information-outline"></i> {{ trans('dashboard.adblocks.adblocks') }}
        </span>
        <a class="btn btn-sm btn-success pull-right" href="{{ route('dashboard.adblock.create') }}">
            {{ trans('dashboard.adblocks.add.title') }}
        </a>
        <div class="clearfix"></div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            @include('partials.errors')
            <div class="striped-list">
                @foreach($adblocks as $adblock)
                <div class="row striped-list-item">
                    <div class="col-xs-6">
                        <a href="/dashboard/adblock/{{ $adblock->id }}">{{ $adblock->name }}</a>
                    </div>
                    <div class="col-xs-3">
                        {{ trans('dashboard.adblocks.slug') }}: {{ $adblock->slug }}
                    </div>
                    <div class="col-xs-3 text-right">
                        <a href="/dashboard/adblock/{{ $adblock->id }}/edit" class="btn btn-default btn-sm">{{ trans('forms.edit') }}</a>
                        <a data-url="/dashboard/adblock/{{ $adblock->id }}/delete" class="btn btn-danger btn-sm confirm-action" data-method='delete'>{{ trans('forms.delete') }}</a>
                    </div>
                </div>
                @endforeach
            </div>
             <div class="text-right">
            <!-- Pager -->
            {!! $adblocks->appends(Request::except('page', '_pjax'))->render() !!}
        </div>
        </div>
    </div>
</div>
@stop
