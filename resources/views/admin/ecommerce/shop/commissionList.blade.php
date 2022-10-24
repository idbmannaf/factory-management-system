@extends('admin.layouts.adminMaster')
@section('title')
    Shop Commission List
@endsection
@push('css')
<style>

</style>
@endpush

@section('content')

<div class="card">
    <div class="card-header w3-purple h3">
        Shop Commission List
    </div>
    <div class="card-body">
        @include('admin.ecommerce.shop.shopDetails')
        <div class="table-responsive" style="min-height: 75vh;">
            <table class="table table-bordered table-sm table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category</th>
                        <th>Commission % </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($commissions as $commission)
                        <tr>
                            <td>{{ $commission->id }}</td>
                            <td>{{ $commission->category->name }}</td>
                            <td>{{ $commission->commission }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="">
            {{ $commissions->links() }}
        </div>
    </div>
</div>


@endsection


@push('js')
<script>
</script>
@endpush
