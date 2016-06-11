@extends('layouts.dashboard')

@section('content')
<div class="content-wrapper">
    <div class="header sub-header" id="general">
        <span class="uppercase">
            {{ trans('dashboard.threads.edit.title') }}
        </span>
    </div>
     @if(isset($sub_menu))
    @include('dashboard.partials.sub-nav')
    @endif
    <div class="row">
        <div class="col-md-12">
            @include('partials.errors')
            @if(isset($thread))
                {!! Form::model($thread, ['route' => ['dashboard.thread.update', $thread->id], 'id' => 'thread-edit-form', 'method' => 'patch']) !!}
                <input type="hidden" name="id" value={{$thread->id}}>
            @else
                {!! Form::open(['route' => 'dashboard.thread.store','id' => 'thread-create-form', 'method' => 'post']) !!}
            @endif
                <fieldset>
                    <div class="form-group">
                        <label for="thread-title">{{ trans('hifone.threads.title') }}</label>
                        <input type="text" class="form-control" name="thread[title]" id="thread-title" required value="{{ isset($thread) ? $thread->title : null }}">
                    </div>
                    <div class="form-group">
            <select class="selectpicker form-control" name="thread[node_id]" >
              <option value="" disabled {!! $node ?: 'selected'; !!}>{{ trans('hifone.threads.pick_node') }}</option>
              @foreach ($sections as $section)
                <optgroup label="{{{ $section->name }}}">
                  @foreach ($section->nodes as $snode)
                    <option value="{{ $snode->id }}" {!! (Input::old('node_id') == $snode->id || (isset($node) && $node->id==$snode->id)) ? 'selected' : ''; !!} > - {{ $snode->name }}</option>
                  @endforeach
                </optgroup>
              @endforeach
            </select>
        </div>
                    <div class="form-group">
                        <label>{{ trans('hifone.threads.body') }}</label>
                        <div class='markdown-control'>
                            <textarea name="thread[body]" class="form-control" rows="10">{{ isset($thread) ? $thread->body_original : null }}</textarea>
                        </div>
                    </div>
                </fieldset>

                <div class='form-group'>
                    <div class='btn-group'>
                        <button type="submit" class="btn btn-success">{{ trans('forms.update') }}</button>
                        <a class="btn btn-default" href="{{ route('dashboard.thread.index') }}">{{ trans('forms.cancel') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop