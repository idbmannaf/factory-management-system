@extends('admin.layouts.adminMaster')

@section('title')
    Order List
@endsection

@push('css')
<style>
tr.nowrap td {
        white-space: nowrap;
    }
</style>
@endpush

@section('content')

<div class="card">
    <div class="card-header w3-purple h3">
        Shop Order List
    </div>
    <div class="card-body">
        @include('admin.ecommerce.shop.shopDetails')
        <div class="table-responsive" style="min-height: 75vh;">
            <table class="table table-bordered table-sm table-striped">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Action</th>
                        <th>Ordered at</th>
                        <th>Items</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Order For</th>
                        <th>Order By</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td class="text-center">{{ $order->id }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm " href="{{ route('admin.ecommerce.order', [$order->id]) }}">manage</a>
                        </td>
                        <td>{{ now()->parse($order->pending_at)->format('d-M-Y h:m A') }}</td>
                        <td class="text-center">{{ $order->items->count() }}</td>
                        <td>
                            &#2547; {{ $order->total_price }}  
                        </td>
                        <td class="text-center @if($order->order_status == 'pending') w3-blue @elseif($order->order_status == 'canceled') w3-red @else w3-green @endif">{{ Str::ucfirst($order->order_status) }}</td>
                        <td>
                            {{ $order->mobile }}
                        </td>
                        <td>
                            @if ($order->agent_id)
                                {{ $order->orderByAgent->name ?? '' }}
                            @else
                                Self
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="responsive">
            {{ $orders->links() }}
        </div>
    </div>
</div>


@endsection


@push('js')
<script>

</script>
@endpush
