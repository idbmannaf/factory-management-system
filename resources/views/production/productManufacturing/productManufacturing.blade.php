@extends('production.layouts.productionMaster')

@section('title')
    Production Dashboard - Prduct Manufacturing
@endsection
@push('css')
@endpush

@section('content')
    <section class="content">
        <br>
        @include('alerts.alerts')
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4>{{ $status }} Product Manufacturing
                            @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('add_products'))
                                <a href="{{ route('production.AddProductManufacturing') }}" class="btn btn-info"><i
                                        class="fas fa-plus"></i></a>
                            @endif
                        </h4>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered nowrap">
                        <thead>
                            <th>#ID</th>
                            <th>Action</th>
                            <th>Sample Name</th>
                            <th>Name</th>
                            <th>Unit</th>
                            <th>Unit Value</th>
                            {{-- <th>Unit Price</th>
                            <th>Total Price</th> --}}
                            <th>Status</th>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>

                                    <td>{{ $product->id }}</td>
                                    <td>
                                        <a href="{{ route('production.viewProductManufacturing', $product) }}"
                                            class="text-success"><i class="fas fa-eye"></i></a>
                                        @if ($product->status == 'pending')
                                            @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('edit_products'))
                                                <a href="{{ route('production.editProductManufacturing', $product) }}"
                                                    class="text-info"><i class="fas fa-edit"></i></a>
                                            @endif
                                            @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('delete_products'))
                                                <form class="d-inline"
                                                    action="{{ route('production.deleteProductManufacturing', $product) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="text-danger " type="submit"
                                                        onclick="return confirm('Are you sure? you want to delete this Product?')"
                                                        style="background-color: transparent; border:none;"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            @endif
                                        @endif
                                        @if ($product->status == 'confirmed')
                                            <a class='badge badge-success'
                                                href="{{ route('production.viewProductManufacturing', $product) }}"> Ready
                                                To
                                                processing</a>
                                        @endif
                                        @if ($product->status == 'processing')
                                            <a class='badge badge-success'
                                                href="{{ route('production.viewProductManufacturing', $product) }}"> Ready
                                                To
                                                packaging</a>
                                        @endif
                                        @if ($product->status == 'packaging')
                                            <a class='badge badge-success'
                                                href="{{ route('production.viewProductManufacturing', $product) }}"> Ready
                                                To
                                                Stock</a>
                                        @endif
                                    </td>
                                    <td>{{ $product->sample_name }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->unit }}</td>
                                    <td>{{ $product->unit_value }}</td>
                                    {{-- <td>{{ $product->unit_price }}</td>
                                    <td>{{ $product->total_price }}</td> --}}
                                    <td>{{ $product->status }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="test-danger h5">No {{ $status }} Manufacture Product found
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('js')
@endpush
