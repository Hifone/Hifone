<ul class="list-group">

  @foreach ($credits as $index => $credit)
   <li class="list-group-item" >


        {!! str_limit($credit->name, '100') !!}

      <span class="meta">

        
          {!! $credit->rule->name !!}

        <span> • </span>
        {!! $credit->balance !!}
        <span> • </span>
        <span class="timeago">{!! $credit->created_at !!}</span>

      </span>

  </li>
  @endforeach

</ul>
