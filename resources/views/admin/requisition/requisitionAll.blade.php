@extends('admin.layouts.adminMaster')

@section('title')
    Admin Dashboard
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

                    @if ($type == 'all')
                    @elseif ($type == 'pending')
                    <a href="{{route('downloadNow',['type'=>'requisition','status'=>'all'])}}" class="btn btn-success btn-sm"> <i class="fas fa-download"> </i>Download</a>
                    @elseif ($type == 'approved')
                    <a href="{{route('downloadNow',['type'=>'requisition','status'=>'approved'])}}" class="btn btn-success btn-sm"> <i class="fas fa-download"> </i>Download</a>
                    @elseif ($type == 'purchase')
                    <a href="{{route('downloadNow',['type'=>'requisition','status'=>'purchase'])}}" class="btn btn-success btn-sm"> <i class="fas fa-download"> </i>Download</a>
                    @elseif ($type == 'pending_purchase')
                    <a href="{{route('downloadNow',['type'=>'requisition','status'=>'pending_purchase'])}}" class="btn btn-success btn-sm"> <i class="fas fa-download"> </i>Download</a>
                    @elseif ($type == 'approved_purchase')
                    <a href="{{route('downloadNow',['type'=>'requisition','status'=>'approved_purchase'])}}" class="btn btn-success btn-sm"> <i class="fas fa-download"> </i>Download</a>
                    @elseif ($type == 'purchase')
                    <a href="{{route('downloadNow',['type'=>'requisition','status'=>'purchase'])}}" class="btn btn-success btn-sm"> <i class="fas fa-download"> </i>Download</a>
                    @elseif ($type == 'collected')
                    <a href="{{route('downloadNow',['type'=>'requisition','status'=>'collected'])}}" class="btn btn-success btn-sm"> <i class="fas fa-download"> </i>Download</a>
                    @elseif ($type == 'stocked')
                    <a href="{{route('downloadNow',['type'=>'requisition','status'=>'stocked'])}}" class="btn btn-success btn-sm"> <i class="fas fa-download"> </i>Download</a>
                    @else
                    <a href="{{route('downloadNow',['type'=>'requisition','status'=>'all'])}}" class="btn btn-success btn-sm"> <i class="fas fa-download"> </i>Download</a>
                    @endif
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Action</th>
                            <th>user</th>
                            <th>Date</th>
                            <th>Total Quantity</th>
                            <th>Total Price</th>
                            <th>Collected Qty</th>
                            <th>Collect Wise Price</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @include('admin.ajax.requisition')
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

