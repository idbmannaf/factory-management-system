@if (isset($orders) && $orders->count() > 0)
@foreach ($orders as $order)
<tr>
    <td class="text-center">{{ $order->id }}</td>
    <td>
        <a class="btn btn-primary btn-sm " href="{{ route('admin.ecommerce.order', [$order->id]) }}">manage</a>
    </td>
    <td>{{ now()->parse($order->created_at)->format('d-M-Y h:m A') }}</td>
    @if ($type == 'pending')
       <td> {{ now()->parse($order->pending_at)->format('d-M-Y h:m A') }}</td>
    @elseif ($type == 'confirmed')
        <td> {{ now()->parse($order->confirmed_at)->format('d-M-Y h:m A') }}</td>
    @elseif ($type == 'processing')
        <td> {{ now()->parse($order-> processing_at)->format('d-M-Y h:m A') }}</td>
    @elseif ($type == 'shipped')
        <td> {{ now()->parse($order->shipped_at)->format('d-M-Y h:m A') }}</td>
    @elseif ($type == 'collected')
        <td> {{ now()->parse($order->collected_at)->format('d-M-Y h:m A') }}</td>
    @elseif ($type == 'delivered')
        <td> {{ now()->parse($order->delivered_at)->format('d-M-Y h:m A') }}</td>
    @elseif ($type == 'cancelled')
        <td> {{ now()->parse($order->cancelled_at)->format('d-M-Y h:m A') }}</td>
    @elseif ($type == 'returned')
        <td> {{ now()->parse($order->returned_at)->format('d-M-Y h:m A') }}</td>
    @elseif ($type == 'undelivered')
        <td> {{ now()->parse($order->undelivered_at)->format('d-M-Y h:m A') }}</td>
    @endif
    <td class="text-center">{{ $order->items->count() }}</td>
    <td>
        &#2547; {{ $order->total_collection_amount }}
    </td>
    <td class="text-center @if($order->order_status == 'pending') w3-blue @elseif($order->order_status == 'canceled') w3-red @else w3-green @endif">{{ Str::ucfirst($order->order_status) }}</td>
    <td>
        {{ $order->orderForSource->name }}
    </td>
    <td>
        @if ($order->agent_id)
            {{ $order->orderByAgent->name }}
        @else
            Self
        @endif
    </td>
</tr>
@endforeach
@else
    <tr>
        <td colspan="15" class="text-center text-danger h3">No result found.</td>
    </tr>
@endif
