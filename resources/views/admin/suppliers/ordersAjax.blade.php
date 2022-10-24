@forelse($orders as $order)
    <tr>
        <td>{{$order->id}}</td>
        <td>{{$order->raw_materials->name}}</td>
        <td>{{round($order->raw_materials->unit_value) . $order->raw_materials->unit}}</td>
        <td>{{$order->raw_type}}</td>
        <td>{{$order->quantity}}</td>
        <td>{{$order->price}}</td>
        <td>{{$order->quantity * $order->price}}</td>
        <td>{{\Carbon\Carbon::parse($order->created_at)->format('d M,Y')}}</td>
    </tr>
    @empty
    <tr>
        <td colspan="6" class="text-danger h4">No Suppliers Orderes Found</td>
    </tr>
@endforelse
