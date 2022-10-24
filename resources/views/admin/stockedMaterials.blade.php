@extends('admin.layouts.adminMaster')

@section('title')
    Admin Dashboard
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.4/sweetalert2.css"
        integrity="sha512-40/Lc5CTd+76RzYwpttkBAJU68jKKQy4mnPI52KKOHwRBsGcvQct9cIqpWT/XGLSsQFAcuty1fIuNgqRoZTiGQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
    <section class="content-header">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <div class="card-title d-flex justify-content-between">
                        <div>
                            All {{ $type }} Stocked Materials
                            @if ($type == 'raw' || $type == 'pack' || $type == 'stationery')
                                <a href="" data-toggle="modal"
                                    data-target="#{{ $type == 'raw' ? 'raw' : ($type == 'pack' ? 'pack' : 'statationary') }}"
                                    class="btn btn-info">Add
                                    {{ $type == 'raw' ? 'raw' : ($type == 'pack' ? 'pack' : 'statationary') }}
                                    Stocked
                                    Material</a>
                            @endif
                        </div>

                        {{-- <div>
                            @if ($type == 'raw')
                                <a href="{{ route('downloadNow', ['type' => 'stock_materials', 'status' => 'raw']) }}"
                                    class="btn btn-success btn-sm"> <i class="fas fa-download"> </i>Download</a>
                            @elseif ($type == 'pack')
                                <a href="{{ route('downloadNow', ['type' => 'stock_materials', 'status' => 'pack']) }}"
                                    class="btn btn-success btn-sm"> <i class="fas fa-download"> </i>Download</a>

                            @endif

                        </div> --}}
                    </div>
                </div>
                <div class="modal fade"
                    id="{{ $type == 'raw' ? 'raw' : ($type == 'pack' ? 'pack' : 'statationary') }}" tabindex="-1"
                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add
                                    {{ $type == 'raw' ? 'raw' : ($type == 'pack' ? 'pack' : 'statationary') }} Stocked
                                    Materials</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if ($type == 'raw')
                                    <form action="{{ route('admin.storeCustomMaterials', ['type' => 'raw']) }}"
                                        method="POST">
                                    @elseif ($type == 'pack')
                                        <form action="{{ route('admin.storeCustomMaterials', ['type' => 'pack']) }}"
                                            method="POST">
                                        @elseif ($type == 'stationery')
                                            <form
                                                action="{{ route('admin.storeCustomMaterials', ['type' => 'stationary']) }}"
                                                method="POST">
                                            @else
                                                <form>
                                @endif
                                @csrf
                                <div class="form-group">
                                    <label for="material" class="col-form-label">Material:</label>
                                    <select name="material" id="material" class="form-control">
                                        <option> Select Material</option>
                                        @foreach ($materials as $material)
                                            <option value="{{ $material->id }}">{{ $material->name }}
                                                {{ $material->product_id }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">Supplier:</label>
                                    <select name="supplier" id="supplier" class="form-control">
                                        <option> Select Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="total_quantity" class="col-form-label">Total Quantity:</label>
                                    <input type="number" class="form-control" name="total_quantity" id="total_quantity">
                                </div>
                                <div class="form-group">
                                    <label for="vat" class="col-form-label">Vat</label>
                                    <input type="number" class="form-control" name="vat" id="vat">
                                </div>
                                <div class="form-group">
                                    <label for="unit_price" class="col-form-label">Unit Price</label>
                                    <input type="number" class="form-control" name="unit_price" id="unit_price">
                                </div>
                                <input type="submit" class="btn btn-info">
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if ($type != 'stationery')
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered table-sm" style="white-space: nowrap">
                                @foreach ($stockedMaterials as $catWiseSM)
                                    <thead>
                                        <tr>
                                            <th colspan="10"> {{ $catWiseSM->category->name }} Materials Stock</th>
                                        </tr>
                                        <tr>
                                            <th>#SL</th>
                                            <th>Name of the {{ $catWiseSM->category->name }}</th>
                                            <th>Unit</th>
                                            <th>Present Stock</th>
                                            <th>Total Value <small>Unit Price</small></th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>

                                    @foreach ($catWiseSM->category->rawStocksGroup($type) as $rawStock)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $rawStock->raw->name }}</td>
                                            <td>{{ $rawStock->unit }}</td>
                                            <td>{{ $rawStock->raw->rawStockTotalQuantity($type) }}</td>
                                            <td>{{ $rawStock->raw->rawStockTotalprice($type) }}</td>
                                            <td>
                                                <a class="btn btn-primary btn-xs" data-toggle="collapse"
                                                    href="#collapseExample{{ $rawStock->id }}" role="button"
                                                    aria-expanded="false" aria-controls="collapseExample">
                                                    Details
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="watchHistory">
                                                <div class="collapse" id="collapseExample{{ $rawStock->id }}">
                                                    <div class="table-responsive">
                                                        <table class="table rawTable table-sm">
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Action</th>
                                                                <th>Name</th>
                                                                <th>Supplier</th>
                                                                <th>Stocked Date</th>
                                                                <th>Requistion Date</th>
                                                                <th>Unit</th>
                                                                <th>Quantity <small>Present Stock</small></th>
                                                                <th>Unit Price <small>Total Value</small></th>
                                                                <th>Vat</th>
                                                                <th>Final Unit Price</th>
                                                                <th>Total Price</th>

                                                            </tr>
                                                            @foreach ($rawStock->raw->rawStockList($type) as $rawStockList)
                                                                <tr class="rawParent{{ $rawStockList->id }}">
                                                                    <td>{{ $rawStockList->id }}</td>
                                                                    <td>
                                                                        <div class="btn-group btn-sm" role="group"
                                                                            aria-label="Button group">
                                                                            <div class="btn-group btn-xs" role="group">
                                                                                <button id="btnGroupDrop1" type="button"
                                                                                    class="btn btn-secondary btn-xs dropdown-toggle"
                                                                                    data-toggle="dropdown"
                                                                                    aria-haspopup="true"
                                                                                    aria-expanded="false">
                                                                                    Action
                                                                                </button>
                                                                                <div class="dropdown-menu"
                                                                                    aria-labelledby="btnGroupDrop1">
                                                                                    <a class="dropdown-item shoEditForm"
                                                                                        data-toggle="collapse"
                                                                                        href="#edit{{ $rawStockList->id }}"
                                                                                        role="button" aria-expanded="false"
                                                                                        aria-controls="collapseExample">Edit</a>
                                                                                    <a class="dropdown-item watchHistoryShow"
                                                                                        data-toggle="collapse"
                                                                                        href="#history{{ $rawStockList->id }}"
                                                                                        role="button" aria-expanded="false"
                                                                                        aria-controls="collapseExample">History</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>{{ $rawStockList->raw->name }}</td>
                                                                    <td>{{ $rawStockList->supplier->name }}</td>
                                                                    <td>{{ \Carbon\Carbon::parse($rawStockList->created_at)->format('d M,Y') }}
                                                                    </td>
                                                                    <td>{{ $rawStockList->requisition ? \Carbon\Carbon::parse($rawStockList->requisition->date)->format('d M, Y') : '' }}
                                                                    </td>
                                                                    <td>{{ $rawStockList->unit_value . $rawStockList->unit }}
                                                                    </td>
                                                                    <td class="newQty">
                                                                        {{ $rawStockList->total_quantity }}</td>
                                                                    <td>{{ $rawStockList->unit_price }}</td>
                                                                    <td>{{ $rawStockList->vat }}</td>
                                                                    <td>{{ $rawStockList->final_price }}</td>
                                                                    <td class="final_price">
                                                                        {{ $rawStockList->total_quantity * $rawStockList->final_price }}
                                                                    </td>

                                                                </tr>
                                                                <tr>
                                                                    <td colspan="10">
                                                                        <form
                                                                            action="{{ route('admin.stockedMaterialsModifyHistory', ['stock' => $rawStockList]) }}"
                                                                            data-id="10" class="submitForm"
                                                                            method="post">
                                                                            @csrf
                                                                            <div class="collapse"
                                                                                id="edit{{ $rawStockList->id }}">
                                                                                <div class="table-responsive">
                                                                                    <table
                                                                                        class="table table-striped table-bordered table-sm">
                                                                                        <tr>
                                                                                            <th colspan="10"
                                                                                                class="text-danger text-center">
                                                                                                <b>Edit
                                                                                                    ({{ $rawStockList->id }})
                                                                                                </b>
                                                                                            </th>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Name</td>
                                                                                            <td>Present Stock</td>
                                                                                            <td>Addition</td>
                                                                                            <td>Wastage</td>
                                                                                            <td>New Stock</td>
                                                                                            <td>Remark</td>
                                                                                            <td>Action</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            {{-- <form action="" data-id="10" class="submitForm" > --}}
                                                                                            <input type="hidden"
                                                                                                name="stock_id"
                                                                                                value="{{ $rawStockList->id }}">
                                                                                            <input type="hidden"
                                                                                                name="total_quantity"
                                                                                                value="{{ $rawStockList->total_quantity }}">
                                                                                            <td>{{ $rawStockList->raw->name }}
                                                                                            </td>
                                                                                            <td class="qty">
                                                                                                {{ $rawStockList->total_quantity }}

                                                                                            </td>
                                                                                            <td>
                                                                                                <input
                                                                                                    class="form-control addition"
                                                                                                    type="number" step="1"
                                                                                                    name="addition"
                                                                                                    placeholder="Addition">
                                                                                                <input type="hidden"
                                                                                                    class="total_quantity"
                                                                                                    value="{{ $rawStockList->total_quantity }}">
                                                                                            </td>
                                                                                            <td><input
                                                                                                    class="form-control wastage"
                                                                                                    type="number" step="1"
                                                                                                    name="wastage"
                                                                                                    placeholder="Wastage">
                                                                                            </td>
                                                                                            <td class="final_total">
                                                                                                {{ $rawStockList->total_quantity }}
                                                                                            </td>
                                                                                            <td><input
                                                                                                    class="form-control"
                                                                                                    type="text"
                                                                                                    name="Remark"
                                                                                                    placeholder="Remark">
                                                                                            </td>
                                                                                            <td><input
                                                                                                    class="btn btn-sm btn-info"
                                                                                                    type="submit"
                                                                                                    value="Add"></td>

                                                                                            {{-- </form> --}}
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="10">
                                                                        <div class="collapse"
                                                                            id="history{{ $rawStockList->id }}">
                                                                            <div class="table-responsive">
                                                                                <table
                                                                                    class="table table-bordered table-sm">

                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th colspan="10"
                                                                                                class="text-danger text-center">
                                                                                                History
                                                                                                ({{ $rawStockList->id }})
                                                                                            </th>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Name</th>
                                                                                            <th>Previous Stock</th>
                                                                                            <th>Addition</th>
                                                                                            <th>Wastage</th>
                                                                                            <th>New Stock</th>
                                                                                            <th>Remark</th>
                                                                                            <th>Date</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody
                                                                                        class="historyShow{{ $rawStockList->id }}">
                                                                                        @if ($rawStockList->rawStockModifyHistory)
                                                                                            @foreach ($rawStockList->rawStockModifyHistory as $modifyHistory)
                                                                                                <tr>
                                                                                                    <td>{{ $modifyHistory->raw ? $modifyHistory->raw->name : '' }}
                                                                                                    </td>
                                                                                                    <td>{{ $modifyHistory->previous_stock }}
                                                                                                    </td>
                                                                                                    <td>{{ $modifyHistory->addition }}
                                                                                                    </td>
                                                                                                    <td>{{ $modifyHistory->wastage }}
                                                                                                    </td>
                                                                                                    <td>{{ $modifyHistory->new_stock }}
                                                                                                    </td>
                                                                                                    <td>{{ $modifyHistory->remark }}
                                                                                                    </td>
                                                                                                    <td>{{ \Carbon\Carbon::parse($modifyHistory->created_at)->format('d M, Y') }}
                                                                                                    </td>
                                                                                                </tr>
                                                                                            @endforeach
                                                                                        @endif

                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                        </table>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach


                            </table>
                        </div>
                    @else
                        <div class="table-responsive mt-3">
                            <table class="table table-striped table-bordered table-sm" style="white-space: nowrap">
                                <thead>
                                    <tr>
                                        <th>#ID</th>
                                        <th>Name</th>
                                        <th>Stocked Date</th>
                                        <th>Requisition Date</th>
                                        <th>Total Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Vat</th>
                                        <th>Final Price</th>
                                        <th>Unit</th>
                                        <th>Unit Value</th>
                                        <th>Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($stockedMaterials as $stocked)
                                        <tr>
                                            <td>{{ $stocked->id }}</td>
                                            <td>{{ $stocked->raw->name }}
                                                {{ $stocked->raw->unit_value . $stocked->raw->unit }}</td>
                                            <td>{{ \Carbon\Carbon::parse($stocked->created_at)->format('d M, Y') }}</td>
                                            <td>{{ $stocked->requisition ? \Carbon\Carbon::parse($stocked->requisition->date)->format('d M, Y') : '' }}
                                            </td>
                                            <td>{{ $stocked->total_quantity }}</td>
                                            <td>{{ $stocked->unit_price }}</td>
                                            <td>{{ $stocked->vat }}</td>
                                            <td>{{ $stocked->final_price }}</td>
                                            <td>{{ $stocked->unit }}</td>
                                            <td>{{ $stocked->unit_value }}</td>
                                            <td>{{ $stocked->type }}</td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-danger h4">No Stocked Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endif

                    {{ $stockedMaterials->render() }}
                </div>
            </div>
        </div>

    </section>
