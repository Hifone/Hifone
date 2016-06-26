@extends('layouts.default')

@section('title')
{!! trans('hifone.notifications.my') !!} @parent
@stop

@section('content')

<div class="panel panel-default">

    <div class="panel-heading clearfix">
      {!! trans('hifone.notifications.my') !!}
      <span class="pull-right">
          <a class="btn btn-sm btn-danger" rel="nofollow" data-method="post" data-url="/notification/clean">{{ trans('forms.clean') }}</a>
      </span>
    </div>

    @if (count($notifications))
	<div class="panel-body remove-padding-horizontal notification-index">

		<ul class="list-group row">
			@foreach ($notifications as $notification)
				@include('notifications.partials.' . $notification->template)
			@endforeach
		</ul>
	</div>
	<div class="panel-footer text-right remove-padding-horizontal pager-footer">
		<!-- Pager -->
		{!! $notifications->render() !!}
	</div>
    @else
	<div class="panel-body">
		<div class="empty-block">{!! trans('hifone.notifications.noitem') !!}</div>
	</div>
    @endif

</div>


@stop
