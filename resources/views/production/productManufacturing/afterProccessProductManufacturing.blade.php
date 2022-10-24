@extends('production.layouts.productionMaster')

@section('title')
    production Dashboard - Prduct Manufacturing
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
                        {{-- <h4>{{ $status }} Product Manufacturing <a
                                href="{{ route('admin.AddProductManufacturing') }}" class="btn btn-info"><i
                                    class="fas fa-plus"></i></a></h4> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">



                        @if ($status != 'in_stocked')
                            <table class="table table-bordered text-nowrap">
                                <thead>
                                    <th>#ID</th>
                                    <th>Action</th>
                                    <th>Sample Name</th>
                                    <th>Product Name</th>
                                    <th>Unit</th>
                                    <th>Unit Value</th>
                                    <th>Packaging Quantity</th>
                                    {{-- <th>Unit Price</th>
                                    <th>Total Price</th> --}}
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>
                                                <a href="{{ route('production.viewProductManufacturingAfterProccess', $product) }}"
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
                                                        href="{{ route('production.viewProductManufacturingAfterProccess', $product) }}"> Ready
                                                        To
                                                        Stock</a>
                                                @endif
                                            </td>
                                            <td>{{ $product->product->sample_name }}</td>
                                            <td>{{ $product->product->name }}</td>
                                            <td>{{ $product->unit }}</td>
                                            <td>{{ $product->unit_value }}</td>
                                            <td>{{ $product->packaging_quantity }}</td>
                                            {{-- <td>{{ $product->unit_price }}</td>
                                            <td>{{ $product->total_price }}</td> --}}
                                            <td>{{ $product->status }}</td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="test-danger h5">No {{ $status }} Manufacture
                                                Product found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        @else
                            <table class="table table-bordered text-nowrap">
                                <thead>
                                    <th>#ID</th>
                                    <th>Product Name</th>
                                    <th>Unit</th>
                                    <th>Unit Value</th>
                                    <th>Unit Price</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <?php
                                        $gropProducts = \App\Models\AfterProccessProduct::where('product_id', $product->product_id)->where('unit', $product->unit)->where('unit_value', $product->unit_value);
                                        ?>
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->product->sample->name }}</td>
                                            <td>{{ $product->unit }}</td>
                                            <td>{{ $product->unit_value }}</td>
                                            <td>{{ $product->unit_price }}</td>
                                            <td>{{ $gropProducts->sum('packaging_quantity') }}</td>

                                            <td>
                                                @if (count($gropProducts->get()) > 0)
                                                    <a class="btn btn-primary btn-xs" data-toggle="collapse"
                                                        href="#collapseExample{{ $product->id }}" role="button"
                                                        aria-expanded="false" aria-controls="collapseExample">
                                                        Details
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="7">
                                                <div class="collapse" id="collapseExample{{ $product->id }}">
                                                    <div class="table-responsive">
                                                        <table class="table table-sm table-bordered text-nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th></th>
                                                                    <th>Unit</th>
                                                                    <th>Unit_value</th>
                                                                    <th>Unit_Price</th>
                                                                    <th>Qty</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($gropProducts->get() as $item)
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td>{{ $item->unit }}</td>
                                                                        <td>{{ $item->unit_value }}</td>
                                                                        <td>{{ $item->unit_price }}</td>
                                                                        <td>{{ $item->packaging_quantity }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('js')
@endpush
