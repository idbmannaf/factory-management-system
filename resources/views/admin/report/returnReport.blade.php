<div class="table-responsive" style="min-height: 75vh;">
    <table class="table table-sm table-striped table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Placed at</th>
                <th>Status</th>
                <th>Placed By</th>
                <th>Return Price</th>
                <th>Items</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalAmount = 0;
            @endphp
            @foreach ($returns as $return)
                <tr class="nowrap">
                    <td>{{ $return->id }}</td>
                    <td>{{ now()->parse($return->placed_at)->format('d-M-Y') }}</td>
                    <td>{{ Str::ucfirst($return->return_status) }}</td>
                    <td>{{ $return->sr->name ?? '' }}</td>
                    <td> &#2547; {{ $return->total_return_price }}</td>
                    <td>{{ $return->items->count() }}</td>
                </tr>
                @php
                    $totalAmount = $totalAmount + $return->total_return_price;
                @endphp
            @endforeach
                <tr class="w3-lime">
                    <td></td>
                    <td></td>
                    <td></td>
                    <th>Total</th>
                    <th> &#2547; {{ $totalAmount }}</th>
                    <td></td>
                </tr>
        </tbody>
        <thead>
            <tr>
                <th>Id</th>
                <th>Placed at</th>
                <th>Status</th>
                <th>Placed By</th>
                <th>Return Price</th>
                <th>Items</th>
            </tr>
        </thead>
    </table>
</div>