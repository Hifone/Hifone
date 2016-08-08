<div class="col-md-3 side-bar">
  @if(Auth::check())
  <div class="panel panel-default corner-radius">
      <div class="panel-heading">
        <h3 class="panel-title">{!! isset($node) ? $node->name : $site_name.' - '.$site_about !!}</h3>
      </div>
    <div class="panel-body text-center">
      <div class="btn-group">
        <a href="{!! isset($node) ? URL::route('thread.create', ['node_id' => $node->id]) : URL::route('thread.create') ; !!}" class="btn btn-primary">
          <i class="fa fa-pencil"> </i> {!! trans('hifone.threads.add') !!}
        </a>
        @if($new_thread_dropdowns)
        <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
          {!! $new_thread_dropdowns !!}
        </ul>
        @endif
      </div>
    </div>
  </div>
    @if(Config::get('setting.module_active_pms'))
    <div class="panel panel-default corner-radius">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('hifone.pms.pms') }}</h3>
        </div>
        <div class="panel-body text-center">
            <div class="btn-group">
                <a href="{!! URL::route('messages.create') !!}" class="btn btn-primary">
                    <i class="fa fa-pencil"> </i> {!! trans('hifone.pms.create') !!}
                </a>
            </div>
            <br><br>
            <div class="btn-group">
                <a href="{!! URL::route('messages.index') !!}" class="btn btn-primary">
                    <i> </i> {!! trans('hifone.pms.nav_inbox') !!}
                </a>
            </div>
        </div>
    </div>
    @endif
  @else
  <div class="panel panel-default corner-radius">
    <div class="panel-heading">
      <h3 class="panel-title">{{ $site_name }} - {{ $site_about }}</h3>
    </div>
    <div class="panel-body text-center">
        <a href="/auth/register" class="btn btn-primary">
          <i class="fa fa-user"> </i> {!! trans('hifone.signup') !!}
        </a>
    </div>
    <div class="panel-footer text-center">
      {{ trans('hifone.registered_users') }} <a href="/auth/login">{{ trans('hifone.login.login') }}</a>
    </div>
  </div>
  @endif

{{ Widget::Adblock(['slug' => 'sidebar_top', 'template'=>'sidebar']) }}

@if(Request::is('/'))
<div class="panel panel-default corner-radius">
    <div class="panel-heading">
      <h3 class="panel-title">{{ trans('hifone.ranking') }}</h3>
    </div>
    <div class="panel-body">
      <table class="table table-striped">
      <tbody>
      @foreach($top_users as $index => $user)
        <tr>
        <td style="text-align: center;"><div class="avatar">
                @if($user->nickname)
                    <a href="{{ route('user.home',$user->username) }}"><img class="media-object img-thumbnail avatar-32" alt="{{ $user->nickname }}" src="{{ $user->avatar }}"></a>
                @else
                    <a href="{{ route('user.home',$user->username) }}"><img class="media-object img-thumbnail avatar-32" alt="{{ $user->username }}" src="{{ $user->avatar }}"></a>
                @endif
        </div></td>
        <td style="vertical-align: middle; font-size: 80%;">
            @if($user->nickname)
                <a href="{{ route('user.home',$user->username) }}">{{ $user->nickname }}</a>
            @else
                <a href="{{ route('user.home',$user->username) }}">{{ $user->username }}</a>
            @endif
        <td>
        <td style="vertical-align: middle;"><small data-toggle="tooltip" data-placement="top" title="{{ $user->score }}">{!! $user->coins !!}</small></td>
        </tr>
      @endforeach
      </tbody>
      </table>
    </div>
</div>
<div class="panel panel-default corner-radius">
    <div class="panel-heading">
      <h3 class="panel-title">{{ trans('hifone.tags.hot') }}</h3>
    </div>
    <div class="panel-body">
    @foreach($top_tags as $index => $tag)
    <div class="badge badge-tag-cloud">
        <a href="/tag/{{ urlencode($tag->name) }}">{{ $tag->name }}</a> ({{ $tag->count }})
    </div>
    @endforeach
    </div>
</div>
@if (isset($links) && count($links))
  <div class="panel panel-default corner-radius">
    <div class="panel-heading">
      <h3 class="panel-title">{!! trans('hifone.links.links') !!}</h3>
    </div>
    <ul class="list-group">
      @foreach ($links as $link)
      <li class="list-group-item"><a href="{{ $link->url }}" rel="nofollow" title="{{ $link->title }}" target="_blank"><img src="{{ $link->cover }}" style="width:150px; margin:6px 0;"></a></li>
      @endforeach
    </ul>
  </div>
@endif
@endif

{{ Widget::Adblock(['slug' => 'sidebar_middle', 'template'=>'sidebar']) }}

@if (isset($nodeThreads) && count($nodeThreads))
  <div class="panel panel-default corner-radius">
    <div class="panel-heading">
      <h3 class="panel-title">{!! trans('hifone.nodes.same_node_threads') !!}</h3>
    </div>
    <div class="panel-body">
      <ul class="list">

        @foreach ($nodeThreads as $nodeThread)
          <li>
          <a href="{!! route('thread.show', $nodeThread->id) !!}">
            {!! $nodeThread->title !!}
          </a>
          </li>
        @endforeach

      </ul>
    </div>
  </div>
@endif

<div class="panel panel-default corner-radius">
  <div class="panel-heading">
    <h3 class="panel-title">{!! trans('hifone.tips.tips') !!}</h3>
  </div>
  <div class="panel-body">
    {!! (isset($tip) && $tip) ? $tip->body : null !!}
  </div>
</div>

<div class="panel panel-default corner-radius">
  <div class="panel-heading">
    <h3 class="panel-title">{{ trans('hifone.stats.title') }}</h3>
  </div>
    <ul class="list-group">
      <li class="list-group-item">{{ trans('hifone.stats.users') }}: {{ $stats['user_count'] }} </li>
      <li class="list-group-item">{{ trans('hifone.stats.threads') }}: {{ $stats['thread_count'] }}</li>
      <li class="list-group-item">{{ trans('hifone.stats.replies') }}: {{ $stats['reply_count'] }}</li>
    </ul>
</div>

{{ Widget::Adblock(['slug' => 'sidebar_bottom', 'template'=>'sidebar']) }}

</div>
<div class="clearfix"></div>
