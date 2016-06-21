<div class="row max-width">
    <div class="col-xs-12">
        <ul class="breadcrumb">
            <li>
                <a href="{{ route('home') }}">{{ $site_name }}</a>
            </li>

            @foreach($breadcrumbs as $index => $breadcrumb)
            <li>
                <a href="{{ $breadcrumb['url'] }}">
                   @if($index = count($breadcrumbs) -1 )
                    <strong>1</strong>
                    @else
                    <span>{{ $breadcrumb['name'] }}</span>
                    @endif
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>