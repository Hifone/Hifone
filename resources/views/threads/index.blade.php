@extends('layouts.default')

@section('title')
@if(Request::is('/'))
@elseif (isset($node))
{{ $node->name }}
 - @parent
@else
{{ trans('hifone.threads.list') }}
 - @parent
@endif
@stop

@section('content')

<div class="col-md-9 threads-index main-col">
    <div class="panel panel-default">

        <div class="panel-heading">
        <div class="pull-left hidden-sm hidden-xs">
          @if (Request::is('/'))
            <i class="fa fa-list"></i> {{ trans('hifone.home') }}
          @elseif (isset($node))
          <div class="node-info">
            <strong>{{ $node->name }}</strong>
            <span class="total">共有 {{ $node->thread_count }} 个讨论主题</span>
            @if($node->description)<div class="summary">{{ $node->description }}</div>@endif
          </div>
          @elseif (isset($tag))
          <div class="node-info">
          {{ trans('hifone.tags.name') }}: <strong>{{ $tag->name }}</strong>
          <span class="total">, 共有 {{ $tag->threads->count() }} 个讨论主题</span>
          </div>
          @else
          <i class="fa fa-comments-o"></i> {{ trans('hifone.threads.threads') }}
          @endif
          </div>
          @if (!isset($tag))
            @include('threads.partials.filter')
          @endif
          <div class="clearfix"></div>
        </div>

        @if ( ! $threads->isEmpty())

            <div class="panel-body remove-padding-horizontal">
                @include('threads.partials.threads', ['column' => false])
            </div>

            <div class="panel-footer text-right remove-padding-horizontal pager-footer">
                <!-- Pager -->
                {!! $threads->appends(Request::except('page', '_pjax'))->render() !!}
            </div>

        @else
            <div class="panel-body">
                <div class="empty-block">{{ trans('hifone.noitem') }}</div>
            </div>
        @endif

    </div>

    <!-- Nodes List -->
    @include('nodes.partials.list')

</div>

@include('partials.sidebar')


@stop
