@extends('admin.layouts.adminMaster')

@section('title')
admin Dashboard - Prduct Manufacturing
@endsection
@push('css')
<style>
    input {
        width: 80px;
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
                    <h4>Edit Product Manufacturing - {{$product->name}} </h4>
                </div>
            </div>
            <form action="{{route('admin.updateProductManufacturing',['product'=>$product,'status'=>'update'])}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 col-md-4 pb-2">
                            <select name="sample" id="sample" data-url="{{route('production.productManufacturingAjax',$product)}}" class="form-control">
                                <option value="">Select Samples</option>
                                @foreach ($samples as $sample)
                                    <option {{$product->sample_id == $sample->id ? 'selected' :''}}  value="{{$sample->id}}">{{$sample->name}}
                                        ({{$sample->unit ."-". $sample->unit_value}})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-2 show_sample_unit">
                            <select name="sample_unit" id="sample_unit" class='form-control' required>
                                @if ($product->sample)
                                @if ($product->sample->unit == 'kg' || $product->sample->unit == 'gm')
                                <option value="">Select Unit</option>
                                <option {{ $product->sample->unit == 'kg' ? 'selected' : '' }} value="kg">kg</option>
                                <option {{ $product->sample->unit == 'gm' ? 'selected' : '' }} value="gm">gm</option>
                            @endif
                            @if ($product->sample->unit == 'ltr' || $product->sample->unit == 'ml')
                                <option value="">Select Unit</option>
                                <option {{ $product->sample->unit == 'ltr' ? 'selected' : '' }} value="ltr">Litter</option>
                                <option {{ $product->sample->unit == 'ml' ? 'selected' : '' }} value="ml">ml</option>
                            @endif
                                @endif

                            </select>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="">
                                <input type="number"
                                    data-url="{{route('production.productManufacturingCalculateAjax',$product)}}"
                                    name="multiply" id="qtyMultiply" data-value="{{$product->multiply_qty}}"
                                    class="form-control" placeholder="Quantity"
                                    value="{{$product->multiply_qty}}" required min="1" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-12" id="insertSampleItems">
                            @if ($product->sample_id)
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Raw</th>
                                            <th>Raw Type</th>
                                            <th>Unit</th>
                                            <th>Unit Value</th>
                                            {{-- <th>Created At</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($product->sample->sample_items as $sampleItem)
                                        <tr>
                                            <tr>
                                                <td>{{ $sampleItem->raw ? $sampleItem->raw->name : '' }}</td>
                                                <td>{{ $sampleItem->raw ? $sampleItem->raw->type : '' }}</td>
                                                <td>{{ $sampleItem->unit }}</td>
                                                <td>{{ $sampleItem->unit_value }}</td>
                                            </tr>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-danger h5">No Samples Found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>{{$product->sample->name}}</th>
                                            <th></th>
                                            <th>{{$product->sample->unit}}</th>
                                            <th>{{$product->sample->unit_value}}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            @endif
                        </div>
                        <div class="col-12 col-md-12" id="insertSampleitemsWithPrice">
                            <div  style="border-top: 10px solid gray; padding-bottom:10px; border-redius:30px"></div>
                            <div class="table-responsive">
                                <table class="table table-borderd">
                                    <thead>
                                        <tr>
                                            <th>Materials</th>
                                            <th>in Stock</th>
                                            <th>Required Qty</th>
                                            <th>Unit Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product->product_materials as $product_material)
                                        <tr>
                                            <td>{{$product_material->raw->name}} ({{$product_material->raw->unit}})</td>
                                             <td>{{$product_material->stock->total_quantity}} {{$product_material->raw->unit}}</td>
                                            <td>{{$product_material->quantity}} {{$product_material->unit}}</td>
                                            <td>{{$product_material->unit_price}}</td>
                                            <td>{{$product_material->total_price}}</td>
                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                                <table class="table table-hovered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Unit</th>
                                            <th>Unit Value</th>
                                            <th>Total Unit Price</th>
                                            <th>Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>
                                                <input type="text" style="width: 150px;" name="name"
                                                    value="{{$product->name}}">
                                            </td>
                                            <td>
                                                {{$product->unit}}
                                            </td>
                                            <td>
                                               {{$product->unit_value}}
                                            </td>
                                            <td>
                                              {{$product->unit_price}}
                                            </td>
                                            <td>
                                                {{$product->total_price}}
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 m-auto pt-2 text-center">
                        <button type="submit" class="btn btn-info submitBtn">Update</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection


@push('js')
<script src="{{ asset('js/productManucatrure.js') }}"></script>
<script>

    // $(document).on('change', '#sample', function (e) {
    //     var sample = $(this).val();
    //     if (!sample) {
    //             $('.submitBtn').attr('disabled',true);
    //             return;
    //         }else{
    //             $('.submitBtn').attr('disabled',false);
    //         }
    //     var url = $(this).attr('data-url');
    //     fullUrl= url + "?id=" + sample;
    //     $.ajax({
    //         url:fullUrl,
    //         method:"GET",
    //         success:function (response){
    //             $('#insertSampleItems').html(response);
    //             $('#qtyMultiply').show();
    //         }
    //     });
    // })
    // $(document).on('change keyup','#qtyMultiply',function (e){
    //     var that=$(this);
    //     var multiply= that.val();
    //     var sample= $('#sample').val();
    //     var url = that.attr('data-url')
    //     if (multiply <=0 || !sample) {
    //             $('.submitBtn').attr('disabled',true);
    //             return;
    //         }
    //     var fullUrl= url+"?sample="+sample+"&multiply="+multiply;
    //     $.ajax({
    //         url:fullUrl,
    //         method:"GET",
    //         success:function (response){

    //             $('#insertSampleitemsWithPrice').html(response);
    //             $('#qtyMultiply').show();
    //             if($("#qtyMultiply").attr('data-value') == $("#qtyMultiply").val() ){
    //             $('.submitBtn').attr('disabled',true);
    //         }else{

    //             $('.submitBtn').attr('disabled',false);
    //         }
    //         }
    //     });
    // });

    if($("#qtyMultiply").attr('data-value') == $("#qtyMultiply").val() ){
        $('.submitBtn').attr('disabled',true);
    }
    $(document).on('change keyup',"#qtyMultiply",function(){
        var that= $(this);
        if(that.attr('data-value') == that.val()){
            $('.submitBtn').attr('disabled',true);
        }
    })
</script>

@endpush