@endsection



@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.4/sweetalert2.min.js"
        integrity="sha512-vDRRSInpSrdiN5LfDsexCr56x9mAO3WrKn8ZpIM77alA24mAH3DYkGVSIq0mT5coyfgOlTbFyBSUG7tjqdNkNw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).on('change keyup', '.addition', function() {
            var that = $(this);
            var total_quantity = Number(that.closest('form').find('.total_quantity').val());
            var addition = Number(that.val());
            var wastage = Number(that.closest('.submitForm').find('.wastage').val());
            var final_total = that.closest('form').find('.final_total');
            final_total.text((total_quantity + addition) - wastage);


        });

        $(document).on('change keyup', '.wastage', function() {
            var that = $(this);
            var total_quantity = Number(that.closest('form').find('.total_quantity').val());
            var wastage = Number(that.val());
            var addition = Number(that.closest('.submitForm').find('.addition').val());
            var final_total = that.closest('form').find('.final_total');
            final_total.text((total_quantity + addition) - wastage);

        });


        $(document).on('submit', '.submitForm', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var that = $(this);
            var formData = that.serialize();
            $.ajax({
                url: that.attr('action'),
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        $('.historyShow' + response.raw_id).prepend(response.view);
                        that.trigger('reset')
                        console.log('.historyShow' + response.raw_id);
                        $('.rawParent' + response.raw_id).find('.newQty').text(response.final_quantity);
                        $('.rawParent' + response.raw_id).find('.final_price').text(response
                            .final_price);
                        $('.rawParent' + response.raw_id).find('.shoEditForm').click();
                        $('.rawParent' + response.raw_id).find('.watchHistoryShow').click();
                        that.find('.qty').text(response.final_quantity);
                        that.find('.total_quantity').val(response.final_quantity);
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'error',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
            });


        });
    </script>
@endpush
