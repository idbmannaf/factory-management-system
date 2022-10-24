@extends('purchase.layouts.purchaseMaster')

@section('title')
Purchase Manager Dashboard
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
                        Requisitions Edit
                    </div>
                </div>
                <div class="card-body">
                    <h5>Requisition </h5>
                    <p><b>User: </b>{{$requisition->user ? $requisition->user->id : ''}}</p>
                    <p><b>Date: </b>{{$requisition->date}}</p>
                    <p><b>Total Quantity: </b>{{$requisition->total_quantity}}</p>
                    <p><b>Total Price: </b>{{$requisition->total_price}}</p>
                    <p><b>Status: </b>{{$requisition->status}}</p>


                </div>
                <div class="card-body">
                    <form action="{{route('production.updateRequisition',['requisition'=>$requisition->id,'type'=>'update'])}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="date" >Date</label>
                            <input type="date" value="{{$requisition->date ? \Carbon\Carbon::parse($requisition->date)->format('Y-m-d') :null}}" name="date">
                        </div>
                        <div id="rawAjax">
                            <label for=""><b>Raw Materials</b> <button class="btn btn-info btn-sm rawSubmitBtn"  type="button" data-url="{{route('production.materialsAjax',['type'=>'raw'])}}"> <i class="fas fa-plus"></i></button>
                            </label>
                            @foreach($requisition->raw_materials as $item)
                                <div class="row pt-2" id="deleteRaw">
                                    <div class="col-md-3 col-12">
                                        <select name="raw_material[]" id="raw" class="form-control" required>
                                            <option value="">Select Row materials</option>
                                            @forelse($rawMaterials as $raw)
                                                <option {{$item->raw_id == $raw->id ? 'selected' : ''}} value="{{$raw->id}}">{{$raw->name}} ({{$raw->unit . $raw->unit_value}})</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <select name="raw_suppliers[]" id="raw" class="form-control" required>
                                            <option value="">Suppliers</option>
                                            @forelse($suppliers as $supplier)
                                                <option {{$supplier->id == $item->supplier_id ? 'selected' : ''}} value="{{$supplier->id}}">{{$supplier->name}} </option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-12">
                                        <input type="number" required name="raw_quantity[]" value="{{$item->quantity}}" placeholder="Quantity" class="form-control">
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <input type="number" required name="raw_price[]" placeholder="Price" value="{{$item->price}}" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <button class="btn btn-danger btn-sm rawRemoveBtn"  type="button" data-url="{{route('production.materialsAjax',['type'=>'raw'])}}"> <i class="fas fa-times"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach

                        </div>
                        <div class="packAjax pt-3">
                            <label for=""><b>Packaging Materials </b> <button class="btn btn-info btn-sm packSubmitBtn"  type="button" data-url="{{route('production.materialsAjax',['type'=>'Pack'])}}"> <i class="fas fa-plus"></i></button></label>
                            @foreach($requisition->packaging as $item)

                                <div class="row pt-2" id="deletePack">
                                    <div class="col-md-3 col-12">
                                        <select name="pack_material[]" id="raw" class="form-control" required>
                                            <option value="">Select Packaging materials</option>
                                            @foreach($packMaterials as $pack)
                                                {{$item->raw_id }}  {{$pack->id}}
                                                <option {{$item->raw_id == $pack->id ? 'selected' : ''}} value="{{$pack->id}}">{{$pack->name}} ({{$pack->unit . $pack->unit_value}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <select name="pack_suppliers[]" id="raw" class="form-control" required>
                                            <option value="">Suppliers</option>
                                            @foreach($suppliers as $supplier)
                                                <option {{$supplier->id == $item->supplier_id ? 'selected' : ''}} value="{{$supplier->id}}">{{$supplier->name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-12">
                                        <input type="number" required name="pack_quantity[]" value="{{$item->quantity}}" placeholder="Quantity" class="form-control">
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <input type="number" required name="pack_price[]" value="{{$item->price}}" placeholder="Price" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <button class="btn btn-danger btn-sm packRemoveBtn"  type="button" data-url="{{route('production.materialsAjax',['type'=>'Pack'])}}"> <i class="fas fa-times"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>

                        <div class="form-group mt-3">
                            <input type="submit" value="Update" class="btn btn-info">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('js')
    <script>
        $('.rawSubmitBtn').click(function (e){
            e.preventDefault();
            var url = $(this).attr('data-url');
            $.ajax({
                url:url,
                method:"GET",
                success:function (response){
                    $("#rawAjax").append(response);
                }
            });
        });

        $(document).on('click','.rawRemoveBtn',function (e){
            e.preventDefault();
            $(this).closest('#deleteRaw').remove();
        })
        $('.packSubmitBtn').click(function (e){
            e.preventDefault();
            var url = $(this).attr('data-url');
            $.ajax({
                url:url,
                method:"GET",
                success:function (response){
                    $(".packAjax").append(response);
                }
            });
        });

        $(document).on('click','.packRemoveBtn',function (e){
            e.preventDefault();
            $(this).closest('#deletePack').remove();
        })
    </script>
@endpush

