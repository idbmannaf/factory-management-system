
<div class="border p-2 mb-2 w3-shadow w3-border-blue">
    <h3>Selected SR</h3>
    <div class="table-responsive">
        <table class="table table-sm table-bordered table-striped">
            <thead>
                <th>SR ID</th>
                <th>SR</th>
                <th>Account</th>
                <th>SR Name</th>
                <th>Mobile</th>
                <th>Status</th>
            </thead>
            <tbody>
                @foreach ($agents as $agent)
                <tr>
                    <td>{{ $agent->id }}</td>
                    <td>{{ $agent->name }}</td>
                    <td>
                        <li class="list-group-item py-0">Total sale: &#2547; {{ $agent->total_sale }}</li>
                    <li class="list-group-item py-0">Total sale Commission: &#2547; {{ $agent->total_sale_commission }}</li>
                    <li class="list-group-item py-0">Current sale : &#2547; {{ $agent->current_sale }}</li>
                    <li class="list-group-item py-0">Current sale Commission: &#2547; {{ $agent->current_sale_commission }}</li>
                    <li class="list-group-item py-0">Total Collection : &#2547; {{ $agent->total_collection }}</li>
                    <li class="list-group-item py-0">Total Collection Commission: &#2547; {{ $agent->total_collection_commission }}</li>
                    <li class="list-group-item py-0">Current Collection: &#2547; {{ $agent->current_collection }}</li>
                    {{-- <li class="list-group-item py-0">Current Collection Commission: &#2547; {{ $agent->current_commission }}</li> --}}
                    <li class="list-group-item py-0">Current Income: &#2547; {{ $agent->current_income }}</li>
                    </td>
                    <td>{{ $agent->user->name }}</td>
                    <td>{{ $agent->user->mobile }}</td>
                    <td>{{ $agent->active ? 'Active' : 'Inactive' }}</td>
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