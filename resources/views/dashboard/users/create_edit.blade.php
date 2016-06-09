@extends('layouts.dashboard')

@section('content')
    <div class="header">
        <div class="sidebar-toggler visible-xs">
            <i class="fa fa-navicon"></i>
        </div>
        <span class="uppercase">
            <i class="fa fa-user"></i> {{ trans('dashboard.users.users') }}
        </span>
        > <small>{{ trans(isset($user) ? 'dashboard.users.edit.title' : 'dashboard.users.add.title') }}</small>
    </div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                    @include('partials.errors')
                    @if(isset($user))
                        {!! Form::model($user, ['route' => ['dashboard.user.update', $user->id], 'id' => 'user-edit-form', 'method' => 'patch']) !!}
                    @else
                        {!! Form::open(['route' => 'dashboard.user.store','id' => 'user-create-form', 'method' => 'post']) !!}
                    @endif
                    <fieldset>
                        <div class="form-group">
                            <label for="user-username">{{ trans('dashboard.users.username') }}</label>
                            {!! Form::text('user[username]', isset($user) ? $user->username : null, ['class' => 'form-control', 'id' => 'user-username', 'placeholder' => '']) !!}
                        </div>
                        <div class="form-group">
                            <label for="user-email">{{ trans('dashboard.users.email') }}</label>
                            {!! Form::text('user[email]', isset($user) ? $user->email : null, ['class' => 'form-control', 'id' => 'user-email', 'placeholder' => '']) !!}
                        </div>
                        <div class="form-group">
                            <label for="user-password">{{ trans('dashboard.users.password') }}</label>
                            {!! Form::text('user[password]', null, ['class' => 'form-control', 'id' => 'user-password', 'placeholder' => '']) !!}
                        </div>
                    </fieldset>
                    <div class='form-group'>
                        <div class='btn-group'>
                            <button type="submit" class="btn btn-success">{{ trans('forms.save') }}</button>
                            <a class="btn btn-default" href="{{ route('dashboard.user.index') }}">{{ trans('forms.cancel') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop