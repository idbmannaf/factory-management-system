@extends('admin.layouts.adminMaster')

@section('title')
    Admin Dashboard - Product Manufacturing
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
                    <div class="d-flex justify-content-between">
                       
                            <div>{{$status}} Product Manufacturing <a href="{{route('admin.AddProductManufacturing')}}" class="btn btn-info"><i class="fas fa-plus"></i></a>
                            </div>

                            <div>
                                @if ($status == 'pending')
                                    <a href="{{ route('downloadNow', ['type' => 'productManufacture', 'status' => 'pending']) }}"
                                        class="btn btn-success btn-sm"> <i class="fas fa-download"> </i>Download</a>
                                @elseif ($status == 'confirmed')
                                    <a href="{{ route('downloadNow', ['type' => 'productManufacture', 'status' => 'confirmed']) }}"
                                        class="btn btn-success btn-sm"> <i class="fas fa-download"> </i>Download</a>
                                @elseif ($status == 'processing')
                                    <a href="{{ route('downloadNow', ['type' => 'productManufacture', 'status' => 'processing']) }}"
                                        class="btn btn-success btn-sm"> <i class="fas fa-download"> </i>Download</a>
                                @elseif ($status == 'packaging')
                                    <a href="{{ route('downloadNow', ['type' => 'productManufacture', 'status' => 'packaging']) }}"
                                        class="btn btn-success btn-sm"> <i class="fas fa-download"> </i>Download</a>
                                @elseif ($status == 'rejected')
                                    <a href="{{ route('downloadNow', ['type' => 'productManufacture', 'status' => 'rejected']) }}"
                                        class="btn btn-success btn-sm"> <i class="fas fa-download"> </i>Download</a>
                                @else
                                    <a href="{{ route('downloadNow', ['type' => 'productManufacture', 'status' => 'all']) }}"
                                        class="btn btn-success btn-sm"> <i class="fas fa-download"> </i>Download</a>
                                @endif

                            </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered nowrap">
                        <thead>
                            <th>#ID</th>
                            <th>Action</th>
                            <th>Sample Name</th>
                            <th>Product Name</th>
                            <th>Unit</th>
                            <th>Unit Value</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>
                                        <a href="{{ route('admin.viewProductManufacturing', $product) }}"
                                            class="text-success"><i class="fas fa-eye"></i></a>

                                        @if ($product->status == 'pending')
                                            <a href="{{ route('admin.editProductManufacturing', $product) }}"
                                                class="text-info"><i class="fas fa-edit"></i></a>
                                            <form class="d-inline"
                                                action="{{ route('admin.deleteProductManufacturing', $product) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="text-danger " type="submit"
                                                    onclick="return confirm('Are you sure? you want to delete this Product?')"
                                                    style="background-color: transparent; border:none;"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        @endif
                                        @if ($product->status == 'pending')
                                            <a class='badge badge-success'
                                                href="{{ route('admin.viewProductManufacturing', $product) }}"> Ready To
                                                Confirm or Reject</a>
                                        @endif
                                        @if ($product->status == 'confirmed')
                                            <a class='badge badge-success'
                                                href="{{ route('admin.viewProductManufacturing', $product) }}"> Ready To
                                                processing</a>
                                        @endif
                                        @if ($product->status == 'processing')
                                            <a class='badge badge-success'
                                                href="{{ route('admin.viewProductManufacturing', $product) }}"> Ready To
                                                packaging</a>
                                        @endif
                                        @if ($product->status == 'packaging')
                                            <a class='badge badge-success'
                                                href="{{ route('admin.viewProductManufacturingAfterProccess', $product) }}">
                                                Ready To Stock</a>
                                        @endif
                                        @if ($product->status == 'ready_to_stock')
                                            <a class='badge badge-success'
                                                href="{{ route('admin.viewProductManufacturingAfterProccess', $product) }}">
                                                Ready To Stock In</a>
                                        @endif
                                    </td>
                                    <td>{{ $product->sample_name }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->unit }}</td>
                                    <td>{{ $product->unit_value }}</td>
                                    <td>{{ $product->unit_price }}</td>
                                    <td>{{ $product->total_price }}</td>
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
