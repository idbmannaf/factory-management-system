@extends('accounts.layouts.accountMaster')

@section('title')
Sccount Dashboard - Product Manufacturing
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
                    <h4> {{$status}} Product Manufacturing </h4>
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
                        <th>Unit Price</th>
                        <th>Total Price</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>
                                <a href="{{route('account.viewProductManufacturing',$product)}}" class="text-success"><i
                                        class="fas fa-eye"></i></a>
                                @if ($product->status == 'pending')
                                <a href="{{route('account.editProductManufacturing',$product)}}" class="text-info"><i
                                        class="fas fa-edit"></i></a>

                                <form class="d-inline" action="{{route('account.deleteProductManufacturing',$product)}}"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="text-danger " type="submit"
                                        onclick="return confirm('Are you sure? you want to delete this Product?')"
                                        style="background-color: transparent; border:none;"><i
                                            class="fas fa-trash"></i></button>
                                </form>
                                @endif
                                @if ($product->status =='pending')
                                <a class='badge badge-success'
                                    href="{{route('account.viewProductManufacturing',$product)}}"> Ready To
                                    Confirm</a>
                                @endif
                                @if ($product->status =='ready_to_stock')

                                <a class='badge badge-success'
                                    href="{{route('account.viewProductManufacturing',$product)}}"> Ready To Stoked In</a>
                                @endif

                            </td>
                            <td>{{$product->sample_name}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->unit}}</td>
                            <td>{{$product->unit_value}}</td>
                            <td>{{$product->unit_price}}</td>
                            <td>{{$product->total_price}}</td>
                            <td>{{$product->status}}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-danger h5">No {{$status}} Manufacturing Product Found</td>
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
