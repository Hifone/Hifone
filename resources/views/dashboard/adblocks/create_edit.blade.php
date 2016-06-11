@extends('layouts.dashboard')

@section('content')
@if(isset($sub_menu))
@include('dashboard.partials.sub-sidebar')
@endif
<div class="content-wrapper">
    <div class="header sub-header" id="adblocks">
        <span class="uppercase">
            {{ trans('dashboard.adblocks.adblocks') }}
        </span>
    </div>
    <div class="row">
        <div class="col-sm-12">
@if (isset($adblock))
{!! Form::model($adblock, ['route' => ['dashboard.adblock.update', $adblock->id], 'id' => 'adblock-update-form', 'method' => 'patch']) !!}
@else
{!! Form::open(['route' => 'dashboard.adblock.store','id' => 'adblock-create-form', 'method' => 'post']) !!}
@endif
                @include('partials.errors')
                <fieldset>
                    <div class="form-group">
                        <label>{{ trans('dashboard.adblocks.name') }}</label>
                         {!! Form::text('adblock[name]', isset($adblock) ? $adblock->name : null, ['class' => 'form-control', 'id' => 'adblock-name', 'placeholder' => '']) !!}
                    </div>
                    <div class="form-group">
                        <label>{{ trans('dashboard.adblocks.slug') }}</label>
                        {!! Form::text('adblock[slug]', isset($adblock) ? $adblock->slug : null, ['class' => 'form-control', 'id' => 'adblock-slug', 'placeholder' => '']) !!}
                    </div>
                </fieldset>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">{{ trans('forms.save') }}</button>
                            <a class="btn btn-default" href="{{ route('dashboard.adblock.index') }}">{{ trans('forms.cancel') }}</a>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop