<ul class="nav nav-tabs" role="tablist">
  <li class="{{ Route::currentRouteName() == 'pm.create' ? 'active' : '' }}">
  	<a href="{{ route('pm.create') }}" >发送站短</a>
  </li>
  <li class="{{ Route::currentRouteName() == 'pm.index' && Input::get('tab') == 'inbox' ? 'active' : '' }}">
    <a href="{{ route('pm.index', ['tab' => 'inbox']) }}" >收件箱</a>
  </li>
  <li class="{{ Route::currentRouteName() == 'pm.index' && Input::get('tab') == 'outbox' ? 'active' : '' }}">
  	<a href="{{ route('pm.index', ['tab' => 'outbox']) }}" >发件箱</a>
  </li>
</ul>