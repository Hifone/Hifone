@extends('layouts.default')

@section('title')
{{ $page->title }} - @parent
@stop

@section('content')

    <div class="panel markdown panel-default">
        <div class="panel-body">
            {!! $page->body !!}
        </div>
    </div>

@stop