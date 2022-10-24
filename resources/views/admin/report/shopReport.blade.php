
<div class="border p-2 mb-2 w3-shadow w3-border-blue">
    <h3>Selected SR</h3>
    <div class="table-responsive">
        <table class="table table-sm table-bordered table-striped">
            <thead>
                <th>Shop ID</th>
                <th>Shop Name</th>
                <th>Account</th>
                <th>Owner Name</th>
                <th>Mobile</th>
                <th>Status</th>
            </thead>
            <tbody>
                @foreach ($sources as $source)
                <tr>
                    <td>{{ $source->id }}</td>
                    <td>{{ $source->name }}</td>
                    <td>
                        <li class="list-group-item py-0">Total sale: &#2547; {{ $source->total_sale }}</li>
                    <li class="list-group-item py-0">Total sale Commission: &#2547; {{ $source->total_sale_commission }}</li>
                    <li class="list-group-item py-0">Total Collection : &#2547; {{ $source->total_collection }}</li>
                    <li class="list-group-item py-0">Current Collection: &#2547; {{ $source->current_collection }}</li>
                    </td>
                    <td>{{ $source->owner_name }}</td>
                    <td>{{ $source->mobile }}</td>
                    <td>{{ $source->active ? 'Active' : 'Inactive' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="border p-2 mb-2 w3-shadow w3-border-green">
<h3>Collection Report</h3>

    @include('admin.report.collectionReport')
</div>

<div class="border p-2 mb-2 w3-shadow w3-border-orange">
<h3>Sales Report</h3>

@include('admin.report.productSalesReport')
</div>