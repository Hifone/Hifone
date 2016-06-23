@extends('layouts.dashboard')

@section('content')
@if(isset($sub_menu))
@include('dashboard.partials.sub-sidebar')
@endif
<div class="content-wrapper">
    <div class="header sub-header" id="advertisements">
        <span class="uppercase">
            {{ trans('dashboard.advertisements.advertisements') }}
        </span>
    </div>
    <div class="row">
        <div class="col-sm-12">
@if (isset($advertisement))
{!! Form::model($advertisement, ['route' => ['dashboard.advertisement.update', $advertisement->id], 'id' => 'advertisement-update-form', 'method' => 'patch']) !!}
@else
{!! Form::open(['route' => 'dashboard.advertisement.store','id' => 'advertisement-create-form', 'method' => 'post']) !!}
@endif
                @include('partials.errors')
                <fieldset>
                    <div class="form-group">
                        <label>{{ trans('dashboard.advertisements.name') }}</label>
                         {!! Form::text('advertisement[name]', isset($advertisement) ? $advertisement->name : null, ['class' => 'form-control', 'id' => 'advertisement-name', 'placeholder' => '']) !!}
                    </div>
                @if($adspaces->count() > 0)
                <div class="form-group">
                    <label>{{ trans('dashboard.adspaces.adspaces') }}</label>
                    <select name="advertisement[adspace_id]" class="form-control">
                        <option value="0" {{ !isset($advertisement) || $advertisement->adspace_id == 0 ? 'selected' : null }}></option>
                        @foreach($adspaces as $item)
                        <option value="{{ $item->id }}" {{ (Input::old('adspace_id') == $item->id) || (isset($adspace) && $adspace->id == $item->id) ? 'selected' : null }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                @else
                <input type="hidden" name="advertisement[adspace_id]" value="0">
                @endif
                <div class="form-group">
                <label>{{ trans('dashboard.advertisements.body') }}</label>
                {!! Form::textarea('advertisement[body]', isset($advertisement) ? $advertisement->body : null , ['class' => 'form-control',
                                    'rows' => 10,
                                    'style' => "",
                                    'id' => 'advertisement-body',
                                    'placeholder' => '']) !!}
                </div>
                <div class="checkbox">
                            <label>
                                <input type="hidden" value="0" name="advertisement[enabled]">
                                <input type="checkbox" value="1" name="advertisement[enabled]" {{ isset($advertisement) && $advertisement->enabled ? "checked" : null }}>
                                {{ trans('forms.enabled') }}
                            </label>
                        </div>
                </fieldset>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">{{ trans('forms.save') }}</button>
                            <a class="btn btn-default" href="{{ route('dashboard.advertisement.index') }}">{{ trans('forms.cancel') }}</a>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop