@extends('layouts.dashboard')

@section('content')
    <div class="content-panel">
        @if(isset($sub_menu))
        @include('dashboard.partials.sub-sidebar')
        @endif
        <div class="content-wrapper">
            <div class="header sub-header">
                <span class="uppercase">
                    <i class="ion ion-ios-information-outline"></i> {{ trans('dashboard.replies.replies') }}
                </span>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    @include('partials.errors')
                    <div class="striped-list">
                        <div class="row striped-list-item">
                            <div class="col-xs-1">#</div>
                            <div class="col-xs-5">回帖内容</div>
                            <div class="col-xs-1">话题</div>
                            <div class="col-xs-1">回复人</div>
                            <div class="col-xs-2">时间</div>
                            <div class="col-xs-2 text-right">操作</div>
                        </div>
                        @foreach($replies as $reply)
                        <div class="row striped-list-item">
                            <div class="col-xs-1">
                                {{ $reply->id }}
                            </div>
                            <div class="col-xs-5">
                                @if($reply->body)
                                <small>{{ Str::words($reply->body_original, 5) }}</small>
                                @endif
                            </div>
                            <div class="col-xs-1">
                                <a title="{{ $reply->thread->title }}" href="{{ route('thread.show', $reply->thread_id) }}">{{ $reply->thread_id }}</a>
                            </div>
                            <div class="col-xs-1"><small><a href="{{ $reply->author_url }}">{{ $reply->user->username }}</a></small></div>
                            <div class="col-xs-2"><small>{{ $reply->created_at }}</small></div>
                            <div class="col-xs-2 text-right">
                                <a href="/dashboard/reply/{{ $reply->id }}/edit" class="btn btn-default btn-sm">{{ trans('forms.edit') }}</a>
                                <a href="/dashboard/reply/{{ $reply->id }}/delete" class="btn btn-danger confirm-action btn-sm" data-method='delete'>{{ trans('forms.delete') }}</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                     <div class="text-right">
                    <!-- Pager -->
                    {!! $replies->appends(Request::except('page', '_pjax'))->render() !!}
                </div>
                </div>
            </div>
        </div>
    </div>
@stop
