<li class="list-group-item media" style="margin-top: 0px;">
	<div class="avatar pull-left">
		<a href="{{ route('user.home', [$notification->author->username]) }}">
			<img class="media-object img-thumbnail avatar" alt="{{ $notification->author->username }}" src="{{ $notification->author->avatar_small }}"  style="width:38px;height:38px;"/>
		</a>
	</div>

	<div class="infos">

	  <div class="media-heading">

		<a href="{{ route('user.home', [$notification->author->username]) }}">
			{{ $notification->author->username }}
		</a>
		 •
		{{ $notification->labelUp }}
		
		<span class="meta">
			 • {{ trans('hifone.at') }} • <span class="timeago">{{ $notification->created_at }}</span>
		</span>
	  </div>
	  <div class="media-body markdown-reply content-body">
		{{ trans('hifone.credits.credits') }}: {{ $notification->object->rule->reward }}
		{!! $notification->body !!}
	  </div>

	</div>
</li>