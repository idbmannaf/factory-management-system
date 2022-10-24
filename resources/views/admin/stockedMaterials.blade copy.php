@extends('admin.layouts.adminMaster')

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
                            <table class="table table-striped " style="white-space: nowrap">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Name</th>
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
                                        <td>{{$stocked->id}}</td>
                                        <td>{{$stocked->raw->name}} {{$stocked->raw->unit_value . $stocked->raw->unit}}</td>
                                        <td>{{$stocked->category ? $stocked->category->name : ''}}</td>
                                        <td>{{$stocked->requisition ? \Carbon\Carbon::parse($stocked->requisition->date)->format('d M, Y') : '' }}</td>
                                        <td>{{\Carbon\Carbon::parse($stocked->created_at)->format('d M, Y')}}</td>
                                        <td>{{$stocked->total_quantity}}</td>
                                        <td>{{$stocked->unit_price}}</td>
                                        <td>{{$stocked->vat}}</td>
                                        <td>{{$stocked->final_price}}</td>
                                        <td>{{$stocked->unit}}</td>
                                        <td>{{$stocked->unit_value}}</td>
                                        <td>{{$stocked->type}}</td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-danger h4">No Stocked Found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{$stockedMaterials->render()}}
                    </div>
                </div>
            </div>

    </section>

@endsection



@push('js')


@endpush
