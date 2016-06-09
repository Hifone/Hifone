@if (isset($advertisements) && count($advertisements))
<div class="panel panel-default corner-radius">
    <div class="panel-heading">
      <h3 class="panel-title">{{ $adspace->name }}</h3>
    </div>
    <div class="panel-body">
@foreach ($advertisements as $ad)
{!! $ad->body !!}
@endforeach
    </div>
</div>
@endif