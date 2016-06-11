@extends('layouts.dashboard')

@section('content')
    <div class="content-panel">
        @if(isset($sub_menu))
        @include('dashboard.partials.sub-sidebar')
        @endif
        <div class="content-wrapper">
            <div class="header sub-header">
                <span class="uppercase">
                    <i class="ion ion-ios-information-outline"></i> {{ trans('dashboard.threads.threads') }}
                </span>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    @include('partials.errors')
                    <div class="striped-list">
                        @foreach($threads as $thread)
                        <div class="row striped-list-item">
                            <div class="col-xs-9">
                                <i class="{{ $thread->icon }}"></i> {{ $thread->id }}. {{ $thread->title }}
                                @if($thread->message)
                                <p><small>{{ Str::words($thread->message, 5) }}</small></p>
                                @endif
                            </div>
                            <div class="col-xs-3 text-right">
                                <a href="{{ route('dashboard.thread.edit',['id'=>$thread->id]) }}" class="btn btn-default btn-sm">{{ trans('forms.edit') }}</a>
                                <a href="{{ route('dashboard.thread.destroy',['id'=>$thread->id]) }}" class="btn btn-danger btn-sm confirm-action" data-method='delete'>{{ trans('forms.delete') }}</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                     <div class="text-right">
                    <!-- Pager -->
                    {!! $threads->appends(Request::except('page', '_pjax'))->render() !!}
                </div>
                </div>
            </div>
        </div>
    </div>
@stop
