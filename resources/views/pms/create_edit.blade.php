@extends('layouts.default')

@section('title')
    {{ trans('hifone.threads.add') }}_@parent
@stop

@section('content')

    <div class="thread_create">

        <div class="col-md-9 main-col">
            <div class="panel panel-default corner-radius">
                <div class="panel-heading">{{ trans('hifone.threads.add') }}</div>
                <div class="panel-body">
                    <div class="reply-box form box-block">
                        {!! Form::open(['route' => 'messages.store']) !!}

                        <div class="form-group">
                            {!! Form::label('subject', 'Subject', ['class' => 'control-label']) !!}
                            {!! Form::text('subject', null, ['class' => 'form-control', 'placeholder' => trans('hifone.threads.title')]) !!}
                        </div>

                        <div class="form-group">
                            <select class="form-control selectpicker" name="thread[node_id]">
                                <option value="">{{ trans('hifone.pms.pick_user') }}</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"> - {{ $user->username }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- editor start -->
                        @include('pms.partials.editor_toolbar')
                    <!-- end -->
                        <div class="form-group">
                            {!! Form::textarea('message', null, [
                            'class' => 'post-editor form-control',
                            'rows' => 15,
                            'style' => 'body_field',
                            'placeholder' => trans('hifone.markdown_support')
                            ]) !!}
                        </div>

                        <div class="form-group status-post-submit">
                            {!! Form::submit(trans('hifone.pms.send'), ['class' => 'btn btn-primary form-control']) !!}
                        </div>

                        <div class="box preview markdown-body" id="preview-box" style="display:none;"></div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-3 side-bar">
            <div class="panel panel-default corner-radius help-box">
                <div class="panel-heading text-center">
                    <h3 class="panel-title">{{ trans('hifone.threads.posting_tips.title') }}</h3>
                </div>
                <div class="panel-body">
                    <ul class="list">
                        <li>{{ trans('hifone.threads.posting_tips.pt1_title') }}
                            <p>{{ trans('hifone.threads.posting_tips.pt1_desc') }}</p>
                        </li>
                        <li>{{ trans('hifone.threads.posting_tips.pt2_title') }}
                            <p>{{ trans('hifone.threads.posting_tips.pt2_desc') }}</p>
                        </li>
                        <li>{{ trans('hifone.threads.posting_tips.pt3_title') }}
                            <p>{!! trans('hifone.threads.posting_tips.pt3_desc') !!}</p>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="panel panel-default corner-radius help-box">
                <div class="panel-heading text-center">
                    <h3 class="panel-title">{{ trans('hifone.threads.community_guidelines.title') }}</h3>
                </div>
                <div class="panel-body">
                    <ul class="list">
                        <li>{{ trans('hifone.threads.community_guidelines.cg1_title') }}
                            <p>{{ trans('hifone.threads.community_guidelines.cg1_desc') }}</p>
                        </li>
                        <li>{{ trans('hifone.threads.community_guidelines.cg2_title') }}
                            <p>{{ trans('hifone.threads.community_guidelines.cg2_desc') }}</p>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

@stop
