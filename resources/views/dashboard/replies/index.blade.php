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
            <td style="width:60%">标题</td>
            <td>发帖人</td>
            <td>时间</td>
            <td style="width:10%">操作</td>
          </tr>
            @foreach($replies as $reply)
            <tr>
            <td>{{ $reply->id }}</td>
            <td>{{ Str::words($reply->body_original, 5) }}</td>
            <td>{{ $reply->user->username }}</td>
            <td>{{ $reply->created_at }}</td>
            <td>
                <a href="/dashboard/reply/{{ $reply->id }}/edit"><i class="fa fa-pencil"></i></a> 
                <a data-url="/dashboard/reply/{{ $reply->id }}" data-method="delete" class="confirm-action"><i class="fa fa-trash"></i></a>
            </td>
            </tr>
            @endforeach
        </tbody>
        </table>
         <div class="text-right">
        <!-- Pager -->
        {!! $replies->appends(Request::except('page', '_pjax'))->render() !!}
</div>
@stop
