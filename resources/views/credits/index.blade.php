@extends('layouts.default')

@section('title')
{!! trans('hifone.credits.mine') !!} @parent
@stop

@section('content')

<div class="panel panel-default">

    <div class="panel-heading">
      {!! trans('hifone.credits.mine') !!}
    </div>
    <div class="panel-body">
      <table class="table table-bordered table-striped">
        <tbody>
          <tr>
            <th>#</th>
            <th>{{ trans('hifone.credits.time') }}</th>
            <th>{{ trans('hifone.credits.type') }}</th>
            <th>{{ trans('hifone.credits.reward') }}</th>
            <th>{{ trans('hifone.credits.balance') }}</th>
          </tr>
          @foreach ($credits as $index => $credit)
          <tr>
            <td>{{ $credit->id }}</td>
            <td class="timeago">{{ $credit->created_at }}</td>
             <td>{{ $credit->rule->name }}</td>
            <td>{{ $credit->rule->reward }}</td>
            <td>{{ $credit->balance }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
</div>
@stop