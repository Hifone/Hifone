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
                        @if (isset($thread))
                            {!! Form::model($thread, ['route' => ['thread.update', $thread->id], 'id' => 'thread_edit_form', 'class' => 'create_form', 'method' => 'patch']) !!}
                        @else
                            {!! Form::open(['route' => 'thread.store','id' => 'thread_create_form', 'class' => 'create_form', 'method' => 'post']) !!}
                        @endif

                        <div class="form-group">
                            {!! Form::text('thread[title]', isset($thread) ? $thread->title : null, ['class' => 'form-control', 'id' => 'thread_title', 'placeholder' => trans('hifone.threads.title')]) !!}
                        </div>

                        <div class="form-group">
                            <select class="form-control selectpicker" name="thread[node_id]">
                                <option value=""
                                        disabled {!! $node ? null : 'selected'; !!}>{{ trans('hifone.threads.pick_node') }}</option>
                                @foreach ($sections as $section)
                                    <optgroup label="{{ $section->name }}">
                                        @if(isset($section->nodes))
                                            @foreach ($section->nodes as $item)
                                                <option value="{{ $item->id }}" {!! (Input::old('node_id') == $item->id || (isset($node) && $node->id==$item->id)) ? 'selected' : ''; !!} >
                                                    - {{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                        <!-- editor start -->
                        @include('threads.partials.editor_toolbar')
                    <!-- end -->
                        <div class="form-group">
                            {!! Form::textarea('thread[body]', isset($thread) ? $thread->body_original : null, ['class' => 'post-editor form-control',
                                                              'rows' => 15,
                                                              'style' => "overflow:hidden",
                                                              'id' => 'body_field',
                                                              'placeholder' => trans('hifone.markdown_support')]) !!}
                        </div>

                        <div class="form-group">
                            <select class="form-control js-tag-tokenizer" multiple="multiple" name="thread[tags][]">
                                @if(isset($thread))
                                    @foreach($thread->tags as $tag)
                                        <option selected="selected">{{ $tag->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <small>
                                {{ trans('hifone.tags.tags_help') }}
                            </small>
                        </div>

                        <div class="form-group status-post-submit">
                            {!! Form::submit(trans('forms.publish'), ['class' => 'btn btn-primary col-xs-2', 'id' => 'thread-create-submit']) !!}
                            <div class="pull-right">
                                <small>{!! trans('hifone.photos.drag_drop') !!}</small>
                                <a href="/markdown" target="_blank"><i
                                            class="fa fa-lightbulb-o"></i> {{ trans('hifone.photos.markdown_desc') }}
                                </a>
                                </small>
                            </div>
                        </div>

                        <div class="box preview markdown-body" id="preview-box" style="display:none;"></div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-3 side-bar">

            @if ( $node )
                <div class="panel panel-default corner-radius help-box">
                    <div class="panel-heading text-center">
                        <h3 class="panel-title">{{ trans('hifone.nodes.current') }} : {{ $node->name }}</h3>
                    </div>
                    <div class="panel-body">
                        {{ $node->description }}
                    </div>
                </div>
            @endif

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
