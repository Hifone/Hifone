@extends('layouts.dashboard')

@section('content')
    @if(isset($sub_menu))
    @include('dashboard.partials.sub-sidebar')
    @endif
    <div class="content-wrapper">
        <div class="header sub-header">
            <span class="uppercase">
                <i class="ion ion-ios-information-outline"></i> {{ trans('dashboard.tips.tips') }}
            </span>
            <a class="btn btn-sm btn-success pull-right" href="{{ route('dashboard.tip.create') }}">
                {{ trans('dashboard.tips.add.title') }}
            </a>
            <div class="clearfix"></div>
        </div>
        <div class="row">
        <div class="col-sm-12">
            @include('partials.errors')
            <div class="striped-list" id="tip-list">
                @forelse($tips as $tip)
                <div class="row striped-list-item" data-tip-id="{{ $tip->id }}">
                    <div class="col-md-8">
                        <i class="fa fa-tint {{ $tip->status_color }}"></i> 
                        @if($tip->body)
                        <small>{{ $tip->id }}. {!! Str::words($tip->body, 8) !!}</small>
                        @endif
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="{{ route('dashboard.tip.edit',['id'=>$tip->id]) }}" class="btn btn-default btn-sm">{{ trans('forms.edit') }}</a>
                        <a data-url="{{ route('dashboard.tip.destroy',['id'=>$tip->id]) }}" class="btn btn-danger btn-sm confirm-action" data-method='delete'>{{ trans('forms.delete') }}</a>
                    </div>
                </div>
                @empty
                <div class="list-group-item text-danger">{{ trans('dashboard.tips.add.message') }}</div>
                @endforelse
            </div>
            <div class="text-right">
                <!-- Pager -->
                {!! $tips->appends(Request::except('page', '_pjax'))->render() !!}
            </div>
        </div>
    </div>
@stop