@extends('factoryManager.layouts.factoryMaster')

@section('title')
    Factory Manager Dashboard
@endsection
@push('css')
@endpush

@section('content')
    <section class="content">
        <br>
        @include('alerts.alerts')
        <div class="container">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="card-title ">
                        Requisitions View
                    </div>
                </div>
                <div class="card-body">
                    <h5><b>Requisition </b></h5>
                    <p><b>User: </b>{{ $requisition->user ? $requisition->user->id : '' }}</p>
                    <p><b>Date: </b>{{ $requisition->date }}</p>
                    <p><b>Status: </b>{{ $requisition->status }}</p>
                    <p><b>Total Qty: </b>{{ $requisition->total_quantity }}</p>
                    <p><b>Total Price: </b>{{ $requisition->total_price }}</p>

                    @if ($requisition->collected_qty)
                        <p><b>Collected Quantity: </b>{{ $requisition->collected_qty }}</p>
                    @endif
                    @if ($requisition->collect_wise_price > 0)
                        <p><b>Collect Wise Price: </b>{{ $requisition->collect_wise_price }}</p>
                    @endif
                    <p><b>Status: </b><span class="badge badge-info">{{ $requisition->status }}</span></p>


                </div>
                <div class="card">
                    <form action="{{ route('factory.requisitionProcessUpdate', ['requisition' => $requisition->id]) }}"
                        method="post">
                        @csrf
                        @if ($requisition->type == 'pack')
                            <div class="card-body">
                                <h5>Requisition Items</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Material</th>
                                                <th>Product</th>
                                                <th>Category</th>
                                                <th>Medicin Type</th>
                                                <th>Unit</th>
                                                <th>Quantity</th>
                                                @if ($requisition->status == 'collected')
                                                    <th>Collected Quantity</th>
                                                @endif
                                                @if ($requisition->status == 'stocked')
                                                    <th>Collected Quantity</th>
                                                @endif
                                                @if ($requisition->status != 'pending')
                                                    <th>Unit Price</th>
                                                    <th>Vat</th>
                                                    <th>Final Price</th>
                                                    <th>Final Total Price</th>
                                                @endif
                                                <th>Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($requisition->requisition_items()->orderBy('raw_id')->get() as $item)
                                                <input type="hidden" name="id[]" value="{{ $item->id }}">
                                                <input type="hidden" name="ids[]" value="{{ $item->id }}">
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>
                                                        {{ $item->raw_materials ? $item->raw_materials->name : '' }}
                                                    </td>

                                                    <td>
                                                        {{ $item->raw_materials ? $item->raw_materials->product_name : '' }}
                                                    </td>

                                                    <td>{{ $item->packCat ? $item->packCat->name : '' }}</td>
                                                    <td>{{ $item->dhplCat ? json_decode($item->dhplCat->name)->en : '' }}</td>
                                                    <td>
                                                        {{ $item->unit_value . $item->unit }}

                                                    </td>

                                                    <td>
                                                        {{ $item->quantity }}
                                                    </td>
                                                    @if ($requisition->status == 'collected')
                                                        <td><input name="collected_quantities[{{ $item->id }}]"
                                                                type="number" class="form-conotrol"
                                                                value="{{ $item->collected_qty }}"></td>
                                                    @endif
                                                    @if ($requisition->status == 'stocked')
                                                        <td>{{ $item->collected_qty }}</td>
                                                    @endif
                                                    @if ($requisition->status != 'pending')
                                                        <td>
                                                            {{ $item->price }}

                                                        </td>

                                                        <td>
                                                            {{ $item->vat }}

                                                        </td>
                                                        <th>
                                                            {{ $item->final_price }}
                                                        </th>
                                                        <th>
                                                            {{ $item->final_price * $item->quantity }}
                                                        </th>
                                                    @endif
                                                    <td>{{ $item->raw_type }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-danger ">No Item Found</td>
                                                </tr>
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    @if ($requisition->status == 'pending')
                                        <input type="hidden" name="type" value="approved">
                                        <input type="submit" class="btn btn-info" value="Approved">
                                    @elseif($requisition->status == 'collected')
                                        <input type="hidden" name="type" value="stocked">
                                        <input type="submit" class="btn btn-success" value="Stocked">
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="card-body">
                                <h5>Requisition Items</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                @if ($requisition->status != 'pending')
                                                    <th>Supplier</th>
                                                @endif
                                                <th>Raw Material</th>
                                                <th>Category</th>

                                                <th>Current Stock</th>
                                                <th>Quantity</th>
                                                @if ($requisition->status == 'collected')
                                                    <th>Collected Quantity</th>
                                                @endif
                                                @if ($requisition->status == 'stocked')
                                                    <th>Collected Quantity</th>
                                                @endif
                                                @if ($requisition->status != 'pending')
                                                    <th>Unit Price</th>
                                                    <th>Vat</th>
                                                    <th>Final Price</th>
                                                    <th>Final Total Price</th>
                                                @endif
                                                <th>Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @forelse($requisition->requisition_items()->orderBy('raw_id')->get() as $item)
                                                <input type="hidden" name="id[]" value="{{ $item->id }}">
                                                <tr>
                                                    <td>{{ $item->id }}
                                                        <input type="hidden" name="ids[]" value="{{ $item->id }}">
                                                    </td>
                                                    @if ($requisition->status != 'pending')
                                                        <td>{{ $item->supplier ? $item->supplier->name : '' }}</td>
                                                    @endif
                                                    <td>
                                                        {{ $item->raw_materials->name }}({{ $item->raw_materials->unit }}
                                                        {{ $item->raw_materials->unit_value }})
                                                    </td>
                                                    <td>{{ $item->category ? $item->category->name : '' }}</td>
                                                    <td>

                                                        <b>Current Stock: </b> {{ $item->total_stock() }} <br>
                                                        <b>Total Batch: </b> {{ $item->total_batch() }}

                                                    </td>
                                                    <td>
                                                        {{ $item->quantity }}

                                                    </td>
                                                    @if ($requisition->status == 'collected')
                                                        <td><input name="collected_quantities[{{ $item->id }}]"
                                                                type="number" class="form-conotrol"
                                                                value="{{ $item->collected_qty }}"></td>
                                                    @endif
                                                    @if ($requisition->status == 'stocked')
                                                        <td>{{ $item->collected_qty }}</td>
                                                    @endif
                                                    @if ($requisition->status != 'pending')
                                                        <td>
                                                            {{ $item->price }}

                                                        </td>

                                                        <td>
                                                            {{ $item->vat }}

                                                        </td>
                                                        <th>
                                                            {{ $item->final_price }}
                                                        </th>
                                                        <th>
                                                            {{ $item->final_price * $item->quantity }}
                                                        </th>
                                                    @endif
                                                    <td>{{ $item->raw_type }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-danger ">No Item Found</td>
                                                </tr>
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    @if ($requisition->status == 'pending')
                                        <input type="hidden" name="type" value="approved">
                                        <input type="submit" class="btn btn-info" value="Approved">
                                    @elseif($requisition->status == 'collected')
                                        <input type="hidden" name="type" value="stocked">
                                        <input type="submit" class="btn btn-success" value="Stocked">
                                    @endif
                                </div>
                            </div>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('js')
    <script>
        $(document).on('click', '.appendRaw', function(e) {
            e.preventDefault();
            var that = $(this);
            url = that.attr('href');
            $.ajax({
                url: url,
                method: 'GET',
                success: function(res) {
                    that.closest('tr').after(res)
                }
            });

        });
    </script>
    <script>
        $(document).on('click', '.updateSupplier', function(e) {
            e.preventDefault();
            var that = $(this);
            var url = that.attr('href');
            var supplier = Number(that.closest('tr').find("#supplier").val());
            var quantity = Number(that.closest('tr').find("#quantity").val());
            var price = Number(that.closest('tr').find("#price").val());
            var vat = Number(that.closest('tr').find("#vat").val());
            if ((supplier <= 0) || (quantity <= 0) || (price <= 0)) {
                alert('Something Worng. Please fill the form');
                return;
            }
            var fullurl = url + "?supplier=" + supplier + "&quantity=" + quantity + "&price=" + price + "&vat=" +
                vat;
            $.ajax({
                url: fullurl,
                method: 'GET',
                success: function(res) {
                    if (res) {
                        location.reload();
                    }
                }
            });

        });
        $(document).on('click', '.removeSupplier', function(e) {
            e.preventDefault();
            $(this).closest('tr').remove();
        })
    </script>
@endpush
