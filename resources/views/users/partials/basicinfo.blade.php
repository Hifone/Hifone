<div style="text-align: center;">
    <img src="{{$user->avatar}}" class="img-thumbnail users-show-avatar upload-btn" style="width: 206px;margin: 4px 4px 15px;min-height:190px;cursor: pointer;">
</div>

<dl class="dl-horizontal">

  <dt><lable>&nbsp; </lable></dt><dd> {!! trans('hifone.users.id') !!} {!! $user->id !!}</dd>

  <dt><label>{{ trans('hifone.users.username') }}:</label></dt><dd><strong>{!! $user->username !!}</strong></dd>

  @if ($user->hasBadge)
    <dt><label>{{ trans('hifone.users.role') }}:</label></dt><dd><span class="label label-warning">{!! $user->badgeName !!}</span></dd>
  @endif

  @if ($user->realname)
    <dt class="adr"><label> {!! trans('hifone.users.realname') !!}:</label></dt><dd><span class="org">{!! $user->realname !!}</span></dd>
  @endif

  @if ($user->company)
    <dt class="adr"><label> {!! trans('hifone.users.company') !!}:</label></dt><dd><span class="org">{!! $user->company !!}</span></dd>
  @endif

  @if ($user->city)
    <dt class="adr"><label> {!! trans('hifone.users.city') !!}:</label></dt><dd><span class="org"><i class="fa fa-map-marker"></i> {!! $user->city !!}</span></dd>
  @endif

  @if ($user->personal_website)
  <dt><label>{!! trans('hifone.users.blog') !!}:</label></dt>
  <dd>
    <a href="http://{!! $user->personal_website !!}" rel="nofollow" target="_blank" class="url">
      <i class="fa fa-globe"></i> {!! str_limit($user->personal_website, 22) !!}
    </a>
  </dd>
  @endif
  <dt>
    <label>{{ trans('hifone.users.register_date') }}</label>
  </dt>
  <dd><span>{!! $user->created_at !!}</span></dd>
  @if ($user->signature)
    <dt><label>{{ trans('hifone.users.signature') }}:</label></dt><dd><span>{!! $user->signature !!}</span></dd>
  @endif
</dl>
<div class="clearfix"></div>
@if (Auth::check())
  @if (Auth::user() && (Auth::user()->id == $user->id || Entrust::can('manage_users')))
    <a class="btn btn-primary btn-block" href="{!! route('user.edit', $user->id) !!}" id="user-edit-button">
      <i class="fa fa-edit"></i> {!! trans('hifone.users.edit.title') !!}
    </a>
    @if(isset($providers))
    @foreach($providers as $provider)
      @if(in_array($provider->id, $bind_oauth_ids))
       <a class="btn btn-default btn-block" data-method='post' data-url="/users/{{$user->id}}/unbind?provider_id={{ $provider->id }}" id="user-edit-button">
      <i class="fa fa-minus"></i> {{ trans('hifone.login.oauth.unbound', ['provider' => $provider->name]) }}
    </a>
      @else
     <a class="btn btn-success btn-block" href="/auth/{{ $provider->slug }}" id="user-edit-button">
      <i class="{{ $provider->icon ? $provider->icon : 'fa fa-plus' }}"></i> {{ trans('hifone.login.oauth.bound', ['provider' => $provider->name]) }}
    </a>
      @endif
    @endforeach
    @endif
  @endif
@endif

@if (Auth::check())
  @if (Auth::user() && Entrust::can('manage_users') && (Auth::user()->id != $user->id))
    <a data-method="post" class="btn btn-{!! $user->is_banned ? 'warning' : 'danger' !!} btn-block" href="javascript:void(0);" data-url="{!! route('user.blocking', $user->id) !!}" id="user-edit-button" onclick=" return confirm('Are you sure?')">
      <i class="fa fa-times"></i> {!! $user->is_banned ? trans('hifone.users.unblock') : trans('hifone.users.block') !!}
    </a>
  @endif
@endif
