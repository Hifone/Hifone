<ul class="nav nav-tabs" role="tablist">
  <li class="{!! Route::currentRouteName() == 'user.home' ? 'active' : '' !!}">
  	<a href="{!! $user->url !!}" >{!! trans('hifone.users.info') !!}</a>
  </li>
  <li class="{!! Route::currentRouteName() == 'user.threads' ? 'active' : '' !!}">
    <a href="{!! route('user.threads', $user->id) !!}" >{!! trans('hifone.threads.threads') !!}</a>
  </li>
  <li class="{!! Route::currentRouteName() == 'user.replies' ? 'active' : '' !!}">
  	<a href="{!! route('user.replies', $user->id) !!}" >{!! trans('hifone.replies.replies') !!}</a>
  </li>
  <li class="{!! Route::currentRouteName() == 'user.favorites' ? 'active' : '' !!}">
  	<a href="{!! route('user.favorites', $user->id) !!}" >{!! trans('hifone.favorite') !!}</a>
  </li>
</ul>
