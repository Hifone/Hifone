@if (isset($advertisements) && count($advertisements))
<!-- {{ $adspace->name }} -->
@foreach ($advertisements as $ad)
{!! $ad->body !!}
@endforeach
@endif