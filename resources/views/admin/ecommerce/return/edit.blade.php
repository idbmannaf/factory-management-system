 @extends('admin.layouts.adminMaster')

@section('title')
Shipment Return # {{ $return->id }}
@endsection

@push('css')
<style>

</style>
@endpush

@section('content')

<div class="card">
    <div class="card-header w3-purple h3">
        Shipment Return # {{ $return->id }}
    </div>
    <div class="card-body">
        @include('alerts.alerts')
        <div>
            Return at : {{ now()->parse($return->placed_at)->format('d-M-Y') }}
        </div>
        <div class="d-flex">
            Status : <span class="badge w3-small @if($return->return_status == 'accepted') badge-success @endif">{{ Str::ucfirst($return->return_status) }} </span>
            @if ($return->return_status != "accepted")
                
            <form action="{{ route('admin.ecommerce.shipment.return.statusUpdate', [$return, 'accepted']) }}" method="post">
                @csrf
                <button class="mx-3 my-1 btn btn-success btn-sm">Approve</button>
            </form>
            @endif
            {{-- @if ($return->return_status != "rejected")
             
            <form action="{{ route('admin.ecommerce.shipment.return.statusUpdate', [$return, 'rejected']) }}" method="post">
                @csrf
                <button class="mx-3 my-1 btn btn-danger btn-sm">Reject</button>
            </form>
            @endif --}}
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bold">
        Items List
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-striped table-bordered">
                <thead>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Shipment Qty</th>
                    <th>Return Qty</th>
                    <th>Return Amont</th>
                    <th>Return Type</th>
                    <th>Return Reason</th>
                </thead>
                <tbody>
                    @foreach ($return->items as $item)
                        <tr>
                            <td>{{ $item->product_id }}</td>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->shipment_quantity }}</td>
                            <td>{{ $item->return_quantity }}</td>
                            <td>{{ $item->return_amount }}</td>
                            <td>{{ Str::ucfirst($item->return_type) }}</td>
                            <td>{{ $item->return_reason }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection