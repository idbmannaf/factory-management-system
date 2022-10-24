<div class="row pt-2 closeDiv">
    <div class="col-12 col-md-4">
        <select name="raw_id[]" id="raw_id" class="form-control raw" required data-unit-check-url="{{route('admin.checkRawUnit',['type'=>'raw'])}}">
            <option value="">Select Raw</option>
            @foreach($raws as $raw)
                <option value="{{$raw->id}}">{{$raw->name}}({{$raw->unit}})
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-12 col-md-2 showUnit">

    </div>
    <div class="col-12 col-md-4">
        <input type="number" step="any" min="0"  name="unit_item_value[]" class="form-control" placeholder="Unit Value" required>
    </div>
    <div class="col-12 col-md-2 ">

        <button type="button" class="btn btn-danger deleteBtn"><i class="fas fa-trash"></i></button>
    </div>
</div>
