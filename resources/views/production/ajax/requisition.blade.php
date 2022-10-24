@forelse($requisitions as $requisition)
    <tr>
        <td>{{ $requisition->id }}</td>
        <td>
            @if ($requisition->status == 'purchase')
                <a href="{{ route('production.viewRequisition', ['requisition' => $requisition->id]) }}"
                    class="btn btn-info btn-xs">Proccess to Collect</a>
            @endif
            @if ($requisition->status == 'pending')
            @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
            auth()->user()->selectRole('production')->hasPermission('req_delete'))
                <a onclick="return confirm('Are you sure? You want to delete this Requisition?');"
                    href="{{ route('production.deleteRequisition', ['requisition' => $requisition->id]) }}"
                    class="text-danger deleteReq"><i class="fas fa-trash"></i></a>
                    @endif

                    @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
                    auth()->user()->selectRole('production')->hasPermission('req_edit'))
                <a href="{{ route('production.editRequisition', ['requisition' => $requisition->id]) }}"
                    class="text-success"><i class="fas fa-edit" aria-hidden="true"></i></a>
                    @endif

            @endif
            <a href="{{ route('production.viewRequisition', ['requisition' => $requisition->id]) }}"
                class="text-info"><i class="fas fa fa-eye" aria-hidden="true"></i></a>

        </td>
        <td>{{ $requisition->user ? $requisition->user->name : '' }}</td>
        <td>{{ $requisition->date }}</td>
        <td>{{ $requisition->total_quantity }}</td>
        <td>{{$requisition->collected_qty > 0 ?$requisition->collected_qty:''}}</td>
    <td>{{$requisition->collect_wise_price > 0 ?$requisition->collect_wise_price:''}}</td>
    <td>{{$requisition->type}}</td>
        <td>
            @if ($requisition->status == 'pending')
                <span class="badge badge-warning">Pending</span>
            @elseif ($requisition->status == 'approved')
                <span class="badge badge-warning">Approved</span>
            @elseif ($requisition->status == 'collected')
                <span class="badge badge-info">Collected</span>
            @elseif ($requisition->status == 'stocked')
                <span class="badge badge-success">Stocked</span>
            @else
                <span class="badge badge-info">{{ $requisition->status}}</span>
            @endif

        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="text-danger h4">No Requisition Found</td>
    </tr>
@endforelse
