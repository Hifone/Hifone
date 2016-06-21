@foreach($verifiers as $verifier)
<tr class="collapsed">
<td><i class="fa fa-angle-right"></i></td>
<td>{{$verifier->getName()}}</td>
<td>{!! $verifier->verify() ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-close text-danger"></i>' !!}</td>
</tr>
@endforeach