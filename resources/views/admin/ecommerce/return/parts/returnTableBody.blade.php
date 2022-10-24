@if (isset($returns) && $returns->count() > 0)
@foreach ($returns as $return)
<tr class="nowrap">
    <td>{{ $return->id }}</td>
    <td>
        <a class="btn btn-primary btn-sm" href="{{ route('admin.ecommerce.shipment.return', $return) }}">manage</a>
    </td>
    <td>{{ now()->parse($return->placed_at)->format('d-M-Y') }}</td>
    <td>{{ Str::ucfirst($return->return_status) }}</td>
    <td>{{ $return->source->name ?? '' }}</td>
    <td>{{ $return->sr->name ?? '' }}</td>
    <td>{{ $return->total_return_price }}</td>
    <td>{{ $return->items->count() }}</td>
</tr>
@endforeach
@else
    <tr>
        <td colspan="15">No result found.</td>
    </tr>
@endif