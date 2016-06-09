@extends('layouts.default')

@section('content')

<div class="col-md-9 main-col">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{ $site_name }}</h3>
        </div>
        <div class="panel-body">
            {!! $site_about !!}
        </div>
    </div>
    @foreach ($nodes['top'] as $index => $top_node)
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{ $top_node->name }}</h3>
        </div>
        <div class="panel-body">
            @if(isset($nodes['second'][$top_node->id]))
            <ul class="media-list">
                @foreach ($nodes['second'][$top_node->id] as $snode)
                <li class="media section">
                    @if($snode->icon)
                    {!! $snode->icon !!}
                    @endif
                    <span class="pull-right text-right"><p>{{ $snode->thread_count }}/主题</p><p>{{ $snode->reply_count or '0' }}/回帖</p></span>
                    <div class="media-body">
                        <h4 class="media-heading"><a href="{{ $snode->url }}">{{ $snode->name }}</a></h4>
                        <p class="text-muted">
                            {{ $snode->description }}
                        </p>
                    </div>
                </li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
    @endforeach
</div>

@include('partials.sidebar')

@stop