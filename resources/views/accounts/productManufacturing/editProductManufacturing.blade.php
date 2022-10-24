@extends('accounts.layouts.accountMaster')

@section('title')
account Dashboard - Prduct Manufacturing
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
            <form action="{{route('account.updateProductManufacturing',['product'=>$product,'status'=>'update'])}}"
                method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 col-md-4 pb-2">
                            <select name="" id="sample" data-url="{{route('production.productManufacturingAjax',$product)}}" class="form-control">
                                <option value="">Select Samples</option>
                                @foreach ($samples as $sample)
                                    <option {{$product->sample_id == $sample->id ? 'selected' :''}}  value="{{$sample->id}}">{{$sample->name}}
                                        ({{$sample->unit ."-". $sample->unit_value}})
                                    </option>
                                @endforeach
                            </select>
                            {{-- <select name="" id="sample"
                                data-url="{{route('account.productManufacturingAjax',$product)}}" class="form-control">
                                <option selected value="{{$product->sample->id}}">{{$product->sample->name}}
                                    ({{$product->sample->unit ."-". $product->sample->unit_value}})
                                </option>
                            </select> --}}
                        </div>
                        <div class="col-6 col-md-2">
                            <div class="">
                                <input type="number"
                                    data-url="{{route('account.productManufacturingCalculateAjax',$product)}}"
                                    name="multiply" id="qtyMultiply" data-value="{{$product->multiply_qty}}"
                                    class="form-control" placeholder="Quantity"
                                    value="{{$product->multiply_qty}}" required min="1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6" id="insertSampleItems">
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
                                            <td>{{$sampleItem->raw? $sampleItem->raw->name : ''}}</td>
                                            <td>{{$sampleItem->raw? $sampleItem->raw->type : ''}}</td>
                                            <td>{{$sampleItem->raw? $sampleItem->raw->unit : ''}}</td>
                                            <td>{{$sampleItem->unit_value}}</td>
                                            {{-- <td>{{\Carbon\Carbon::parse($sampleItem->created_at)->format('d M,Y')}}
                                            </td> --}}
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
                        <div class="col-12 col-md-6" id="insertSampleitemsWithPrice">
                            <div class="table-responsive">
                                <table class="table table-borderd">
                                    <thead>
                                        <tr>
                                            <th>Raw</th>
                                            <th>in Stock</th>
                                            <th>Qty</th>
                                            <th>Unit Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product->product_materials as $product_material)
                                        <tr>
                                            <td>{{$product_material->raw->name}} {{$product_material->raw->unit_value
                                                .$product_material->raw->unit}}</td>
                                            <td>{{$product_material->stock->total_quantity}}</td>
                                            <td>{{$product_material->quantity}} ({{$product->multiply_qty}})</td>
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
                                            <td>{{$product->sample_name}}</td>
                                            <td>{{$product->sample_unit}} </td>
                                            <td>{{$product->sample_unit_value}} </td>
                                            <td>
                                                {{$product->sample_unit_price}}
                                                <input type="hidden" name="sample_unit_price"
                                                    value="{{$product->sample_unit_price}}">
                                            </td>
                                            <td>
                                                {{$product->sample_total_price}}
                                                <input type="hidden" name="sample_total_price"
                                                    value="{{$product->sample_total_price}}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" style="width: 150px;" name="name"
                                                    value="{{$product->name}}">
                                            </td>
                                            <td>
                                                <input type="text" name="unit" value="{{$product->unit}}">
                                            </td>
                                            <td>
                                                <input type="text" name="unit_value" value="{{$product->unit_value}}">
                                            </td>
                                            <td>
                                                <input type="number" step="any" min="0" name="unit_price"
                                                    value="{{round($product->unit_price)}}">
                                            </td>
                                            <td>
                                                <input type="number"  step="any" min="0" name="total_price"
                                                    value="{{$product->total_price}}">
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 m-auto pt-2 text-center">
                        <button type="submit" class="btn btn-info submitBtn" name="confirm" value="update">Update</button>
                        {{-- <button type="submit" class="btn btn-info btnConfirm" name="confirm" value="confirm">Confirm</button> --}}
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection


@push('js')

<script>
    $(document).on('change', '#sample', function (e) {
        var sample = $(this).val();
        if (!sample) {
                $('.submitBtn').attr('disabled',true);
                return;
            }else{
                $('.submitBtn').attr('disabled',false);
            }
        var url = $(this).attr('data-url');
        fullUrl= url + "?id=" + sample;
        $.ajax({
            url:fullUrl,
            method:"GET",
            success:function (response){
                $('#insertSampleItems').html(response);
            }
        });
    })
    $(document).on('change keyup','#qtyMultiply',function (e){
        var that=$(this);
        var multiply= that.val();
        var sample= $('#sample').val();
        var url = that.attr('data-url')
        if (multiply <=0 || !sample) {
                $('.submitBtn').attr('disabled',true);
                return;
            }
        var fullUrl= url+"?sample="+sample+"&multiply="+multiply;
        $.ajax({
            url:fullUrl,
            method:"GET",
            success:function (response){
                $('#insertSampleitemsWithPrice').html(response);
                if($("#qtyMultiply").attr('data-value') == $("#qtyMultiply").val() ){
                $('.submitBtn').attr('disabled',true);
            }else{

                $('.submitBtn').attr('disabled',false);
            }
            }
        });
    });

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
