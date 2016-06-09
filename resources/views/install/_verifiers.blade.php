@foreach($verifiers as $verifier)
<tr class="collapsed">
<td><i class="fa fa-angle-right"></i></td>
<td>{{$verifier->getName()}}</td>
<td>{!! $verifier->verify() ? '<i class="fa fa-check green"></i>' : '<i class="fa fa-close red"></i>' !!}</td>
</tr>
<tr class="hidden">
    <td>
    {!! $verifier->getHelpView() !!}
    </td>
</tr>
@endforeach