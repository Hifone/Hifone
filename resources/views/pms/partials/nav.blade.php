<ul class="nav nav-tabs" role="tablist">
  <li class="{{ Route::currentRouteName() == 'pm.create' ? 'active' : '' }}">
  	<a href="{{ route('pm.create') }}" >{{ trans('hifone.pms.nav_create') }}</a>
  </li>
  <li class="{{ Route::currentRouteName() == 'pm.index' && Input::get('tab') == 'inbox' ? 'active' : '' }}">
    <a href="{{ route('pm.index', ['tab' => 'inbox']) }}" >{{ trans('hifone.pms.nav_inbox') }}</a>
  </li>
  <li class="{{ Route::currentRouteName() == 'pm.index' && Input::get('tab') == 'outbox' ? 'active' : '' }}">
  	<a href="{{ route('pm.index', ['tab' => 'outbox']) }}" >{{ trans('hifone.pms.nav_outbox') }}</a>
  </li>
</ul>