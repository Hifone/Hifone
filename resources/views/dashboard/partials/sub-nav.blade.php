<div class="row">
  <div class="panel-body">
    <ul class="nav nav-tabs" role="tablist">
        <li class="sidebar-toggler visible-xs">
            <i class="fa fa-navicon"></i>
        </li>
       @foreach($sub_menu as $key => $item)
            <li class="{{ $key == $current_menu ? 'active' : null }}"><a href="{{ $item['url'] }}"><i class="{{ $item['icon'] }}"></i> {{ $item['title'] }}</a></li>
      @endforeach
    </ul>
  </div>
</div>