@extends('layouts.dashboard')

@section('content')
@if(isset($sub_menu))
    @include('dashboard.partials.sub-sidebar')
@endif
<div class="content-wrapper">
<div class="header sub-header">
    <span class="uppercase">
        <i class="fa fa-tint"></i> {{ trans('dashboard.tips.tips') }}
    </span>
    <small>{{ trans(isset($tip) ? 'dashboard.tips.edit.title': 'dashboard.tips.add.title') }}</small>
    <div class="clearfix"></div>
</div>
<div class="row">
    <div class="col-md-12">
        @include('partials.errors')
        @if(isset($tip))
            {!! Form::model($tip, ['route' => ['dashboard.tip.update', $tip->id], 'id' => 'tip-edit-form', 'method' => 'patch']) !!}
            <input type="hidden" name="id" value={{$tip->id}}>
        @else
            {!! Form::open(['route' => 'dashboard.tip.store','id' => 'tip-create-form', 'method' => 'post']) !!}
        @endif
            <fieldset>
                <div class="form-group">
                    <label>{{ trans('dashboard.tips.body') }}</label>
                    <div class='markdown-control'>
                        <textarea name="tip[body]" class="form-control" rows="5">{{ isset($tip) ? $tip->body : null}}</textarea>
                    </div>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="hidden" value="0" name="tip[status]">
                        <input type="checkbox" value="1" name="tip[status]" {{ isset($tip) && $tip->status ? 'checked' : null }}>
                        {{ trans('dashboard.tips.status') }}
                    </label>
                </div>
            </fieldset>
            <div class='form-group'>
                <div class='btn-group'>
                    <button type="submit" class="btn btn-success">{{ trans('forms.save') }}</button>
                    <a class="btn btn-default" href="{{ route('dashboard.tip.index') }}">{{ trans('forms.cancel') }}</a>
                </div>
            </div>
        </form>
    </div>
</div>
@stop