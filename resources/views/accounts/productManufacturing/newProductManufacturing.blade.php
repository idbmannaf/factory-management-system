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
            <form action="{{route('account.storeProductManufacturing',['product'=>$product])}}" method="POST">
                @csrf
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Prduct Manufacturing
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-4 pb-2">
                            <select name="" id="sample" data-url="{{route('account.productManufacturingAjax',$product)}}" class="form-control">
                                <option value="">Select Samples</option>
                                @foreach ($samples as $sample)
                                    <option {{$product->sample_id == $sample->id ? 'selected' :''}}  value="{{$sample->id}}">{{$sample->name}}
                                        ({{$sample->unit ."-". $sample->unit_value}})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-5" id="insertSampleItems">
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
                                            {{-- <td>{{\Carbon\Carbon::parse($sampleItem->created_at)->format('d M,Y')}}</td> --}}
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
                        <div class="col-12 col-md-2 d-flex justify-content-center align-items-center my-2">
                            <div class="">
                                <input type="number" data-url="{{route('account.productManufacturingCalculateAjax',$product)}}" value="{{$product->multiply_qty}}" name="multiply" id="qtyMultiply" class="{{$product->sample_id ? 'd-block' : 'd-none'}}" placeholder="Quantity" required min="1">
                            </div>

                        </div>
                        <div class="col-12 col-md-5" id="insertSampleitemsWithPrice">

                        </div>
                    </div>
                   <div class="col-12 m-auto pt-2 text-center">
                       <button type="submit" class="btn btn-info submitBtn" disabled>Submit</button>

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
            var url = $(this).attr('data-url');
            fullUrl= url + "?id=" + sample;
            $.ajax({
                url:fullUrl,
                method:"GET",
                success:function (response){
                    $('#insertSampleItems').html(response);
                    $('#qtyMultiply').show();
                }
            });
        })
        $(document).on('change keyup','#qtyMultiply',function (e){
            var that=$(this);
            var multiply= that.val();
            var sample= $('#sample').val();
            var url = that.attr('data-url')

            var fullUrl= url+"?sample="+sample+"&multiply="+multiply;
            $.ajax({
                url:fullUrl,
                method:"GET",
                success:function (response){
                    $('#insertSampleitemsWithPrice').html(response);
                    $('#qtyMultiply').show();
                    $('.submitBtn').attr('disabled',false);
                }
            });
        });
    </script>
@endpush

