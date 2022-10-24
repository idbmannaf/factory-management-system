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
                    <h4>View Product Manufacturing - {{$product->name}} </h4>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <p><b>Product Name: </b>{{$product->name}}</p>
                        <p><b>Product Unit: </b>{{$product->unit}}</p>
                        <p><b>Product Unit Value: </b>{{$product->unit_value}}</p>
                        {{-- <p><b>Product Total Unit Price: </b>{{$product->unit_price}}</p>
                        <p><b>Product Total Price: </b>{{$product->total_price}}</p> --}}
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
                @include('production.productManufacturing.ajax.rawProductMaterials')

                @if ($product->status =='confirmed')
                <form
                    action="{{route('production.updateProductManufacturing',['product'=>$product,'status'=>'processing'])}}"
                    method="POST">
                    @csrf
                    <button type='submit' class="btn btn-success py-2">Processing</button>
                </form>
                @endif
                {{-- @if ($product->status == 'processing')
                    <div class="card mt-2">
                        <div class="card-header bg-info">Packaging</div>
                        <div class="card-body">
                            <form
                        action="{{route('production.updateProductManufacturing',['product'=>$product,'status'=>'packaging'])}}"
                        method="POST">
                        @csrf
                            <div class="row">
                                <div class="col-12 col-md-2">
                                    <h4>Packaging <a id="addPack" class="btn btn-info"
                                            href="{{route('production.packaging')}}" data-prev-id=""><i class="fas fa-plus"></i></a></h4>
                                </div>
                            </div>
                            <div class="showPack py-2">
                            </div>
                            <button type='submit' class="btn btn-success py-2 packBtn">Packaging</button>
                    </form>
                        </div>
                    </div>
                @endif --}}

                @if ($product->status == 'processing')
                <div class="card mt-2">
                    <div class="card-header bg-info">Packaging</div>
                    <div class="card-body">
                        <form
                            action="{{ route('admin.updateProductManufacturing', ['product' => $product, 'status' => 'packaging']) }}"
                            method="POST">
                            @csrf
                            <div id="packShow">
                              @include('admin.productManufacturing.ajax.packagingMaterialsAppend')
                              <input type="hidden" id="checkIfHaveLastTemp" data-url={{route('admin.checkIfHaveLastTemp',['product'=>$product])}}>
                            </div>
                            <button type='submit' class="btn btn-success py-2 packBtn">Packaging</button>
                        </form>


                    </div>
                </div>
            @endif
                @if ($product->status =='packaging')
                <h4><b>Packaging Materials</b></h4>
                 @include('production.productManufacturing.ajax.packProductMaterials')
                <form
                    action="{{route('production.updateProductManufacturing',['product'=>$product,'status'=>'ready_to_stock'])}}"
                    method="POST">
                    @csrf
                    <button type='submit' class="btn btn-success py-2">Ready To Stock</button>
                </form>
                @endif

                @if ($product->status =='ready_to_stock')
                <h4><b>Packaging</b></h4>
                @include('accounts.productManufacturing.ajax.packProductMaterials')

                @endif

            </div>

        </div>
    </div>
</section>
@endsection


@push('js')
<script src="{{ asset('js/viewProductManucatrure.js') }}"></script>

@endpush
