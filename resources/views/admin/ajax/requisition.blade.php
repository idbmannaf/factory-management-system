@forelse($requisitions as $requisition)
    <tr>
        <td>{{ $requisition->id }}</td>
        <td>
            @if ($requisition->status == 'pending')
                <a href="{{ route('admin.requisitionView', ['requisition' => $requisition]) }}"
                    class="btn btn-info btn-sm">Proccess To Approved</a>
            @elseif($requisition->status == 'approved, ')
                <a href="{{ route('admin.requisitionView', ['requisition' => $requisition]) }}"
                    class="btn btn-success btn-sm">Pending Purchase</a>
            @elseif($requisition->status == 'pending_purchase')
                <a href="{{ route('admin.requisitionView', ['requisition' => $requisition]) }}"
                    class="btn btn-success btn-sm">Approved Purchase</a>
            @elseif($requisition->status == 'approved_purchase')
                <a href="{{ route('admin.requisitionView', ['requisition' => $requisition]) }}"
                    class="btn btn-success btn-sm">Proccess To Purchase</a>
            @elseif($requisition->status == 'purchase')
                <a href="{{ route('admin.requisitionView', ['requisition' => $requisition]) }}"
                    class="btn btn-success btn-sm">Proccess To Collect</a>
            @elseif($requisition->status == 'collected')
                <a href="{{ route('admin.requisitionView', ['requisition' => $requisition]) }}"
                    class="btn btn-success btn-sm">Proccess To Stock</a>
            @endif

            <a href="{{ route('admin.requisitionView', ['requisition' => $requisition->id]) }}"
                class="text-info"><i class="fas fa fa-eye" aria-hidden="true"></i></a>
            @if ($requisition->status == 'pending')
                <a onclick="return confirm('Are you sure? You want to delete this Requisition?');"
                    href="{{ route('admin.requisitionDelete', ['requisition' => $requisition->id]) }}"
                    class="text-danger deleteReq"><i class="fas fa-trash"></i></a>
                <a href="{{ route('admin.requisitionEdit', ['requisition' => $requisition->id]) }}"
                    class="text-success"><i class="fas fa-edit" aria-hidden="true"></i></a>
            @endif

        </td>
        <td>{{ $requisition->user ? $requisition->user->name : '' }}</td>
        <td>{{ $requisition->date }}</td>
        <td>{{ $requisition->total_quantity }}</td>
        <td>{{ $requisition->total_price }}</td>
        <td>{{ $requisition->collected_qty > 0 ? $requisition->collected_qty : '' }}</td>
        <td>{{ $requisition->collect_wise_price > 0 ? $requisition->collect_wise_price : '' }}</td>
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
                <span class="badge badge-info">{{$requisition->status}}</span>
            @endif

        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="text-danger h4">No Requisition Found</td>
    </tr>
@endforelse
