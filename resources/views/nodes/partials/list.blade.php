@if (isset($sections) && count($sections))
<div id="sections" class="panel panel-default">
  <div class="panel-heading">{{ trans('hifone.nodes.all') }}</div>
  <div class="panel-body">
    <div class="row node-list">
      @foreach ($sections as $index => $section)
      <div class="node media">
        <label class="media-left">{{ $section->name }}</label>
        @if(isset($section->nodes))
        <span class="nodes media-body">
              @foreach ($section->nodes as $node)
              <span class="name"><a title="{{ $node->name }}" href="{{ $node->url }}">{{ $node->name }}</a></span>
              @endforeach
        </span>
         @endif
      </div>
      @endforeach
    </div>
  </div>
</div>
@endif