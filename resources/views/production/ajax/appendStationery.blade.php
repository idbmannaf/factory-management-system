
    <div class="row pt-2 batch" id="deleteStationery">
        <div class="col-md-3 col-12">
            <select name="stationery_material[]" id="raw" class="form-control raw_id" required data-url="{{route('admin.checkRawBatch')}}">
                <option value="">Select Stationery materials</option>
                @foreach($stationeryMaterials as $stationery)
                    <option value="{{$stationery->id}}">{{$stationery->name}} ({{$stationery->unit . $stationery->unit_value}})</option>
                    @endforeach
            </select>
        </div>
        <div class="col-md-2 col-12">
            <input type="number" required name="stationery_quantity[]" placeholder="Quantity" class="form-control">
        </div>
        <div class="col-md-3 col-12 showBatch">

        </div>
        <div class="col-md-2 col-12">
            <div class="row">
                <div class="col-md-4">
                    <button class="btn btn-danger btn-sm stationeryRemoveBtn"  type="button" data-url="{{route('production.materialsAjax',['type'=>'stationery'])}}"> <i class="fas fa-times"></i></button>
                </div>
            </div>
        </div>
    </div>
