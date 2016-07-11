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
    <div class="row">
        <div class="col-sm-12">
            @include('partials.errors')

            <table class="table table-bordered table-striped table-condensed">
            <tbody>
              <tr class="head">
                <td class="first">#</td>
                <td style="width:50%">{{ trans('dashboard.content.thread_title') }}</td>
                <td>{{ trans('dashboard.content.node') }}</td>
                <td>{{ trans('dashboard.content.created_by') }}</td>
                <td>{{ trans('dashboard.content.reply_count') }}</td>
                <td>{{ trans('dashboard.content.created_at') }}</td>
                <td style="width:10%">{{ trans('dashboard.content.actions') }}</td>
              </tr>
             @foreach($threads as $thread)
              <tr>
                <td>{{ $thread->id }}</td>
                <td>
                  <a target="_blank" href="{{ $thread->url }}"><i class="{{ $thread->icon }}"></i> {{ $thread->title }}</a>
                </td>
                <td>{{ $thread->node->name }}</td>
                <td><a data-name="{{ $thread->user->username }}" href="{{ $thread->author_url }}">{{ $thread->user->username }}</a></td>
                <td>{{ $thread->reply_count }}</td>
                <td>
                    {{ $thread->created_at }}
                </td>
                <td>
                    <a data-url="/dashboard/thread/{{$thread->id}}/pin" data-method="post" class="confirm-action"><i class="fa fa-thumb-tack"></i></a> 
                    <a href="/dashboard/thread/{{ $thread->id }}/edit"><i class="fa fa-pencil"></i></a> 
                    <a data-url="/dashboard/thread/{{ $thread->id }}" data-method="delete" class="confirm-action"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
            </table>

            <div class="text-right">
            <!-- Pager -->
            {!! $threads->appends(Request::except('page', '_pjax'))->render() !!}
    </div>
@stop
