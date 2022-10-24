@if (isset($shop))
<div class="card">
    <table class="table table-striped">
        <tr>
            <th>Shop Name</th>
            <td>:</td>
            <td>{{ $shop->name }}</td>
        </tr>
        <tr>
            <th>Owner Name</th>
            <td>:</td>
            <td>{{ $shop->owner_name }}</td>
        </tr>
        <tr>
            <th>Mobile</th>
            <td>:</td>
            <td>{{ $shop->mobile }}</td>
        </tr>
        <tr>
            <th>Initial Amount</th>
            <td>:</td>
            <td>{{ $shop->initial_amount }}</td>
        </tr>
        <tr>
            <th>Due Amount</th>
            <td>:</td>
            <td>{{ $shop->due_amount }}</td>
        </tr>
        <tr>
            <th>Added by</th>
            <td>:</td>
            <td>{{ $shop->agent->name ?? '' }}</td>
        </tr>
        <tr>
            <th>Added at</th>
            <td>:</td>
            <td>{{ now()->parse($shop->created_at)->format('d-M-Y') }}</td>
        </tr>
    </table>
</div>
@endif