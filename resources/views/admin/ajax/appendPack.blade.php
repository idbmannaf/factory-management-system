
    <div class="row pt-2" id="deletePack">
        <div class="col-md-3 col-12">
            <select name="pack_material[]" id="raw" class="form-control" required>
                <option value="">Select Packaging materials</option>
                @foreach($packMaterials as $pack)
                    <option value="{{$pack->id}}">{{$pack->name}} ({{$pack->unit . $pack->unit_value}})</option>
                    @endforeach
            </select>
        </div>
        <div class="col-md-3 col-12">
            <select name="pack_suppliers[]" id="raw" class="form-control" required>
                <option value="">Suppliers</option>
                @foreach($suppliers as $supplier)
                    <option value="{{$supplier->id}}">{{$supplier->name}} </option>
                    @endforeach
            </select>
        </div>
        <div class="col-md-2 col-12">
            <input type="number" required name="pack_quantity[]" placeholder="Quantity" class="form-control">
        </div>
        <div class="col-md-4 col-12">
            <div class="row">
                <div class="col-md-8">
                    <input type="number" required name="pack_price[]" placeholder="Price" class="form-control">
                </div>
                <div class="col-md-4">
                    <button class="btn btn-danger btn-sm packRemoveBtn"  type="button" data-url="{{route('production.materialsAjax',['type'=>'Pack'])}}"> <i class="fas fa-times"></i></button>
                </div>
            </div>
        </div>
    </div>
