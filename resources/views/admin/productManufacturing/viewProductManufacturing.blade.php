@extends('admin.layouts.adminMaster')

@section('title')
    Admin Dashboard - Prduct Manufacturing
@endsection
@push('css')
<style>
    .removeMandetory{
        display: none;
    }
</style>
@endpush

@section('content')
    <section class="content">
        <br>
        @include('alerts.alerts')
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4>View Product Manufacturing - {{ $product->name }} </h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                            <p><b>Product Name: </b>{{ $product->name }}</p>
                            <p><b>Product Unit: </b>{{ $product->unit }}</p>
                            <p><b>Product Unit Value: </b> {{ $product->unit_value }}
                                <input type="hidden" id="productUnitValue" value="{{ $product->unit_value }}">
                                <input type="hidden" id="productUnit" value="{{ $product->unit }}">
                            </p>
                            <p><b>Product Total Unit Price: </b>{{ $product->unit_price }}</p>
                            <p><b>Product Total Price: </b>{{ $product->total_price }}</p>
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
                                    {{ $product->status }}
                                @endif
                            </p>
                        </div>
                    </div>
                    <h4><b>Raw Materials</b></h4>
                    @include(
                        'admin.productManufacturing.ajax.rawProductMaterials'
                    )

                    @if ($product->status == 'pending')
                        <form
                            action="{{ route('admin.updateProductManufacturing', ['product' => $product, 'status' => 'confirm']) }}"
                            method="POST">
                            @csrf
                            <button type="submit" class="btn btn-info btnConfirm" name="confirm"
                                value="confirm">Confirm</button>
                            <button type="submit" class="btn btn-danger btnConfirm" name="confirm"
                                value="reject">Reject</button>
                        </form>
                    @endif

                    @if ($product->status == 'confirmed')
                        <form
                            action="{{ route('admin.updateProductManufacturing', ['product' => $product, 'status' => 'processing']) }}"
                            method="POST">
                            @csrf
                            <button type='submit' class="btn btn-success py-2">Processing</button>
                        </form>
                    @endif
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

                                    {{-- @if (isset($mendotoryPack) && count($mendotoryPack) > 0)
                                        <div class="form-group seeee" ss="kkk">
                                            <fieldset id="madotory" data-attr="s">
                                                <legend>Mandotory</legend>
                                                <span class="text-danger msg"></span> <br>
                                                <select name="m_stock_id" id="stock_id" class="from-control " required
                                                    data-url="{{ route('admin.getUnit') }}">
                                                    <option value="">Select Mandotory Pack</option>
                                                    @foreach ($mendotoryPack as $mp)
                                                        <option value="{{ $mp->id }}">{{ $mp->raw->name }}
                                                            {{ $mp->raw->unit_value . $mp->raw->unit }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="number" class="qty mandotoryQty" name="m_qty" value="1"
                                                    placeholder="quantity" data-url="{{ route('admin.getUnit') }}">
                                                <input type="hidden" id="unitValue" value="0">
                                                Current Stock: {{ $mp->raw->totalBatchQuantity() }}</strong>
                                            </fieldset>
                                        </div>
                                    @endif

                                    @if (isset($optionalPack))
                                        <div class="form-group">
                                            <fieldset>
                                                <legend>Optional</legend>
                                                @foreach ($optionalPack as $op)
                                                    <label for="stock{{ $op->id }}"> <input type="checkbox"
                                                            class="stock_select" name="stock_id[]"
                                                            value="{{ $op->id }}" id="stock{{ $op->id }}">
                                                        {{ $op->raw->name }}
                                                        {{ $op->raw->unit_value . $op->raw->unit }}
                                                        <input type="number" name="qty[]"
                                                            {{ $op->raw->mandatory_qty ? 'readonly' : '' }}
                                                            class="selectQty" placeholder="quantity">
                                                        <input type="hidden" name="unitValue"
                                                            value="{{ $op->raw->unit_value }}">
                                                        <strong class="curentStock">Current Stock:
                                                            {{ $op->raw->totalBatchQuantity() }}</strong>
                                                    </label>
                                                @endforeach
                                            </fieldset>

                                        </div>
                                    @endif --}}


                                    <button type='submit' class="btn btn-success py-2 packBtn">Packaging</button>
                                </form>


                            </div>
                        </div>
                    @endif

                    @if ($product->status == 'packaging')
                        <h4><b>Packaging Materials</b></h4>
                        @include(
                            'admin.productManufacturing.ajax.packProductMaterials'
                        )
                        <form
                            action="{{ route('admin.updateProductManufacturing', ['product' => $product, 'status' => 'ready_to_stock']) }}"
                            method="POST">
                            @csrf
                            <button type='submit' class="btn btn-success py-2">Ready To Stock</button>
                        </form>
                    @endif
                    @if ($product->status == 'ready_to_stock')
                        <h4><b>Packaging</b></h4>
                        @include(
                            'accounts.productManufacturing.ajax.packProductMaterials'
                        )
                        <form
                            action="{{ route('admin.updateProductManufacturing', ['product' => $product, 'status' => 'in_stocked']) }}"
                            method="POST">
                            @csrf
                            <button type='submit' class="btn btn-success">Stocked</button>
                        </form>
                    @endif

                    @if ($product->status == 'in_stocked')
                        <h4><b>Packaging</b></h4>
                        @include(
                            'accounts.productManufacturing.ajax.packProductMaterials'
                        )
                    @endif

                </div>

            </div>
        </div>
    </section>
@endsection


@push('js')
    <script src="{{ asset('js/viewProductManucatrure.js') }}"></script>
@endpush
