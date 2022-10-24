<div class="table-responsive" style="min-height: 75vh;">
    <table class="table table-sm table-striped">
        <thead>
            <th>Order #</th>
            <th>Ordered at</th>
            <th>Items</th>
            <th>Price</th>
            <th>Shipped Price</th>
            <th>Status</th>
            <th>Order For</th>
            <th>Order By</th>
        </thead>
        <tbody>
            @php
                $totalAmount = 0;
                $totalShipmentAmount = 0;
            @endphp
            @foreach ($orders as $order)
                <tr class="nowrap">
                    <td class="text-center">{{ $order->id }}</td>
                    <td>{{ now()->parse($order->pending_at)->format('d-M-Y h:m A') }}</td>
                    <td class="text-center">{{ $order->items->count() }}</td>
                    <td>
                        &#2547; {{ $order->total_collection_amount }}  
                    </td>
                    <td>
                        @php
                            $shipmentAmount = $order->shipments->sum('collection_amount');
                        @endphp
                        &#2547; {{ $shipmentAmount }}  
                    </td>
                    <td class="text-center @if($order->order_status == 'pending') w3-blue @elseif($order->order_status == 'canceled') w3-red @else w3-green @endif">{{ Str::ucfirst($order->order_status) }}</td>
                    <td>
                        {{ $order->mobile }}
                    </td>
                    <td>
                        @if ($order->agent_id)
                            {{ $order->orderByAgent->name }}
                        @else
                            Self
                        @endif
                    </td>
                </tr>
                @php
                    $totalAmount = $totalAmount + $order->total_collection_amount;
                    $totalShipmentAmount = $totalShipmentAmount + $shipmentAmount;
                @endphp
            @endforeach
                <tr class="w3-lime">
                    <td></td>
                    <td></td>
                    <th>Total</th>
                    <th>&#2547; {{ $totalAmount }}</th>
                    <th>&#2547; {{ $totalShipmentAmount }}</th>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
        </tbody>
        <thead>
            <th>Order #</th>
            <th>Ordered at</th>
            <th>Items</th>
            <th>Price</th>
            <th>Shipped Price</th>
            <th>Status</th>
            <th>Order For</th>
            <th>Order By</th>
        </thead>
    </table>
</div>