<div class="row max-width">
    <div class="col-xs-12">
        <ul class="breadcrumb">
            <li>
                <a href="{{ route('home') }}">{{ trans('hifone.home') }}</a>
            </li>
            @foreach($breadcrumbs as $index => $breadcrumb)
            <li>
               @if($index == count($breadcrumbs) -1 )
                <strong>{{ $breadcrumb['name'] }}</strong>
                @else
                <a href="{{ $breadcrumb['url'] }}">
                    <span>{{ $breadcrumb['name'] }}</span>
                </a>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
</div>