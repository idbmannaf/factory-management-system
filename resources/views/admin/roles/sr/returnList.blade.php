@extends('admin.layouts.adminMaster')
@section('title')
SR Shipment Return List 
@endsection
@push('css')
<style>

</style>
@endpush

@section('content')

<div class="card">
    <div class="card-header w3-purple h3">
        SR Shipment Return List 
    </div>
    <div class="card-body">
        @include('admin.roles.sr.srInfo')
        <div class="table-responsive">
            <table class="table table-bordered table-sm table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Action</th>
                        <th>Placed at</th>
                        <th>Status</th>
                        <th>Placed By</th>
                        <th>Return Price</th>
                        <th>Items</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($returns as $return)
                        <tr>
                            <td>{{ $return->id }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.ecommerce.shipment.return', $return) }}">manage</a>
                            </td>
                            <td>{{ now()->parse($return->placed_at)->format('d-M-Y') }}</td>
                            <td>{{ Str::ucfirst($return->return_status) }}</td>
                            <td>{{ $return->sr->name ?? '' }}</td>
                            <td>{{ $return->total_return_price }}</td>
                            <td>{{ $return->items->count() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="">
            {{ $returns->links() }}
        </div>
    </div>
</div>


@endsection


@push('js')
<script>
function publish(url,id) {
    console.log(id);
    axios.post(url).then(res => {
        $("#publish_button_"+id).addClass('disabled')
        $("#publish_button_"+id).html(`<i class="fas fa-check-double"></i> Published</button>`)
    })
}
</script>
@endpush
