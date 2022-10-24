{{-- Supplier Edit Modal --}}
<div class="modal" id="edit{{ $pack->id }}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit {{ $pack->name }}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('admin.updateMaterials', ['material' => $pack->id, 'type' => 'pack']) }}" method="post">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $pack->name }}"
                            placeholder="Enter Name..">
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" id="category" class="form-control">
                            <option value="">Select Category</option>
                            @foreach ($categories as $cat)
                                <option {{ $cat->id == $pack->category_id ? 'selected' : '' }}
                                    value="{{ $cat->id }}">{{ ucfirst($cat->name) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="medicine_type">Medicine Type</label>
                        <select name="medicine_type" id="medicine_type" class="form-control">
                            <option value="">Select Medicine Type</option>

                            @foreach ($medicine_types as $medicine)
                            <option value="{{ $medicine->id }}" {{ $medicine->id == $pack->dhpl_cat_id ? 'selected' : '' }}>
                                {{ ucfirst(json_decode($medicine->name)->en) }}
                            </option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <select name="unit" id="unit" class="form-control">
                            <option value="">Select Unit</option>
                            @foreach (config('parameter.all_unit') as $unit)
                                <option {{ $pack->unit == $unit ? 'selected' : '' }} value="{{ $unit }}">
                                    {{ ucfirst($unit) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="unit_value">Unit Value</label>
                        <input type="number" id="unit_value" name="unit_value" value="{{ $pack->unit_value }}"
                            class="form-control" placeholder="Unit Value..">
                    </div>

                    <label for="mandatory{{$pack->id}}">
                        <input type="checkbox" name="mandatory" {{ $pack->mandatory ? 'checked' : '' }} id="mandatory{{$pack->id}}"> Mandatory
                    </label> <br>
                    <label for="active">
                        <input type="checkbox" name="active" {{ $pack->active ? 'checked' : '' }} id="active"> Active
                    </label>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>


{{-- Supplier View Modal --}}
<div class="modal" id="view{{ $pack->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">{{ $pack->name }}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p><b>Name: </b> {{ $pack->name }}</p>
                <p><b>Category: </b> {{ $pack->category ? $pack->category->name : '' }}</p>
                <p><b>Medicine Type: </b> {{ ucfirst(json_decode($medicine->name)->en) }}</p>
                <p><b>Unit: </b> {{ $pack->unit }}</p>
                <p><b>Unit Value: </b> {{ $pack->unit_value }}</p>
                <p><b>Mandatory: </b>
                    @if ($pack->mandatory)
                        <span class="badge badge-success">Mandatory</span>
                    @else
                        <span class="badge badge-danger">Optional</span>
                    @endif
                </p>
                <p><b>Active: </b>
                    @if ($pack->active)
                        <span class="badge badge-success">Activated</span>
                    @else
                        <span class="badge badge-danger">InActivated</span>
                    @endif
                </p>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
