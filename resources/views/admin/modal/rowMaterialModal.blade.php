{{-- Supplier Edit Modal --}}
<div class="modal" id="edit{{ $raw->id }}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit {{ $raw->name }}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('admin.updateMaterials', ['material' => $raw->id, 'type' => 'raw']) }}" method="post">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $raw->name }}"
                            placeholder="Enter Name..">
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" id="category" class="form-control">
                            <option value="">Select Category</option>
                            @foreach ($categories as $cat)
                                <option {{ $cat->id == $raw->category_id ? 'selected' : '' }}
                                    value="{{ $cat->id }}">{{ ucfirst($cat->name) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <select name="unit" id="unit" class="form-control">
                            <option value="">Select Unit</option>
                            @foreach (config('parameter.raw_unit') as $unit)
                                <option {{ $raw->unit == $unit ? 'selected' : '' }} value="{{ $unit }}">
                                    {{ ucfirst($unit) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="unit_value">Unit Value</label>
                        <input type="number" id="unit_value" name="unit_value" value="{{ $raw->unit_value }}"
                            class="form-control" placeholder="Unit Value..">
                    </div>

                    <label for="active">
                        <input type="checkbox" name="active" {{ $raw->active ? 'checked' : '' }} id="active"> Active
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
<div class="modal" id="view{{ $raw->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">{{ $raw->name }}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p><b>Name: </b> {{ $raw->name }}</p>
                <p><b>Category: </b> {{ $raw->category ? $raw->category->name : ''}}</p>
                <p><b>Unit: </b> {{ $raw->unit }}</p>
                <p><b>Unit Value: </b> {{ $raw->unit_value }}</p>

                <p><b>Active: </b>
                    @if ($raw->active)
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
