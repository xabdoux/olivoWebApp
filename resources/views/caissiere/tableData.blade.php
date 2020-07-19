<tbody id="tableDataPlace">
    @foreach ($clients as $client)
    <tr>
        <td>{{$client->id}}</td>
        <td>{{$client->name}}</td>
        <td>{{$client->tour}}</td>
        <td class="text-center">{!!$client->payed_at ? "<span class='label label-success label-rounded'>Payé</span>":"<span class='label label-warning label-rounded'>En Attente</span>" !!}</td>
        <td class="text-center">
            <a href="{{ url('profileClient',$client->id) }}" class="m-r-20"><button type="button" class="btn btn-info btn-circle"><i class="fa  fa-user"></i> </button></a>
            @if ($client->payed_at)
            <button type="button" class="btn btn-success btn-circle"><i class="fa  fa-money"></i> </button>

            @else
            <a href="{{ url('proceedToPayment',$client->id) }}"><button type="button" class="btn btn-default btn-circle"><i class="fa  fa-money"></i> </button></a>
            @endif

        </td>
    </tr>
    @endforeach
</tbody>