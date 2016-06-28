@extends('layouts.default')

@section('title')
{!! trans('hifone.notifications.my') !!} @parent
@stop

@section('content')

<div class="notifications panel">

    <div class="panel-heading clearfix">
      {!! trans('hifone.notifications.my') !!}
      <span class="pull-right">
          <a class="btn btn-sm btn-danger" rel="nofollow" data-method="post" data-url="/notification/clean">{{ trans('forms.clean') }}</a>
      </span>
    </div>

    @if (count($notifications))
	<div class="panel-body remove-padding-horizontal notification-index content-body">

		<ul class="list-group row">
			@foreach ($notifications as $day => $item)
				<div class="notification-group">
				<div class="group-title"><i class="fa fa-clock-o"></i> {{ $day }}</div>
				@foreach($item as $notification)
					@include('notifications.partials.'.$notification->template)
				@endforeach
				</div>
			@endforeach
		</ul>
	</div>
	<div class="panel-footer text-right remove-padding-horizontal pager-footer">
		<!-- Pager -->
	</div>
    @else
	<div class="panel-body">
		<div class="empty-block">{!! trans('hifone.notifications.noitem') !!}</div>
	</div>
    @endif

</div>


@stop
