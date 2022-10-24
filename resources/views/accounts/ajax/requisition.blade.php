@forelse($requisitions as $requisition)
<tr>
    <td>{{$requisition->id}}</td>
    <td>
        @if ($requisition->status == 'pending_purchase')
            <a href="{{route('accounts.requisitionProcess',['requisition'=>$requisition])}}" class="btn btn-info btn-sm">Approved Purchase</a>
        @else
            <a href="{{route('accounts.requisitionProcess',['requisition'=>$requisition])}}" class="btn btn-warning btn-sm">Details</a>
        @endif


    </td>
    <td>{{$requisition->user ? $requisition->user->name : ''}}</td>
    <td>{{$requisition->date}}</td>
    <td>{{$requisition->total_quantity}}</td>
    <td>{{$requisition->total_price}}</td>
    <td>{{$requisition->collected_qty > 0 ?$requisition->collected_qty:''}}</td>
    <td>{{$requisition->collect_wise_price > 0 ?$requisition->collect_wise_price:''}}</td>
    <td>
        @if ($requisition->status == 'pending')
        <span class="badge badge-warning">Pending</span>
            @elseif ($requisition->status == 'approved')
            <span class="badge badge-warning">Approved</span>
        @elseif ($requisition->status == 'collected')
            <span class="badge badge-info">Collected</span>
        @elseif ($requisition->status == 'stocked')
            <span class="badge badge-info">Stocked</span>
            @else
            <span class="badge badge-info">
                {{$requisition->status}}
            </span>
        @endif

    </td>
</tr>
@empty
    <tr>
        <td colspan="7" class="text-danger h4">No Requisition Found</td>
    </tr>
@endforelse


