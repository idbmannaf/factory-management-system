@extends('admin.layouts.adminMaster')

@section('title')
    Admin Dashboard
@endsection

@push('css')
    <!-- include summernote css/js -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> --}}

    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/summernote.css') }}"> --}}

@endpush

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>

                        <small>Supplier</small>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Suppliers</li>
                    </ol>
                </div>
            </div>
            <div class="container">
                @include('alerts.alerts')
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            All Suppliers
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.addSupplier')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="text" name="name" class="form-control" placeholder="Enter Name..">
                                </div>
                                <div class="col-md-3">
                                    <input type="email" name="email" class="form-control" placeholder="Enter Email..">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="mobile" class="form-control"
                                           placeholder="Phone Number">
                                </div>
                                <div class="col-md-3">
                                    <label for="active">
                                        <input type="checkbox" name="active" id="active"> Active
                                    </label>
                                    <button type="submit" class="btn btn-info"><i class="fas fa-plus"></i>Add</button>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive mt-3">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#SL</th>
                                    <th>Action</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Total Amount</th>
                                    <th>Paid</th>
                                    <th>Due</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($suppliers as $supplier)
                                    <tr>
                                        <td>{{$supplier->id}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  Action
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit{{$supplier->id}}"><i class="fas fa-edit"> Edit</i></a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#view{{$supplier->id}}"><i class="fas fa-eye"></i> View</a>
                                                    <a class="dropdown-item" href="{{route('admin.deleteSupplier',['supplier'=>$supplier])}}" onclick="return confirm('Are you sure? You want to delete this Supplier?');"><i class="fas fa-trash"></i> Delete</a>

                                                    <a class="dropdown-item" href="{{route('admin.orders',['supplier'=>$supplier])}}">All Orders</a>
                                                    <a class="dropdown-item" href="{{route('admin.payments',['supplier'=>$supplier])}}">Payments</a>
                                                </div>
                                              </div>
                                        </td>
                                        <td>{{$supplier->name}}</td>
                                        <td>{{$supplier->email}}</td>
                                        <td>{{$supplier->mobile}}</td>
                                        <td>{{$supplier->total_phrases_amount}}</td>
                                        <td>{{$supplier->total_paid_amount}}</td>
                                        <td>{{$supplier->total_phrases_amount - $supplier->total_paid_amount}}</td>
                                        <td>
                                            @if ($supplier->active)
                                                <span class="text-success">Activated</span>
                                            @else
                                                <span class="text-danger">InActivated</span>
                                            @endif
                                        </td>


                                    </tr>
                                    @include('admin.modal.supplierModal')
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-danger h4">No Suppliers Found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">{{$suppliers->render()}}</div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">

    </section>


    {{-- @include('welcome.includes.modals.modalLg') --}}

@endsection



@push('js')


@endpush
