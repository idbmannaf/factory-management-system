@extends('admin.layouts.adminMaster')

@section('title')
    Shop List
@endsection

@push('css')
<style>
tr.nowrap td {
        white-space: nowrap;
    }
</style>
@endpush

@section('content')

<div class="card">
    <div class="card-header w3-purple h3">
        Shop List
    </div>
    <div class="card-body">
        @include('admin.roles.sr.srInfo')
        <div class="table-responsive" style="min-height: 500px;">
            <table class="table table-bordered table-sm table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Action</th>
                        <th>Status</th>
                        <th>Shop Name</th>
                        <th>Owner Name</th>
                        <th>Mobile</th>
                        <th>Description</th>
                        <th>Address</th>
                        <th>Type</th>
                        <th>Added By</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shops as $shop)
                        <tr class="nowrap">
                            <td>{{ $loop->iteration+($shops->perPage()*($shops->currentPage()-1)) }}</td>
                            <td>
                                <div class="btn-group">
                                    <a  class="btn btn-success text-white" href="{{ route('admin.shop.edit', $shop) }}"><i class="fa fa-edit"></i></a>
                                    <button type="button" class="btn w3-deep-orange dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('admin.shop.orders', $shop) }}">Orders</a>
                                        <a class="dropdown-item" href="{{ route('admin.shop.collections', $shop) }}">Collections</a>
                                        <a class="dropdown-item" href="{{ route('admin.shop.returns', $shop) }}">Returns</a>
                                        <a class="dropdown-item" href="{{ route('admin.shop.comissions', $shop) }}">Commissions</a>
                                    </div>
                                  </div>
                            </td>
                            <td>{{ $shop->active ? 'Active' : 'Inactive' }}</td>
                            <td>{{ $shop->name }}</td>
                            <td>{{ $shop->owner_name }}</td>
                            <td>{{ $shop->mobile }}</td>
                            <td> {{ $shop->description }}</td>
                            <td>{{ $shop->address }}</td>
                            <td>{{ Str::ucfirst($shop->type) }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="responsive">
            {{ $shops->links() }}
        </div>
    </div>
</div>


@endsection


@push('js')
<script>

</script>
@endpush
