@extends('layouts.default')

@section('title')
    {{ trans('hifone.pms.list') }}
    - @parent
@stop

@section('content')

    <div class="col-md-9 threads-index main-col">
        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="pull-left hidden-sm hidden-xs">
                    <i class="fa fa-list"></i> {{ trans('hifone.pms.home') }}
                </div>
                <div class="clearfix"></div>
            </div>

            @if ($threads->count() > 0)

                <div class="panel-body remove-padding-horizontal">
                    @include('pms.partials.messages', ['column' => false])
                </div>

                <div class="panel-footer text-right remove-padding-horizontal pager-footer">
                    <!-- Pager -->
                    {{-- }}{!! $threads->appends(Request::except('page', '_pjax'))->render() !!} --}}
                </div>

            @else
                <div class="panel-body">
                    <div class="empty-block">{{ trans('hifone.noitem') }}</div>
                </div>
            @endif

        </div>

    </div>

    @include('partials.sidebar')


@stop
