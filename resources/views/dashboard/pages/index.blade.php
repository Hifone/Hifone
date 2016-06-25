@extends('layouts.dashboard')

@section('content')
<div class="content-wrapper">
    <div class="header sub-header">
        <span class="uppercase">
            <i class="fa fa-file-text-o"></i> {{ trans('dashboard.content.content') }}
        </span>
        <div class="clearfix"></div>
    </div>
    @if(isset($sub_menu))
    @include('dashboard.partials.sub-nav')
    @endif
    <div class="toolbar">
        <a class="btn btn-default" href="{{ route('dashboard.page.create') }}">{{ trans('dashboard.pages.add.title') }}</a>
    </div>
    <div class="row">
        <div class="col-sm-12">
            @include('partials.errors')
            <div class="striped-list">
                @foreach($pages as $page)
                <div class="row striped-list-item">
                    <div class="col-xs-9">
                        <i class="{{ $page->icon }}"></i> {{ $page->id }}. <a href="{{ route('page',['slug' => $page->slug]) }}" target="_blank">{{ $page->title }}</a>
                        @if($page->body)
                        <p><small>{{ Str::words(strip_tags($page->body), 5) }}</small></p>
                        @endif
                    </div>
                    <div class="col-xs-3 text-right">
                        <a href="/dashboard/page/{{ $page->id }}/edit" class="btn btn-default">{{ trans('forms.edit') }}</a>
                        <a data-url="/dashboard/page/{{ $page->id }}" class="btn btn-danger confirm-action" data-method='delete'>{{ trans('forms.delete') }}</a>
                    </div>
                </div>
                @endforeach
            </div>
             <div class="text-right">
            <!-- Pager -->
            {!! $pages->appends(Request::except('page', '_pjax'))->render() !!}
        </div>
    </div>
</div>
@stop
