@extends('layouts.dashboard')

@section('content')
    <div class="header fixed">
        <div class="sidebar-toggler visible-xs">
            <i class="fa fa-navicon"></i>
        </div>
        <span class="uppercase">
            <i class="fa fa-user"></i> {{ trans('dashboard.users.users') }}
        </span>
        <a class="btn btn-sm btn-success pull-right" href="{{ route('dashboard.user.create') }}">
            {{ trans('dashboard.users.add.title') }}
        </a>
        <div class="clearfix"></div>
    </div>
    <div class="content-wrapper header-fixed">
        <div class="row">
            <div class="col-sm-12">
                <div class="toolbar">
                  <form class="form-inline">
                    <div class="form-group">
                      <input type="text" name="q" class="form-control" value="" placeholder="用户名">
                    </div>
                    <button class="btn btn-default">搜索</button>
                  </form>
                </div>

                <div class="striped-list">
                    @foreach($users as $user)
                    <div class="row striped-list-item">
                        <div class="col-xs-2">
                            <a href="{{ route('user.show',['id'=>$user->id]) }}" target="_blank">{{ $user->username }}</a>
                        </div>
                        <div class="col-xs-6">
                            <small>{{ trans('dashboard.users.user', ['email' => $user->email, 'date' => $user->created_at]) }}</small>
                        </div>
                        <div class="col-xs-2">
                           <select class="form-control small change-role" name="only-role">
                            <option value="all">所属角色</option>
                            @foreach ($roles as $role)
                                <option value="{{$role->name}}" {{ $user->hasRole($role->name) ? 'selected' : null }}>{{$role->display_name}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col-xs-2 text-right">
                            <a href="/dashboard/user/{{ $user->id }}/edit" class="btn btn-default btn-sm">{{ trans('forms.edit') }}</a>
                            <a data-url="/dashboard/user/{{ $user->id }}/delete" class="btn btn-danger btn-sm confirm-action" data-method='delete'>{{ trans('forms.delete') }}</a>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="text-right">
                <!-- Pager -->
                {!! $users->appends(Request::except('page', '_pjax'))->render() !!}
                </div>
            </div>
        </div>
    </div>
@stop
