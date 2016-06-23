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
        {!! Form::model($thread, ['route' => ['thread.update', $thread->id], 'id' => 'thread_edit_form', 'method' => 'patch']) !!}
      @else
        {!! Form::open(['route' => 'thread.store','id' => 'thread_create_form', 'class' => 'create_form', 'method' => 'post']) !!}
      @endif

        <div class="form-group">
          {!! Form::text('thread[title]', isset($thread) ? $thread->title : null, ['class' => 'form-control', 'id' => 'thread_title', 'placeholder' => trans('hifone.threads.title')]) !!}
        </div>

        <div class="form-group">
            <select class="form-control selectpicker" name="thread[node_id]" >
              <option value="" disabled {!! $node ? null : 'selected'; !!}>{{ trans('hifone.threads.pick_node') }}</option>
              @foreach ($sections as $section)
                <optgroup label="{{{ $section->name }}}">
                  @if(isset($section->nodes))
                  @foreach ($section->nodes as $item)
                    <option value="{{ $item->id }}" {!! (Input::old('node_id') == $item->id || (isset($node) && $node->id==$item->id)) ? 'selected' : ''; !!} > - {{ $item->name }}</option>
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
            <a href="/markdown" target="_blank"><i class="fa fa-lightbulb-o"></i> 排版说明</a>
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
        <h3 class="panel-title">{{ trans('hifone.nodes.current') }} : {{{ $node->name }}}</h3>
      </div>
      <div class="panel-body">
        {{ $node->description }}
      </div>
    </div>
    @endif

    <div class="panel panel-default corner-radius help-box">
      <div class="panel-heading text-center">
        <h3 class="panel-title">发帖提示</h3>
      </div>
      <div class="panel-body">
        <ul class="list">
          <li>主题标题
            <p>请在标题中描述内容要点。</p>
            </li>
             <li>选择节点
            <p>请为你的主题选择一个节点。恰当的归类会让你发布的信息更有用。</p>
            </li>
            <li>正文
            <p>Hifone 支持 <span style="font-family: Consolas, 'Panic Sans', mono"><a href="https://help.github.com/articles/github-flavored-markdown" target="_blank">GitHub Flavored Markdown</a></span> 文本标记语法。你可以在页面下方实时预览正文的实际渲染效果。</p>
            </li>
      </div>
    </div>

    <div class="panel panel-default corner-radius help-box">
      <div class="panel-heading text-center">
        <h3 class="panel-title">社区指导原则</h3>
      </div>
      <div class="panel-body">
        <ul class="list">
          <li>尊重原创
            <p>请不要在 Hifone 发布任何盗版链接，包括软件、音乐、电影等。</p>
            </li>
            <li>友好互助
            <p>保持对陌生人的友善。用知识去帮助别人。</p>
            </li>
        </ul>
      </div>
    </div>

  </div>
</div>

@stop
