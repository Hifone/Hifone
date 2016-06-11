@extends('layouts.dashboard')

@section('content')
@if(isset($sub_menu))
@include('dashboard.partials.sub-sidebar')
@endif
<div class="content-wrapper">
    <div class="header sub-header">
        <span class="uppercase">
            <i class="fa fa-tint"></i> {{ trans('dashboard.links.links') }}
        </span>
        <small>{{ trans(isset($tip) ? 'dashboard.links.edit.title': 'dashboard.links.add.title') }}</small>
        <div class="clearfix"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('partials.errors')
            @if(isset($link))
                {!! Form::model($link, ['route' => ['dashboard.link.update', $link->id], 'id' => 'link-edit-form', 'method' => 'patch']) !!}
                <input type="hidden" name="id" value={{$link->id}}>
            @else
                {!! Form::open(['route' => 'dashboard.link.store','id' => 'link-create-form', 'method' => 'post']) !!}
            @endif
                <fieldset>
                    <div class="form-group">
                        <label for="link-title">{{ trans('dashboard.links.title') }}</label>
                        <input type="text" class="form-control" name="link[title]" id="link-title" required value="{{ isset($link) ? $link->title : null }}">
                    </div>
                    <div class="form-group">
                        <label for="link-url">{{ trans('dashboard.links.url') }}</label>
                        <input type="text" class="form-control" name="link[url]" id="link-url" required value="{{ isset($link) ? $link->url : null }}">
                    </div>
                    <div class="form-group">
                        <label for="link-cover">{{ trans('dashboard.links.cover') }}</label>
                        <input type="text" class="form-control" name="link[cover]" id="link-cover" required value="{{ isset($link) ? $link->cover : null }}">
                    </div>
                    <div class="form-group">
                        <label>{{ trans('dashboard.links.description') }}</label>
                        <div class='markdown-control'>
                            <textarea name="link[description]" class="form-control" rows="5">{{ isset($link) ? $link->description : null }}</textarea>
                        </div>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="hidden" value="0" name="link[status]">
                            <input type="checkbox" value="1" name="link[status]" {{ isset($link) && $link->status ? 'checked' : null }}>
                            {{ trans('dashboard.links.status') }}
                        </label>
                    </div>
                </fieldset>

                <div class='form-group'>
                    <div class='btn-group'>
                        <button type="submit" class="btn btn-success">{{ trans('forms.update') }}</button>
                        <a class="btn btn-default" href="{{ route('dashboard.link.index') }}">{{ trans('forms.cancel') }}</a>
                    </div>
                </div>
            </form>
        </div>
</div>
@stop