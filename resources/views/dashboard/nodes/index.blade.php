@extends('layouts.dashboard')

@section('content')
    <div class="content-panel">
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
                <div class="col-sm-12 striped-list" id="node-list">
                    @forelse($nodes as $node)
                    <div class="row striped-list-item" data-node-id="{{ $node->id }}">
                        <div class="col-xs-6">
                            <h4>
                                @if($nodes->count() > 1)
                                <span class="drag-handle"><i class="fa fa-navicon"></i></span>
                                @endif
                                {{ $node->id }}. {{ $node->name }}
                            </h4>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="{{ route('dashboard.node.edit',['id'=>$node->id]) }}" class="btn btn-default">{{ trans('forms.edit') }}</a>
                            <a data-url="{{ route('dashboard.node.destroy',['id'=>$node->id]) }}" class="btn btn-danger confirm-action" data-method="delete">{{ trans('forms.delete') }}</a>
                        </div>
                    </div>
                    @empty
                    <div class="list-group-item"><a href="{{ route('dashboard.node.create') }}">{{ trans('dashboard.nodes.add.message') }}</a></div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@stop
