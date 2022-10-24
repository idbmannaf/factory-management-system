<div class="row pt-2" id="deleteRaw">
        <div class="col-md-3 col-12">
            <select name="raw_material[]" id="raw" class="form-control" required>
                <option value="">Select Row materials</option>
                @foreach($rawMaterials as $raw)
                    <option value="{{$raw->id}}">{{$raw->name}} ({{$raw->unit . $raw->unit_value}})</option>
                    @endforeach
            </select>
        </div>
        <div class="col-md-3 col-12">
            <select name="raw_suppliers[]" id="raw" class="form-control" required>
                <option value="">Suppliers</option>
                @foreach($suppliers as $supplier)
                    <option value="{{$supplier->id}}">{{$supplier->name}} </option>
                    @endforeach
            </select>
        </div>
        <div class="col-md-2 col-12">
            <input type="number" required name="raw_quantity[]" placeholder="Quantity" class="form-control">
        </div>
        <div class="col-md-4 col-12">
            <div class="row">
                <div class="col-md-8">
                    <input type="number" required name="raw_price[]" placeholder="Price" class="form-control">
                </div>
                <div class="col-md-4">
                    <button class="btn btn-danger btn-sm rawRemoveBtn"  type="button" data-url="{{route('production.materialsAjax',['type'=>'raw'])}}"> <i class="fas fa-times"></i></button>
                </div>
            </div>
        </div>
    </div>
