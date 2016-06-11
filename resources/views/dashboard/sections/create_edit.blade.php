@extends('layouts.dashboard')

@section('content')
@if(isset($sub_menu))
@include('dashboard.partials.sub-sidebar')
@endif
<div class="content-wrapper">
    <div class="header sub-header" id="sections">
        <span class="uppercase">
            {{ trans(isset($section) ? 'dashboard.sections.edit.title' : 'dashboard.sections.add.title') }}
        </span>
    </div>
    <div class="row">
        <div class="col-sm-12">
            @if(isset($section))
            {!! Form::model($section, ['route' => ['dashboard.section.update', $section->id], 'id' => 'section-create-form', 'method' => 'patch']) !!}
            @else
            {!! Form::open(['route' => 'dashboard.section.store','id' => 'section-create-form', 'method' => 'post']) !!}
            @endif
            @include('partials.errors')
            <fieldset>
            <div class="form-group">
                <label>{{ trans('dashboard.sections.name') }}</label>
                 {!! Form::text('section[name]', isset($section) ? $section->name : null, ['class' => 'form-control', 'id' => 'section-name', 'placeholder' => '']) !!}
            </div>
            <div class="form-group">
                <label>{{ trans('dashboard.sections.order') }}</label>
                {!! Form::text('section[order]', isset($section) ? $section->order : null, ['class' => 'form-control', 'id' => 'section-order', 'placeholder' => '']) !!}
            </div>
            </fieldset>

            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">{{ trans('forms.save') }}</button>
                        <a class="btn btn-default" href="{{ back_url('dashboard.section.index') }}">{{ trans('forms.cancel') }}</a>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop