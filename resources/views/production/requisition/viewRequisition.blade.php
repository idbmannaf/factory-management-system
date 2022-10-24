@extends('production.layouts.productionMaster')

@section('title')
    Production Dashboard
@endsection
@push('css')
@endpush

@section('content')
    <section class="content">
        <br>
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
                    <p><b>Total Quantity: </b>{{ $requisition->total_quantity }}</p>
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
                    <form action="{{ route('production.updateStatusRequisition', ['requisition' => $requisition->id]) }}"
                        method="post">
                        @csrf
                        @if ($requisition->type == 'pack')
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
                                                @if ($requisition->status == 'purchase')
                                                    <th>Collected Quantity</th>
                                                @endif
                                                @if ($requisition->status == 'collected')
                                                    <th>Collected Quantity</th>
                                                @endif

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($requisition->requisition_items as $item)
                                                <tr>
                                                    <td>{{ $item->id }}
                                                        <input type="hidden" name="ids[]" value="{{ $item->id }}">
                                                    </td>
                                                    <td>
                                                        {{ $item->raw_materials? $item->raw_materials->name : '' }})
                                                    </td>
                                                    <td>
                                                        {{ $item->raw_materials? $item->raw_materials->product_name : '' }})
                                                    </td>

                                                    <td>{{ $item->packCat ? $item->packCat->name : '' }}</td>
                                                    <td>{{ $item->dhplCat ? json_decode($item->dhplCat->name)->en : '' }}</td>

                                                    <td>
                                                        {{ $item->unit_value . $item->unit }}

                                                    </td>

                                                    <td>
                                                        {{ $item->quantity }}
                                                    </td>

                                                    <td>{{ $item->raw_type }}</td>

                                                    @if ($requisition->status == 'purchase')
                                                        <td><input name="collected_quantities[{{ $item->id }}]"
                                                                type="number" class="form-conotrol"
                                                                value="{{ $item->quantity }}"></td>
                                                    @endif
                                                    @if ($requisition->status == 'collected')
                                                        <td>{{ $item->collected_qty }}</td>
                                                    @endif

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
                            <div class="card-body">
                                <h5>Requisition Items</h5>
                                <div class="table-responsive">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Raw Material</th>
                                                <th>Quantity</th>

                                                @if ($requisition->status == 'purchase')
                                                    <th>Collected Quantity</th>
                                                @endif
                                                @if ($requisition->status == 'collected')
                                                    <th>Collected Quantity</th>
                                                @endif
                                                <th>Category</th>
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
                                                        {{ $item->raw_materials->name }}({{ $item->raw_materials->unit }}
                                                        {{ $item->raw_materials->unit_value }})
                                                    </td>
                                                    <td>{{ $item->quantity }}</td>
                                                    @if ($requisition->status == 'purchase')
                                                        <td><input name="collected_quantities[{{ $item->id }}]"
                                                                type="number" class="form-conotrol"
                                                                value="{{ $item->quantity }}"></td>
                                                    @endif
                                                    @if ($requisition->status == 'collected')
                                                        <td>{{ $item->collected_qty }}</td>
                                                    @endif
                                                    <td>{{ $item->category ? $item->category->name : '' }}</td>
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
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('js')
@endpush
