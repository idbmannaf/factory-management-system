{{-- Supplier Edit Modal --}}
<div class="modal" id="edit{{ $stationery->id }}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit {{ $stationery->name }}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('admin.updateMaterials', ['material' => $stationery->id, 'type' => 'stationery']) }}" method="post">
            @csrf
            <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $stationery->name }}"
                               placeholder="Enter Name..">
                    </div>

                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <select name="unit" id="unit" class="form-control">
                            <option value="">Select Unit</option>
                            @foreach (config('parameter.all_unit') as $unit)
                                <option {{ $stationery->unit == $unit ? 'selected' : '' }} value="{{ $unit }}">
                                    {{ ucfirst($unit) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="unit_value">Unit Value</label>
                        <input type="number" id="unit_value" name="unit_value" value="{{ $stationery->unit_value }}"
                               class="form-control" placeholder="Unit Value..">
                    </div>

                    <label for="active">
                        <input type="checkbox" name="active" {{ $stationery->active ? 'checked' : '' }} id="active"> Active
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
<div class="modal" id="view{{ $stationery->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">{{ $stationery->name }}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p><b>Name: </b> {{ $stationery->name }}</p>
                <p><b>Unit: </b> {{ $stationery->unit }}</p>
                <p><b>Unit Value: </b> {{ $stationery->unit_value }}</p>

                <p><b>Active: </b>
                    @if ($stationery->active)
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
