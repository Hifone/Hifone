@extends('layouts.dashboard')

@section('content')
<div class="content-wrapper">
    <div class="header sub-header" id="general">
        <span class="uppercase">
            {{ trans('dashboard.replies.edit.title') }}
        </span>
    </div>
     @if(isset($sub_menu))
    @include('dashboard.partials.sub-nav')
    @endif
    <div class="row">
        <div class="col-md-12">
            @include('partials.errors')
            @if(isset($reply))
                {!! Form::model($reply, ['route' => ['dashboard.reply.update', $reply->id], 'id' => 'reply-edit-form', 'method' => 'patch']) !!}
                <input type="hidden" name="id" value={{$reply->id}}>
            @else
                {!! Form::open(['route' => 'dashboard.reply.store','id' => 'reply-create-form', 'method' => 'post']) !!}
            @endif
                <fieldset>
                    <div class="form-group">
                        <label>{{ trans('hifone.replies.body') }}</label>
                        <div class='markdown-control'>
                            <textarea name="reply[body]" class="form-control" rows="10">{{ isset($reply) ? $reply->body_original : null }}</textarea>
                        </div>
                    </div>
                </fieldset>

                <div class='form-group'>
                    <div class='btn-group'>
                        <button type="submit" class="btn btn-success">{{ trans('forms.update') }}</button>
                        <a class="btn btn-default" href="{{ route('dashboard.reply.index') }}">{{ trans('forms.cancel') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop