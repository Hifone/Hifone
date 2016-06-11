@extends('layouts.dashboard')

@section('content')
<div class="content-wrapper">
    <div class="header sub-header" id="pages">
        <span class="uppercase">
            {{ trans(isset($page) ? 'dashboard.pages.edit.title' : 'dashboard.pages.add.title') }}
        </span>
    </div>
    @if(isset($sub_menu))
@include('dashboard.partials.sub-nav')
@endif
    <div class="row">
        <div class="col-sm-12">
            @if(isset($page))
            {!! Form::model($page, ['route' => ['dashboard.page.update', $page->id], 'id' => 'page-create-form', 'method' => 'patch']) !!}
            @else
            {!! Form::open(['route' => 'dashboard.page.store','id' => 'page-create-form', 'method' => 'post']) !!}
            @endif
            @include('partials.errors')
            <fieldset>
            <div class="form-group">
                <label>{{ trans('dashboard.pages.slug') }}</label>
                {!! Form::text('page[slug]', isset($page) ? $page->slug : null, ['class' => 'form-control', 'id' => 'page-slug', 'placeholder' => '']) !!}
            </div>
            <div class="form-group">
                <label>{{ trans('dashboard.pages.title') }}</label>
                 {!! Form::text('page[title]', isset($page) ? $page->title : null, ['class' => 'form-control', 'id' => 'page-title', 'placeholder' => '']) !!}
            </div>
            <div class="form-group">
            <label>{{ trans('dashboard.pages.body') }}</label>
            {!! Form::textarea('page[body]', isset($page) ? $page->body : null , ['class' => 'form-control',
                                'rows' => 15,
                                'id' => 'page-body',
                                'placeholder' => '']) !!}
            </div>
            </fieldset>

            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">{{ trans('forms.save') }}</button>
                        <a class="btn btn-default" href="{{ back_url('dashboard.page.index') }}">{{ trans('forms.cancel') }}</a>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop