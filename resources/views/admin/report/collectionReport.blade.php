<div class="table-responsive" style="min-height: 30vh;">
    <table class="table table-bordered table-sm table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Date</th>
                <th>SR</th>
                <th>Shop</th>
                <th>Amount</th>
                <th>SR Com. Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalAmount = 0;
                $srComAmount = 0;
            @endphp
            @foreach ($collections as $collection)
                <tr class="nowrap">
                    <td>{{ $collection->id }}</td>
                    <td>{{ now()->parse($collection->trans_date)->format('d M Y') }}</td>
                    <td>{{ $collection->agent->name }}</td>
                    <td>{{ $collection->source->name }} ({{ $collection->source->mobile }})</td>
                    <td> &#2547; {{ $collection->paid_amount }}</td>
                    <td> &#2547; {{ $collection->sr_commission_amount }}</td>
                    <td>{{ Str::ucfirst($collection->status) }}</td>
                </tr>
                @php
                    $totalAmount = $totalAmount + $collection->paid_amount;
                    $srComAmount = $srComAmount + $collection->sr_commission_amount;
                @endphp
            @endforeach
            <tr class="w3-lime">
                <td></td>
                <td></td>
                <td></td>
                <th>Total</th>
                <th> &#2547; {{ $totalAmount }}</th>
                <th> &#2547; {{ $srComAmount }}</th>
                <td></td>
            </tr>
        </tbody>
        <thead>
            <tr>
                <th>Id</th>
                <th>Date</th>
                <th>SR</th>
                <th>Shop</th>
                <th>Amount</th>
                <th>SR Com. Amount</th>
                <th>Status</th>
            </tr>
        </thead>
    </table>
</div>