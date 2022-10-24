@extends('production.layouts.productionMaster')

@section('title')
    Production Dashboard
@endsection
@push('css')
@endpush

@section('content')
    <section class="content">
        <br>
        @include('alerts.alerts')
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Requisitions Edit
                    </div>
                </div>
                <div class="card-body">
                    <h5>Requisition </h5>
                    <p><b>User: </b>{{ $requisition->user ? $requisition->user->id : '' }}</p>
                    <p><b>Date: </b>{{ $requisition->date }}</p>
                    <p><b>Total Quantity: </b>{{ $requisition->total_quantity }}</p>
                    <p><b>Total Price: </b>{{ $requisition->total_price }}</p>
                    <p><b>Status: </b>{{ $requisition->status }}</p>


                </div>
                <div class="card-body">
                    <form
                        action="{{ route('production.updateRequisition', ['requisition' => $requisition->id, 'type' => 'update']) }}"
                        method="post">
                        @csrf



                        @if ($requisition->type == 'pack')
                            <input type="hidden" name="req_type" value="pack">
                            <div class="card-body">
                                <h5>Requisition Items</h5>
                                <div class="table-responsive">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Material</th>
                                                <th>Product</th>
                                                <th>Category</th>
                                                <th>Medicin Type</th>
                                                <th>Unit</th>
                                                <th>Quantity</th>
                                                <th>Type</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($requisition->requisition_items as $item)
                                                <tr>
                                                    <td>{{ $item->id }}
                                                        <input type="hidden" name="ids[]" value="{{ $item->id }}">
                                                    </td>
                                                    <td>
                                                        {{ $item->raw_materials ? $item->raw_materials->name : '' }})
                                                    </td>
                                                    <td>
                                                        {{ $item->raw_materials ? $item->raw_materials->product_name : '' }})
                                                    </td>

                                                    <td>{{ $item->packCat ? $item->packCat->name : '' }}</td>
                                                    <td>{{ $item->dhplCat ? json_decode($item->dhplCat->name)->en : '' }}</td>
                                                    <td>
                                                        {{ $item->unit_value . $item->unit }}

                                                    </td>

                                                    <td>
                                                        <input type="number" name="quantities[]"
                                                            value="{{ $item->quantity }}">
                                                    </td>

                                                    <td>{{ $item->raw_type }}</td>


                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-danger ">No Item Found</td>
                                                </tr>
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-end">
                                    @if ($requisition->status == 'purchase')
                                        <input type="hidden" name="status" value="collected">
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-info" value="Collected Now">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date"
                                    value="{{ $requisition->date ? \Carbon\Carbon::parse($requisition->date)->format('Y-m-d') : null }}"
                                    name="date">
                            </div>
                            @if (count($requisition->raw_materials) > 0)
                                <div id="rawAjax">
                                    <label for=""><b>Raw Materials</b> <button class="btn btn-info btn-sm rawSubmitBtn"
                                            type="button"
                                            data-url="{{ route('production.materialsAjax', ['type' => 'raw']) }}"> <i
                                                class="fas fa-plus"></i></button>
                                    </label>
                                    @foreach ($requisition->raw_materials as $item)
                                        <div class="row pt-2 batch" id="deleteRaw">
                                            <div class="col-md-3 col-12">
                                                <select name="raw_material[]" id="raw" class="form-control raw_id" required
                                                    data-url="{{ route('admin.checkRawBatch') }}">
                                                    <option value="">Select Row materials</option>
                                                    @forelse($rawMaterials as $raw)
                                                        <option {{ $item->raw_id == $raw->id ? 'selected' : '' }}
                                                            value="{{ $raw->id }}">{{ $raw->name }}
                                                            ({{ $raw->unit . $raw->unit_value }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2 col-12">
                                                <input type="number" required name="raw_quantity[]" step="1" min="1"
                                                    value="{{ $item->quantity }}" placeholder="Quantity"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-3 col-12 showBatch d-flex justify-items-center">
                                                <b>Stocked Qty:</b>
                                                @if ($item->firstBatch())
                                                    <b>1). </b> {{ $item->firstBatch()->total_quantity }}
                                                @else
                                                    <b>0</b>
                                                @endif
                                                @if ($item->secondBatch())
                                                    <b>, 2). </b>{{ $item->secondBatch()->total_quantity }}
                                                @endif
                                                @if ($item->thirdBatch())
                                                    <b>,3). </b>{{ $item->thirdBatch()->total_quantity }}
                                                @endif
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="row">
                                                    {{-- <div class="col-md-8">
                                                <input type="number" required name="raw_price[]" placeholder="Price" value="{{$item->price}}" class="form-control">
                                            </div> --}}
                                                    <div class="col-md-4">
                                                        <button class="btn btn-danger btn-sm rawRemoveBtn" type="button"
                                                            data-url="{{ route('production.materialsAjax', ['type' => 'raw']) }}">
                                                            <i class="fas fa-times"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            @endif
                            @if (count($requisition->packaging) > 0)
                                <div class="packAjax pt-3">
                                    <label for=""><b>Packaging Materials </b> <button
                                            class="btn btn-info btn-sm packSubmitBtn" type="button"
                                            data-url="{{ route('production.materialsAjax', ['type' => 'Pack']) }}"> <i
                                                class="fas fa-plus"></i></button></label>
                                    @foreach ($requisition->packaging as $item)
                                        <div class="row pt-2 batch" id="deletePack">
                                            <div class="col-md-3 col-12">
                                                <select name="pack_material[]" id="raw" class="form-control raw_id" required
                                                    data-url="{{ route('admin.checkRawBatch') }}">
                                                    <option value="">Select Packaging materials</option>
                                                    @foreach ($packMaterials as $pack)
                                                        {{ $item->raw_id }} {{ $pack->id }}
                                                        <option {{ $item->raw_id == $pack->id ? 'selected' : '' }}
                                                            value="{{ $pack->id }}">{{ $pack->name }}
                                                            ({{ $pack->unit . $pack->unit_value }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2 col-12">
                                                <input type="number" required name="pack_quantity[]"
                                                    value="{{ $item->quantity }}" placeholder="Quantity"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-3 col-12 showBatch d-flex justify-items-center">
                                                <small>
                                                    <b>Current Stock: </b> {{ $item->total_stock() }}
                                                    <b>Total batch:</b> {{ $item->total_batch() }}
                                                </small>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <button class="btn btn-danger btn-sm packRemoveBtn" type="button"
                                                            data-url="{{ route('production.materialsAjax', ['type' => 'Pack']) }}">
                                                            <i class="fas fa-times"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            @if (count($requisition->stationeries) > 0)
                                <div class="stationeryAjax pt-3">
                                    <label for=""><b>Stationeries Materials </b> <button
                                            class="btn btn-info btn-sm packSubmitBtn" type="button"
                                            data-url="{{ route('production.materialsAjax', ['type' => 'stationery']) }}">
                                            <i class="fas fa-plus"></i></button></label>
                                    @foreach ($requisition->stationeries as $item)
                                        <div class="row pt-2 batch" id="deleteStationery">
                                            <div class="col-md-3 col-12">
                                                <select name="pack_material[]" id="raw" class="form-control raw_id" required
                                                    data-url="{{ route('admin.checkRawBatch') }}">
                                                    <option value="">Select Stationeries materials</option>
                                                    @foreach ($packMaterials as $pack)
                                                        {{ $item->raw_id }} {{ $pack->id }}
                                                        <option {{ $item->raw_id == $pack->id ? 'selected' : '' }}
                                                            value="{{ $pack->id }}">{{ $pack->name }}
                                                            ({{ $pack->unit . $pack->unit_value }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2 col-12">
                                                <input type="number" required name="stationery_quantity[]"
                                                    value="{{ $item->quantity }}" placeholder="Quantity"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-3 col-12 showBatch d-flex justify-items-center">
                                                <small>
                                                    <b>Current Stock: </b> {{ $item->total_stock() }}
                                                    <b>Total batch:</b> {{ $item->total_batch() }}
                                                </small>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <button class="btn btn-danger btn-sm stationeryRemoveBtn"
                                                            type="button"
                                                            data-url="{{ route('production.materialsAjax', ['type' => 'stationery']) }}">
                                                            <i class="fas fa-times"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif


                            @if (count($requisition->stationeries) + count($requisition->packaging) + count($requisition->raw_materials) == 0)
                                <div id="rawAjax">
                                    <label for=""><b>Raw Materials</b>
                                        <button class="btn btn-info btn-sm rawSubmitBtn" type="button"
                                            data-url="{{ route('production.materialsAjax', ['type' => 'raw']) }}"><i
                                                class="fas fa-plus"></i></button>
                                    </label>

                                </div>
                                <div class="packAjax pt-3">
                                    <label for=""><b>Packaging Materials </b>
                                        <button class="btn btn-info btn-sm packSubmitBtn" type="button"
                                            data-url="{{ route('production.materialsAjax', ['type' => 'Pack']) }}"><i
                                                class="fas fa-plus"></i></button>
                                    </label>
                                </div>
                                <div class="stationeryAjax pt-3">
                                    <label for=""><b>Stationery Materials </b>
                                        <button class="btn btn-info btn-sm stationerySubmitBtn" type="button"
                                            data-url="{{ route('production.materialsAjax', ['type' => 'stationery']) }}"><i
                                                class="fas fa-plus"></i></button>
                                    </label>
                                </div>

                                {{-- <div class="form-group mt-3"> --}}
                                {{-- <input type="submit" class="btn btn-info"> --}}
                                {{-- </div> --}}
                            @endif
                        @endif

                        <div class="form-group mt-3">
                            <input type="submit" value="Update" class="btn btn-info">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('js')
    <script>
        $('.rawSubmitBtn').click(function(e) {
            e.preventDefault();
            var url = $(this).attr('data-url');
            $.ajax({
                url: url,
                method: "GET",
                success: function(response) {
                    $("#rawAjax").append(response);
                }
            });
        });

        $(document).on('click', '.rawRemoveBtn', function(e) {
            e.preventDefault();
            $(this).closest('#deleteRaw').remove();
        })
        $('.packSubmitBtn').click(function(e) {
            e.preventDefault();
            var url = $(this).attr('data-url');
            $.ajax({
                url: url,
                method: "GET",
                success: function(response) {
                    $(".packAjax").append(response);
                }
            });
        });

        $(document).on('click', '.packRemoveBtn', function(e) {
            e.preventDefault();
            $(this).closest('#deletePack').remove();
        })
        //Stationery
        $('.stationerySubmitBtn').click(function(e) {
            e.preventDefault();
            var url = $(this).attr('data-url');
            $.ajax({
                url: url,
                method: "GET",
                success: function(response) {
                    $(".packAjax").hide();
                    $("#rawAjax").hide();
                    $(".stationeryAjax").append(response);
                }
            });
        });

        $(document).on('click', '.stationeryRemoveBtn', function(e) {
            e.preventDefault();
            $(this).closest('#deleteStationery').remove();
        })



        $(document).on('change', '.raw_id', function() {
            var that = $(this);
            var raw = that.val();

            var url = that.attr('data-url');
            var fullUrl = url + "?raw=" + raw;
            $.ajax({
                url: fullUrl,
                method: "GET",
                success: function(response) {
                    console.log(response)
                    that.closest('.batch').find('.showBatch').html(response);
                }
            });
        })
    </script>
@endpush
