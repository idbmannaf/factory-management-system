@extends('accounts.layouts.accountMaster')

@section('title')
account Dashboard - Prduct Manufacturing
@endsection
@push('css')
@endpush

@section('content')
<section class="content">
    <br>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h4>View Product Manufacturing - {{$product->name}} </h4>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <p><b>Product Name: </b>{{$product->name}}</p>
                        <p><b>Product Unit: </b>{{$product->unit}}</p>
                        <p><b>Product Unit Value: </b>{{$product->unit_value}}</p>
                        <p><b>Product Total Unit Price: </b>{{$product->unit_price}}</p>
                        <p><b>Product Total Price: </b>{{$product->total_price}}</p>
                        <p><b>Status: </b>
                            @if ($product->status == 'pending')
                            <span class="badge badge-danger">Pending</span>
                            @elseif ($product->status == 'confirmed')
                            <span class="badge badge-warning">Confirmed</span>
                            @elseif ($product->status == 'processing')
                            <span class="badge badge-info">Processing</span>
                            @elseif ($product->status == 'packaging')
                            <span class="badge badge-success">Packaging</span>
                            @elseif ($product->status == 'ready_to_stock')
                            <span class="badge badge-info">Ready To Stock</span>
                            @elseif ($product->status == 'in_stoked')
                            <span class="badge badge-success">In Stoked</span>
                            @else
                            {{$product->status}}
                            @endif
                        </p>
                    </div>
                </div>
                <h4><b>Raw Materials</b></h4>
                @include('accounts.productManufacturing.ajax.rawProductMaterials')

                @if ($product->status == 'pending')
                <form action="{{route('account.updateProductManufacturing',['product'=>$product,'status'=>'confirm'])}}"
                    method="POST">
                    @csrf
                    <button type="submit" class="btn btn-info btnConfirm" name="confirm"
                        value="confirm">Confirm</button>

                </form>

                @endif
                @if ($product->status =='ready_to_stock')
                <h4><b>Packaging</b></h4>
                @include('accounts.productManufacturing.ajax.packProductMaterials')
                <form
                    action="{{route('account.updateProductManufacturing',['product'=>$product,'status'=>'in_stocked'])}}"
                    method="POST">
                    @csrf
                    <button type='submit' class="btn btn-success">Stocked</button>
                </form>
                @endif
            </div>

        </div>
    </div>
</section>
@endsection


@push('js')



@endpush
