@extends('admin.layouts.adminMaster')

@push('css')
<style>

</style>
@endpush

@section('content')

<div class="card">
    <form action="{{ route('admin.ecommerce.product.store') }}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="card-header w3-purple h3">
        New Products
            <button class="px-5 btn btn-primary float-right"><i class="fa fa-save"></i> Save</button>
    </div>

    <div class="card-body">

        @include('alerts.alerts')

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Product Name (English)</label>
                        <input class="form-control" type="text" name="name_en" value="{{ old('name_en') }}">
                    </div>
                    <div class="form-group">
                        <label for="">Product Name (বাংলা)</label>
                        <input class="form-control" type="text" name="name_bn" value="{{ old('name_bn') }}">
                    </div>

                    <div class="form-group">
                        <label for="">Excerpt (english)</label>
                        <textarea class="form-control" type="text" name="excerpt_en">{{ old('excerpt_en') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Excerpt (বাংলা)</label>
                        <textarea class="form-control" type="text" name="excerpt_bn">{{ old('excerpt_bn') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Description (english)</label>
                        <textarea rows="4" class="form-control" type="text" name="description_en">{{ old('description_en') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Description (বাংলা)</label>
                        <textarea rows="4" class="form-control" type="text" name="description_bn">{{ old('description_bn') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Min Order quantity</label>
                        <div class="input-group mb-3">
                            <input class="form-control" placeholder="ex. 15" type="number" step="1" value="{{ old('min_order_qty') }}" name="min_order_qty">
                            <div class="input-group-append">
                              <span class="input-group-text">unit(s)</span>
                            </div>
                          </div>
                    </div>

                    <div class="form-group">
                        <label for="">Factory Price</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" >&#2547;</span>
                            </div>
                            <input class="form-control" placeholder="ex. 120" type="number" step="0.01" value="{{ old('purchase_price') }}" name="purchase_price">
                          </div>
                    </div>

                    <div class="form-group">
                        <label for="">Sale Price</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text">&#2547;</span>
                            </div>
                            <input class="form-control" placeholder="ex. 140" type="number" step="0.01" value="{{ old('sale_price') }}" name="sale_price">
                          </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">What is in the box (english)</label>
                        <textarea class="form-control" type="text" name="what_in_box_en">{{ old('what_in_box_en') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">What is in the box (বাংলা)</label>
                        <textarea class="form-control" type="text" name="what_in_box_bn">{{ old('what_in_box_bn') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="bonus">bonus</label>
                       <input type="number" name="bonus" id="bonus" class="form-control" placeholder="Bonus">
                    </div>
                    <div class="form-group">
                        <label for="pice">For</label>
                        <input type="number" name="pice" id="pice" class="form-control" placeholder="Bonus For pice">
                    </div>
                    
                    <div class="form-group">
                        <input class="" type="checkbox" name="septic" id="septic" @if(old('septic')) checked @endif>
                        <label for="septic"> Septic (পচনশীল)</label>
                    </div>
                    <div class="form-group">
                        <input class="" type="checkbox" name="liquid" id="liquid" @if(old('liquid')) checked @endif>
                        <label for="liquid"> Liquid</label>
                    </div>
                    <div class="form-group">
                        <input class="" type="checkbox" name="inflammable" id="inflammable" @if(old('inflammable')) checked @endif>
                        <label for="inflammable"> Inflammable (দাহ্য পদার্থ)</label>
                    </div>
                    <div class="form-group">
                        <input class="" type="checkbox" name="pre_order" id="pre_order" @if(old('pre_order')) checked @endif>
                        <label for="pre_order"> Pre Booking</label>
                    </div>
                    <div class="form-group">
                        <input class="" type="checkbox" name="refundable" id="refundable" @if(old('refundable')) checked @endif>
                        <label for="refundable"> Refundable</label>
                    </div>
                    {{-- <div class="form-group">
                        <label class="h6" for="warrenty_type">
                            Warranty type
                        </label>
                        <select class="form-control" name="warrenty_type" id="warrenty_type">
                            <option value="">No Warrenty</option>
                            <option value="replacement_warrenty" @if(old('warrenty_type') && old('warrenty_type') == 'replacement_warrenty') selected @endif>Replacement Warrenty</option>
                            <option value="service_warrenty" @if(old('warrenty_type') && old('warrenty_type') == 'service_warrenty') selected @endif>Service Warranty</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="h6" for="warrenty_period">
                            Warranty type
                        </label>
                        <select class="form-control" name="warrenty_period" id="warrenty_period">
                            <option value="">Warranty days</option>
                            <option value="30" >30 Days</option>
                            <option value="183" >183 Days</option>
                            <option value="365">365 Days</option>
                        </select>
                    </div> --}}
                    <div class="mb-3">
                        <label class="h6" for="category">
                            Select Category
                        </label>
                        <select class="form-control" name="category" id="category">
                            <option value="" selected disabled>Select category</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" @if( old('category') == $cat->id) @endif>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div> 

                    <div class="mb-3">
                        <label class="h6" for="category">
                            Type
                        </label>
                        <select class="form-control" name="type" >
                            <option value="" selected disabled>Select type</option>
                            <option value="class">Class</option>
                            <option value="power">Power</option>
                            <option value="number">Number</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="h6" for="category">
                            Type Value
                        </label>
                        <input type="text" name="type_value" class="form-control" id="">
                    </div>


                    <div class="mb-3">
                        <label class="h6" for="category">
                            Unit
                        </label>
                        <select class="form-control" name="unit" id="category">
                            <option value="" selected disabled>Select category</option>
                            <option value="ml">ml</option>
                            <option value="gm">gm</option>
                            <option value="pc">pc</option>
                        </select>
                    </div>


                    <div class="mb-3">
                        <label class="h6" for="category">
                            Unit Value
                        </label>
                        <input type="text" name="unit_value" class="form-control">
                    </div>


                    <div class="form-group">
                        <label class="h6" for="image">
                            Image
                        </label>
                        <input type="file" class="form-control" name="image">
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button class="px-5 btn btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
{{-- <div class="card">
    <div class="card-header w3-medium text-bold">
        Prices Conditions
    </div>
    <div class="card-body">
        <div id="priceFields">
            @foreach ($product->prices as $price)
            <div class="row my-2 pb-3 border-bottom">
                <div class="col-md-3">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Min Qty.</span>
                        </div>
                        <input type="text" class="form-control" id="min_qty_{{ $price->id }}" value="{{ $price->min_unit }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Purchase Rate &#2547; </span>
                        </div>
                        <input type="text" class="form-control" id="purchase_rate_{{ $price->id }}" value="{{ $price->purchase_price }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Sale Rate &#2547; </span>
                        </div>
                        <input type="text" class="form-control" id="sale_rate_{{ $price->id }}" value="{{ $price->sale_price }}">
                    </div>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-success" id="price_button_{{ $price->id }}" onclick="updatePrice('{{ route('admin.ecommerce.product.priceUpdate', [$product, $price]) }}',{{ $price->id }})"><i class="fa fa-save"></i> </button>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center">
            <button class="btn btn-primary" onclick="addPriceField('{{ route('admin.ecommerce.product.priceUpdate', [$product]) }}')">add more price field</button>
        </div>
    </div>
</div> --}}

@endsection


@push('js')
<script>
function updatePrice(url,id) {
    $(`#price_button_${id}`).html(`<i class="fa fa-save"></i> <i class="fas fa-spinner fa-spin"></i>`)
    let minQty = $(`#min_qty_${id}`).val()
    let purchaseRate = $(`#purchase_rate_${id}`).val()
    let saleRate = $(`#sale_rate_${id}`).val()
    if (minQty && purchaseRate && saleRate) {
        axios.post(url,{
            'min_unit' : minQty,
            'purchase_price' : purchaseRate,
            'sale_price' : saleRate,
        }).then(res =>{
            if (res.status == 200) {
                $(`#price_button_${id}`).html(`<i class="fa fa-save"></i> <i class="fas fa-check"></i>`)
            }else{
                $(`#price_button_${id}`).html(`<i class="fa fa-save"></i> <i class="fas fa-exclamation-triangle text-red"></i>`)
            }
        })
    }else{
        $(`#price_button_${id}`).html(`<i class="fa fa-save"></i> <i class="fas fa-exclamation-triangle text-red"></i>`)
    }
}

var priceFieldsCount = 0
function addPriceField(addNewPriceUrl) {
    priceFieldsCount++
    $(`#priceFields`).append(`
        <div class="row my-2 pb-3 border-bottom">
            <div class="col-md-3">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Min Qty.</span>
                    </div>
                    <input type="text" class="form-control" id="new_min_qty_${priceFieldsCount}" placeholder="ex. 100">
                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Purchase Rate &#2547; </span>
                    </div>
                    <input type="text" class="form-control" id="new_purchase_rate_${priceFieldsCount}" placeholder="ex. 150.50">
                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Sale Rate &#2547; </span>
                    </div>
                    <input type="text" class="form-control" id="new_sale_rate_${priceFieldsCount}" placeholder="ex 180.00">
                </div>
            </div>
            <div class="col-md-1">
                <button class="btn btn-success" id="new_price_button_${priceFieldsCount}" onclick="addNewPrice('${addNewPriceUrl}',${priceFieldsCount})"><i class="fa fa-save"></i> </button>
            </div>
        </div>
    `)
}
function addNewPrice(url,id) {
    $(`#new_price_button_${id}`).html(`<i class="fa fa-save"></i> <i class="fas fa-spinner fa-spin"></i>`)
    let minQty = $(`#new_min_qty_${id}`).val()
    let purchaseRate = $(`#new_purchase_rate_${id}`).val()
    let saleRate = $(`#new_sale_rate_${id}`).val()
    if (minQty && purchaseRate && saleRate) {
        axios.post(url,{
            'min_unit' : minQty,
            'purchase_price' : purchaseRate,
            'sale_price' : saleRate,
        }).then(res =>{
            if (res.status == 200) {
                $(`#new_price_button_${id}`).html(`<i class="fa fa-save"></i> <i class="fas fa-check"></i>`)
            }else{
                $(`#new_price_button_${id}`).html(`<i class="fa fa-save"></i> <i class="fas fa-exclamation-triangle text-red"></i>`)
            }
        })
    }else{
        $(`#new_price_button_${id}`).html(`<i class="fa fa-save"></i> <i class="fas fa-exclamation-triangle text-red"></i>`)
    }
}
</script>
@endpush
