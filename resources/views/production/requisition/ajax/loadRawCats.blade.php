<div class="form-group">
    <label for="raw-cat">Medicine Type</label>
    <select name="medicine_type_id" id="medicine_type_id" class="form-control medicine_type_id" data-url="{{ route('production.loadData',['type'=>'products']) }}">
        <option value="">Select Medicine Type</option>
        @foreach ($medicine_types as $medicine)
        <option value="{{$medicine->id}}">{{json_decode($medicine->name)->en}}</option>
        @endforeach
    </select>

</div>
