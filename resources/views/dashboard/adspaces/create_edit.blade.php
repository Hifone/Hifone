@extends('layouts.dashboard')

@section('content')
@if(isset($sub_menu))
@include('dashboard.partials.sub-sidebar')
@endif
<div class="content-wrapper">
    <div class="header sub-header" id="adspaces">
        <span class="uppercase">
            {{ trans('dashboard.adspaces.adspaces') }}
        </span>
    </div>
    <div class="row">
        <div class="col-sm-12">
@if (isset($adspace))
{!! Form::model($adspace, ['route' => ['dashboard.adspace.update', $adspace->id], 'id' => 'adspace-update-form', 'method' => 'patch']) !!}
@else
{!! Form::open(['route' => 'dashboard.adspace.store','id' => 'adspace-create-form', 'method' => 'post']) !!}
@endif
                @include('partials.errors')
                <fieldset>
                    <div class="form-group">
                        <label>{{ trans('dashboard.adspaces.name') }}</label>
                         {!! Form::text('adspace[name]', isset($adspace) ? $adspace->name : null, ['class' => 'form-control', 'id' => 'adspace-name', 'placeholder' => '']) !!}
                    </div>
                    <div class="form-group">
                        <label>{{ trans('dashboard.adspaces.position') }}</label>
                        {!! Form::text('adspace[position]', isset($adspace) ? $adspace->position : null, ['class' => 'form-control', 'id' => 'adspace-position', 'placeholder' => '']) !!}
                    </div>
                    @if($adblocks->count() > 0)
                <div class="form-group">
                    <label>{{ trans('dashboard.adblocks.adblocks') }}</label>
                    <select name="adspace[adblock_id]" class="form-control">
                        <option value="0">请选择</option>
                        @foreach($adblocks as $item)
                        <option value="{{ $item->id }}" {{ option_is_selected([$item, 'adblock_id', isset($adspace) ? $adspace : null]) }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                @else
                <input type="hidden" name="adspace[adblock_id]" value="0">
                @endif
                    <div class="form-group">
                        <label>{{ trans('dashboard.adspaces.route') }}</label>
                        {!! Form::text('adspace[route]', isset($adspace) ? $adspace->route : null, ['class' => 'form-control', 'id' => 'adspace-route', 'placeholder' => '']) !!}
                    </div>
                </fieldset>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">{{ trans('forms.save') }}</button>
                            <a class="btn btn-default" href="{{ route('dashboard.adspace.index') }}">{{ trans('forms.cancel') }}</a>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop