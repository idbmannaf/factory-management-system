

@extends('accounts.layouts.accountMaster')

@section('title')
    Production Dashboard
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('cp/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cp/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')
    <section class="content">
        <br>
        @include('alerts.alerts')
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Daily Production History

                    </div>
                </div>

                <div class="card-body ">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" style="white-space: nowrap">
                            <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Pack</th>
                                <th>Category Name</th>
                                <th>Unit</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dailyProduction as $dp)
                                <tr>
                                    <td>{{$dp->product_id}}</td>
                                    <td>{{$dp->product_name}}</td>
                                    <td>{{$dp->quantity}}</td>
                                    <td>{{$dp->pack}}</td>
                                    <td>{{$dp->category_name}}</td>
                                    <td>{{$dp->unit_value. $dp->unit}}</td>
                                    <td>{{$dp->type_value. $dp->type}}</td>
                                    <td>{{$dp->status}}</td>
                                    <td>{{\Carbon\Carbon::parse($dp->created_at)->format('d M,Y')}}</td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$dailyProduction->render()}}
                </div>
            </div>
        </div>
    </section>
@endsection


@push('js')
    <!-- Select2 -->
    <script src="{{ asset('cp/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2({theme: 'bootstrap4'});
        });
        $('#mySelect2').select2({
            dropdownParent: $('.modal')
        });
    </script>



@endpush

