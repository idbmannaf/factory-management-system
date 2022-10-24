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
                <div class="card-header">
                    <h3 class="card-title">{{ucfirst($type)}} Requisition</h3>

                    {{-- <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right"
                                   placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-sm text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Action</th>
                            <th>user</th>
                            <th>Date</th>
                            <th>Total Quantity</th>
                            <th>Total Price</th>
                            <th>Total Collected Qty</th>
                            <th>Total Collect Wise Price</th>
                            <th>Type</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @include('factoryManager.ajax.requisition')
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>
@endsection


@push('js')

    @auth

    @else

    @endauth

@endpush

