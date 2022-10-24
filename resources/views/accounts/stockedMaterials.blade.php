@extends('accounts.layouts.accountMaster')

@section('title')
    Admin Dashboard
@endsection

@push('css')

@endpush

@section('content')

    <section class="content-header">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            All {{$type}} Stocked Materials
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            @if ($type == 'pack')
                            <table class="table table-striped table-bordered table-sm" style="white-space: nowrap">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Product</th>
                                    <th>Category</th>
                                    <th>Medicin Type</th>
                                    <th>Unit</th>
                                    <th>Stocked Date</th>
                                    <th>Requisition Date</th>
                                    <th>Total Quantity</th>

                                    <th>Type</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($stockedMaterials as $stocked)
                                    <tr>
                                        <td>{{$stocked->id}}</td>
                                        <td>{{$stocked->product_name}}</td>
                                        <td>{{$stocked->packCat ? $stocked->packCat->name : ''}}</td>
                                        <td>{{$stocked->medicineType ? $stocked->medicineType->name : ''}}</td>
                                        <td>{{$stocked->requisition ? \Carbon\Carbon::parse($stocked->requisition->date)->format('d M, Y') : '' }}</td>
                                        <td>{{\Carbon\Carbon::parse($stocked->created_at)->format('d M, Y')}}</td>
                                        <td>{{$stocked->total_quantity}}</td>
                                        <td>{{$stocked->type}}</td>


                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-danger h4">No Stocked Found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            @else
                            <table class="table table-striped table-bordered table-sm" style="white-space: nowrap">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Stocked Date</th>
                                    <th>Requisition Date</th>
                                    <th>Total Quantity</th>

                                    <th>Type</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($stockedMaterials as $stocked)
                                    <tr>
                                        <td>{{$stocked->id}}</td>
                                        <td>{{$stocked->raw->name}} {{$stocked->raw->unit_value . $stocked->raw->unit}}</td>
                                        <td>{{$stocked->category ? $stocked->category->name : ''}}</td>
                                        <td>{{$stocked->requisition ? \Carbon\Carbon::parse($stocked->requisition->date)->format('d M, Y') : '' }}</td>
                                        <td>{{\Carbon\Carbon::parse($stocked->created_at)->format('d M, Y')}}</td>
                                        <td>{{$stocked->total_quantity}}</td>
                                        <td>{{$stocked->type}}</td>


                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-danger h4">No Stocked Found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            @endif

                        </div>
                        {{$stockedMaterials->render()}}
                    </div>
                </div>
            </div>

    </section>


    <!-- Main content -->
    <section class="content">

    </section>


    {{-- @include('welcome.includes.modals.modalLg') --}}

@endsection



@push('js')


@endpush
