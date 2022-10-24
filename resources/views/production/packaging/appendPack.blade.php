
    <div class="row pt-2" id="deletePack" class="deletePack">
        <div class="col-md-3 col-12">
            <select name="pack_material[]" id="raw" class="form-control pack_id"  required data-url="{{route('production.getPrice')}}">
                <option value="">Select Packaging materials</option>
                @foreach($packMaterials as $pack)
                    <option value="{{$pack->id}}">{{$pack->name}} ({{$pack->unit . $pack->unit_value}})</option>
                    @endforeach
            </select>
        </div>
        <div class="col-md-2 col-12">
            <input type="number" value="1" required name="pack_quantity[]" placeholder="Quantity" class="form-control qty">
        </div>

        <div class="col-md-4">
            <button class="btn btn-danger btn-sm packRemoveBtn"  type="button" data-url="{{route('production.materialsAjax',['type'=>'Pack'])}}"> <i class="fas fa-times"></i></button>
        </div>
        <div class="col-12 appendMaterials">

        </div>
    </div>
