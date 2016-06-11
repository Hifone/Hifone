@extends('layouts.dashboard')

@section('content')
@if(isset($sub_menu))
@include('dashboard.partials.sub-sidebar')
@endif
<div class="content-wrapper">
    <div class="header sub-header" id="nodes">
        <span class="uppercase">
            {{ trans(isset($node) ? 'dashboard.nodes.edit.title' : 'dashboard.nodes.add.title') }}
        </span>
    </div>
    <div class="row">
        <div class="col-sm-12">
@if(isset($node))
{!! Form::model($node, ['route' => ['dashboard.node.update', $node->id], 'id' => 'node-create-form', 'method' => 'patch']) !!}
@else
{!! Form::open(['route' => 'dashboard.node.store','id' => 'node-create-form', 'method' => 'post']) !!}
@endif
                @include('partials.errors')
                <fieldset>
                <div class="form-group">
                    <label>{{ trans('dashboard.nodes.name') }}</label>
                     {!! Form::text('node[name]', isset($node) ? $node->name : null, ['class' => 'form-control', 'id' => 'node-name', 'placeholder' => '']) !!}
                </div>
                <div class="form-group">
                    <label>{{ trans('dashboard.nodes.slug') }}</label>
                    {!! Form::text('node[slug]', isset($node) ? $node->slug : null, ['class' => 'form-control', 'id' => 'node-slug', 'placeholder' => '']) !!}
                </div>
                @if($sections->count() > 0)
                <div class="form-group">
                    <label>{{ trans('dashboard.sections.sections') }}</label>
                    <select name="node[section_id]" class="form-control">
                        <option value="0">请选择分类</option>
                        @foreach($sections as $section)
                        <option value="{{ $section->id }}" {{ option_is_selected([$section, 'section_id', isset($node) ? $node : null]) }}>{{ $section->name }}</option>
                        @endforeach
                    </select>
                </div>
                @else
                <input type="hidden" name="node[section_id]" value="0">
                @endif
                <div class="form-group">
                <label>{{ trans('dashboard.nodes.description') }}</label>
                {!! Form::textarea('node[description]', isset($node) ? $node->description : null , ['class' => 'form-control',
                                    'rows' => 5,
                                    'style' => "overflow:hidden",
                                    'id' => 'node-descritpion',
                                    'placeholder' => '']) !!}
                </div>
                </fieldset>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">{{ trans('forms.save') }}</button>
                            <a class="btn btn-default" href="{{ back_url('dashboard.node.index') }}">{{ trans('forms.cancel') }}</a>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop