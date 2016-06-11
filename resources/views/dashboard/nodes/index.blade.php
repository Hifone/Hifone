@extends('layouts.dashboard')

@section('content')
@if(isset($sub_menu))
@include('dashboard.partials.sub-sidebar')
@endif
<div class="content-wrapper">
    <div class="header sub-header">
        <span class="uppercase">
            <i class="ion ion-ios-browsers-outline"></i> {{ trans('dashboard.nodes.nodes') }}
        </span>
        <a class="btn btn-sm btn-success pull-right" href="{{ route('dashboard.node.create') }}">
            {{ trans('dashboard.nodes.add.title') }}
        </a>
        <div class="clearfix"></div>
    </div>
    @include('partials.errors')
    <div class="row">
        <div class="col-sm-12 striped-list" id="item-list" data-item-name="node">
            @forelse($nodes as $node)
            <div class="row striped-list-item" data-item-id="{{ $node->id }}">
                <div class="col-xs-1">
                    <span class="drag-handle"><i class="fa fa-navicon"></i></span>
                </div>
                <div class="col-xs-6 drag-handle">
                    {{ $node->name }}
                </div>
                <div class="col-xs-5 text-right">
                    <a href="{{ route('dashboard.node.edit',['id'=>$node->id]) }}" class="btn btn-default btn-sm">{{ trans('forms.edit') }}</a>
                    <a data-url="{{ route('dashboard.node.destroy',['id'=>$node->id]) }}" class="btn btn-danger btn-sm confirm-action" data-method="delete">{{ trans('forms.delete') }}</a>
                </div>
            </div>
            @empty
            <div class="list-group-item"><a href="{{ route('dashboard.node.create') }}">{{ trans('dashboard.nodes.add.message') }}</a></div>
            @endforelse
        </div>
    </div>
</div>
@stop
