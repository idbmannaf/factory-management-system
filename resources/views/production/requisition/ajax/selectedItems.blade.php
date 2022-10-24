<div class="card pt-3">
    <div class="card-header bg-info">Selected Items</div>
    <div class="card-body selectedProductM">
        <div class="table-responsive">
            <table class="table table-borderd" style="white-space: nowrap">
                <thead>
                    <tr>
                        <th></th>
                        <th>Qty</th>
                        <th>Name</th>
                        <th>Unit</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tempPacks as $tp)
                    <tr>
                        <td><input type="checkbox" class="input-select-unselect-temp" data-temp-id="{{$tp->id}}"
                                data-unselect-url="{{route('production.unSelectProduct',['pack_material'=>$tp->pack_id])}}"
                                name="ids" value="{{$tp->id}}" checked> </td>
                        <td>
@csrf
                            <input type="hidden" name="product[]" value="{{$tp->product_id}}">

                            <div class="incrementbtn">
                                @if (Agent::isMobile())
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <input type="number" name="qty[]" class="quantity_update form-control"
                                                value="">
                                        </div>
                                        <div class="col-12 pt-1">
                                            <div class="d-flex justify-content-between py-1">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-danger btn-sm minus">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-primary btn-sm plus">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="input-group input-spinner ">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-danger btn-sm minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="number" name="qty[]" class="quantity_update form-control text-center" style="width: 80px;" value="{{$tp->qty}}" data-url="{{route('production.updateQuanity',['temp'=>$tp->id])}}">

                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary btn-sm plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                        </td>
                        <td data-toggle="tooltip" data-placement="top" title="{{$tp->product_name}}">({{$tp->id}}) {{$tp->materials ? $tp->materials->name : ''}} </td>
                        <td>{{$tp->unit_value." ". $tp->unit}}</td>
                        <td>{{($tp->materials ? $tp->materials->product_type_value : '')." ". ($tp->materials ? $tp->materials->product_type : '')}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@csrf
<h4 class="text-center m-0 p-0 py-2"><button class="btn w3-purple  px-3 py-2" type="submit"><i class="fas fa-save"></i>
       Submit</button></h4>
