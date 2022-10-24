@extends('admin.layouts.adminMaster')

@section('title')
    Users List
@endsection

@push('css')
    <style>
        tr.nowrap td {
            white-space: nowrap;
        }

    </style>
@endpush

@section('content')

    <div class="card">
        <div class="card-header w3-purple h3">
            Users
        </div>
        <div class="card-body w3-grey">
            @include('alerts.alerts')
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-widget-">
                        <div class="card-header w3-medium w3-purple">
                            User Info
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.ecommerce.user.update', $user) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control" type="text" name="name" value="{{ $user->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input class="form-control" type="text" name="mobile" value="{{ $user->mobile }}">
                                </div>
                                <div class="form-group">
                                    <label for="nid">National ID no.</label>
                                    <input class="form-control" type="text" name="nid" value="{{ $user->nid }}">
                                </div>
                                <div class="form-group">
                                    <label for="dob">Date of Birth</label>
                                    <input class="form-control" type="date" name="dob" value="{{ $user->dob }}">
                                </div>
                                <div class="form-group">
                                    <label for="dob">Profile Photo</label>
                                    <input class="form-control" type="file" name="img">
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-success"> <i class="fa fa-save"></i> Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-widget-">
                        <div class="card-header w3-medium w3-deep-orange">
                            Update Password
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.ecommerce.user.password', $user) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input class="form-control" type="text" name="password">
                                </div>
                                @if ($user->password_temp)
                                    <div class="pb-3">
                                        Previous Temp. Password : {{ $user->password_temp }}
                                    </div>
                                @endif
                                <div class="text-center">
                                    <button class="btn btn-success"> <i class="fa fa-save"></i> Set & Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- {{dd($user->doesHaveRole())}} --}}
            @if ($user->doesHaveRole())
                <div class="row">
                    @foreach ($user->myroles as $role)
                        @if ($role->role_name != 'admin')
                            <div class="col-12 col-md-6">
                                <div class="card card-widget-">
                                    <div class="card-header w3-medium w3-deep-orange">
                                        Update Permission of Role: {{ $role->role_value }}
                                    </div>
                                    <div class="card-body">
                                        @if ($role->role_name == 'accounts')
                                            {{-- Accounts Permission Start --}}
                                            <form
                                                action="{{ route('admin.addPermission', ['user' => $user, 'role' => $role->id]) }}"
                                                method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    @if ($role->permissionCount() < 1)
                                                        <label for="all"> <input type="checkbox" checked id="all"
                                                                value='all'>All</label>
                                                    @endif
                                                    <fieldset>
                                                        <legend>Requisition</legend>


                                                        <label for="req_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('req_list') ? 'checked' : '' }}
                                                                name="permission[]" id="req_list" value='req_list'>
                                                            All List</label>
                                                        {{-- <label for="req_edit"> <input type="checkbox"
                                                                {{ $role->hasPermission('req_edit') ? 'checked' : '' }}
                                                                name="permission[]" id="req_edit" value='req_edit'>
                                                            Edit</label>
                                                        <label for="req_delete"> <input type="checkbox"
                                                                {{ $role->hasPermission('req_delete') ? 'checked' : '' }}
                                                                name="permission[]" id="req_delete" value='req_delete'>
                                                            Delete</label> --}}
                                                        <label for="req_pending"> <input type="checkbox"
                                                                {{ $role->hasPermission('req_pending') ? 'checked' : '' }}
                                                                name="permission[]" id="req_pending"
                                                                value='req_pending'>Pending </label>

                                                        <label for="req_approved"> <input type="checkbox"
                                                                {{ $role->hasPermission('req_approved') ? 'checked' : '' }}
                                                                name="permission[]" id="req_approved"
                                                                value='req_approved'>Approved </label>
                                                        <label for="req_pending_purchase"> <input type="checkbox"
                                                                {{ $role->hasPermission('req_pending_purchase') ? 'checked' : '' }}
                                                                name="permission[]" id="req_pending_purchase"
                                                                value='req_pending_purchase'>Pending Purchase</label>
                                                        <label for="req_approved_purchase"> <input type="checkbox"
                                                                {{ $role->hasPermission('req_approved_purchase') ? 'checked' : '' }}
                                                                name="permission[]" id="req_approved_purchase"
                                                                value='req_approved_purchase'>Approved Purchase</label>
                                                        <label for="req_purchase"> <input type="checkbox"
                                                                {{ $role->hasPermission('req_purchase') ? 'checked' : '' }}
                                                                name="permission[]" id="req_purchase"
                                                                value='req_purchase'>Purchase</label>
                                                        <label for="req_collected"> <input type="checkbox"
                                                                {{ $role->hasPermission('req_collected') ? 'checked' : '' }}
                                                                name="permission[]" id="req_collected"
                                                                value='req_collected'>Collected</label>
                                                        <label for="req_stocked"> <input type="checkbox"
                                                                {{ $role->hasPermission('req_stocked') ? 'checked' : '' }}
                                                                name="permission[]" id="req_stocked"
                                                                value='req_stocked'>Stocked</label>
                                                    </fieldset>

                                                    <fieldset>
                                                        <legend>Materials</legend>

                                                        <div class="h6"><b>Raw Materials : </b></div>
                                                        <label for="raw_materials_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('raw_materials_list') ? 'checked' : '' }}
                                                                name="permission[]" id="raw_materials_list"
                                                                value='raw_materials_list'>Raw Materials List</label>
                                                        <label for="raw_materials_edit"> <input type="checkbox"
                                                                {{ $role->hasPermission('raw_materials_edit') ? 'checked' : '' }}
                                                                name="permission[]" id="raw_materials_edit"
                                                                value='raw_materials_edit'>Raw Materials Edit</label>
                                                        <hr>
                                                        <div class="h6"><b>Pack Materials : </b></div>
                                                        <label for="pack_materials_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('pack_materials_list') ? 'checked' : '' }}
                                                                name="permission[]" id="pack_materials_list"
                                                                value='pack_materials_list'>Pack Materials List</label>
                                                        <label for="pack_materials_edit"> <input type="checkbox"
                                                                {{ $role->hasPermission('pack_materials_edit') ? 'checked' : '' }}
                                                                name="permission[]" id="pack_materials_edit"
                                                                value='pack_materials_edit'>Pack Materials Edit</label>
                                                        <hr>
                                                        <div class="h6"><b>Stationery Materials : </b></div>
                                                        <label for="stationery_materials_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('stationery_materials_list') ? 'checked' : '' }}
                                                                name="permission[]" id="stationery_materials_list"
                                                                value='stationery_materials_list'>Stationery Materials
                                                            List</label>
                                                        <label for="stationery_materials_edit"> <input type="checkbox"
                                                                {{ $role->hasPermission('stationery_materials_edit') ? 'checked' : '' }}
                                                                name="permission[]" id="stationery_materials_edit"
                                                                value='stationery_materials_edit'>Stationery Materials
                                                            Edit</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <legend>Stocked Materials</legend>
                                                        <label for="raw_stock_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('raw_stock_list') ? 'checked' : '' }}
                                                                name="permission[]" id="raw_stock_list"
                                                                value='raw_stock_list'>Raw Stocks</label>
                                                        <label for="ppack_stock_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('pack_stock_list') ? 'checked' : '' }}
                                                                name="permission[]" id="pack_stock_list"
                                                                value='pack_stock_list'>Pack Stocks</label>
                                                        <label for="stationery_stock_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('stationery_stock_list') ? 'checked' : '' }}
                                                                name="permission[]" id="stationery_stock_list"
                                                                value='stationery_stock_list'>Stationery Stocks</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <legend>Suppliers</legend>
                                                        <label for="supplier_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('supplier_list') ? 'checked' : '' }}
                                                                name="permission[]" id="supplier_list"
                                                                value='supplier_list'>Supplier List</label>
                                                        <label for="supplier_add"> <input type="checkbox"
                                                                {{ $role->hasPermission('supplier_add') ? 'checked' : '' }}
                                                                name="permission[]" id="supplier_add"
                                                                value='supplier_add'>Supplier Add</label>
                                                        <label for="supplier_edit"> <input type="checkbox"
                                                                {{ $role->hasPermission('supplier_edit') ? 'checked' : '' }}
                                                                name="permission[]" id="supplier_edit"
                                                                value='supplier_edit'>Supplier Edit</label>
                                                        <label for="supplier_delete"> <input type="checkbox"
                                                                {{ $role->hasPermission('supplier_delete') ? 'checked' : '' }}
                                                                name="permission[]" id="supplier_delete"
                                                                value='supplier_delete'>Supplier Delete</label>
                                                        <label for="supplier_payment"> <input type="checkbox"
                                                                {{ $role->hasPermission('supplier_payment') ? 'checked' : '' }}
                                                                name="permission[]" id="supplier_payment"
                                                                value='supplier_payment'>Supplier Payment</label>
                                                        {{-- <label for="supplier_payment_history"> <input type="checkbox"
                                                                {{ $role->hasPermission('supplier_payment_history') ? 'checked' : '' }}
                                                                name="permission[]" id="supplier_payment_history"
                                                                value='supplier_payment_history'>Supplier Payment
                                                            History</label> --}}
                                                        <label for="supplier_order_history"> <input type="checkbox"
                                                                {{ $role->hasPermission('supplier_order_history') ? 'checked' : '' }}
                                                                name="permission[]" id="supplier_order_history"
                                                                value='supplier_order_history'>Supplier Order
                                                            History</label>
                                                    </fieldset>




                                                    <hr>
                                                    <fieldset>
                                                        <legend>Ready Products</legend>
                                                        <label for="ready_product"> <input type="checkbox"
                                                                {{ $role->hasPermission('ready_product') ? 'checked' : '' }}
                                                                name="permission[]" id="ready_product"
                                                                value='ready_product'>Ready Products</label>
                                                    </fieldset>


                                                    <hr>
                                                    <fieldset>
                                                        <legend>Daily Production</legend>
                                                        <label for="production_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('production_list') ? 'checked' : '' }}
                                                                name="permission[]" id="production_list"
                                                                value='production_list'>Production List</label>
                                                        <label for="production_pending"> <input type="checkbox"
                                                                {{ $role->hasPermission('production_pending') ? 'checked' : '' }}
                                                                name="permission[]" id="production_pending"
                                                                value='production_pending'>Pending Production</label>
                                                        <label for="production_rejected"> <input type="checkbox"
                                                                {{ $role->hasPermission('production_rejected') ? 'checked' : '' }}
                                                                name="permission[]" id="production_rejected"
                                                                value='production_rejected'>Rejected Production</label>
                                                        <label for="production_approved"> <input type="checkbox"
                                                                {{ $role->hasPermission('production_approved') ? 'checked' : '' }}
                                                                name="permission[]" id="production_approved"
                                                                value='production_approved'>Approved Production</label>


                                                    </fieldset>

                                                    <hr>
                                                    <fieldset>
                                                        <legend>Categories</legend>
                                                        <label for="category_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('category_list') ? 'checked' : '' }}
                                                                name="permission[]" id="category_list"
                                                                value='category_list'>Category List</label>
                                                        <label for="category_add"> <input type="checkbox"
                                                                {{ $role->hasPermission('category_add') ? 'checked' : '' }}
                                                                name="permission[]" id="category_add"
                                                                value='category_add'>Category Add</label>

                                                        <label for="category_edit"> <input type="checkbox"
                                                                {{ $role->hasPermission('category_edit') ? 'checked' : '' }}
                                                                name="permission[]" id="category_edit"
                                                                value='category_edit'>Category Edit</label>

                                                        <label for="category_delete"> <input type="checkbox"
                                                                {{ $role->hasPermission('category_delete') ? 'checked' : '' }}
                                                                name="permission[]" id="category_delete"
                                                                value='category_delete'>Category Delete</label>
                                                    </fieldset>

                                                    <fieldset>
                                                        <legend>Category Types</legend>
                                                        <label for="category_type_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('category_type_list') ? 'checked' : '' }}
                                                                name="permission[]" id="category_type_list"
                                                                value='category_type_list'>Category Type List</label>
                                                        <label for="category_type_add"> <input type="checkbox"
                                                                {{ $role->hasPermission('category_type_add') ? 'checked' : '' }}
                                                                name="permission[]" id="category_type_add"
                                                                value='category_type_add'>Category Add</label>

                                                        <label for="category_type_edit"> <input type="checkbox"
                                                                {{ $role->hasPermission('category_type_edit') ? 'checked' : '' }}
                                                                name="permission[]" id="category_type_edit"
                                                                value='category_type_edit'>Category Type Edit</label>

                                                        <label for="category_type_delete"> <input type="checkbox"
                                                                {{ $role->hasPermission('category_type_delete') ? 'checked' : '' }}
                                                                name="permission[]" id="category_type_delete"
                                                                value='category_type_delete'>Category Type Delete</label>
                                                    </fieldset>
                                                    <hr>
                                                    <fieldset>
                                                        <legend>Samples</legend>
                                                        <label for="sample_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('sample_list') ? 'checked' : '' }}
                                                                name="permission[]" id="sample_list"
                                                                value='sample_list'>Sample List</label>

                                                    </fieldset>
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-sm btn-info"
                                                        value="Update Permission">
                                                </div>
                                            </form>
                                            {{-- Accounts Permission End --}}
                                        @elseif ($role->role_name == 'production')
                                            {{-- Production Permission Start --}}
                                            <form
                                                action="{{ route('admin.addPermission', ['user' => $user, 'role' => $role->id]) }}"
                                                method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    @if ($role->permissionCount() < 1)
                                                        <label for="all"> <input type="checkbox" checked id="all"
                                                                value='all'>All</label>
                                                    @endif
                                                    <fieldset>
                                                        <legend>Requisition</legend>
                                                        <label for="preq_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('req_list') ? 'checked' : '' }}
                                                                name="permission[]" id="preq_list" value='req_list'>
                                                            List</label>
                                                            <label for="preq_add"> <input type="checkbox"
                                                                {{ $role->hasPermission('req_add') ? 'checked' : '' }}
                                                                name="permission[]" id="preq_add" value='req_add'>
                                                            Add</label>
                                                        <label for="preq_edit"> <input type="checkbox"
                                                                {{ $role->hasPermission('req_edit') ? 'checked' : '' }}
                                                                name="permission[]" id="preq_edit" value='req_edit'>
                                                            Edit</label>
                                                        <label for="preq_delete"> <input type="checkbox"
                                                                {{ $role->hasPermission('req_delete') ? 'checked' : '' }}
                                                                name="permission[]" id="preq_delete" value='req_delete'>
                                                            Delete</label>
                                                        <label for="preq_pending"> <input type="checkbox"
                                                                {{ $role->hasPermission('req_pending') ? 'checked' : '' }}
                                                                name="permission[]" id="preq_pending"
                                                                value='req_pending'>Pending </label>

                                                        <label for="preq_approved"> <input type="checkbox"
                                                                {{ $role->hasPermission('req_approved') ? 'checked' : '' }}
                                                                name="permission[]" id="preq_approved"
                                                                value='req_approved'>Approved </label>
                                                        <label for="preq_pending_purchase"> <input type="checkbox"
                                                                {{ $role->hasPermission('req_pending_purchase') ? 'checked' : '' }}
                                                                name="permission[]" id="preq_pending_purchase"
                                                                value='req_pending_purchase'>Pending Purchase</label>
                                                        <label for="preq_approved_purchase"> <input type="checkbox"
                                                                {{ $role->hasPermission('req_approved_purchase') ? 'checked' : '' }}
                                                                name="permission[]" id="preq_approved_purchase"
                                                                value='req_approved_purchase'>Pending Approved</label>
                                                        <label for="preq_purchase"> <input type="checkbox"
                                                                {{ $role->hasPermission('req_purchase') ? 'checked' : '' }}
                                                                name="permission[]" id="preq_purchase"
                                                                value='req_purchase'>Purchase</label>
                                                        <label for="preq_collected"> <input type="checkbox"
                                                                {{ $role->hasPermission('req_collected') ? 'checked' : '' }}
                                                                name="permission[]" id="preq_collected"
                                                                value='req_collected'>Collected</label>
                                                        <label for="preq_stocked"> <input type="checkbox"
                                                                {{ $role->hasPermission('req_stocked') ? 'checked' : '' }}
                                                                name="permission[]" id="preq_stocked"
                                                                value='req_stocked'>Stocked</label>
                                                    </fieldset>

                                                    <fieldset>
                                                        <legend>Materials</legend>
                                                        <div class="h6"><b>Raw Materials : </b></div>
                                                        <label for="praw_materials_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('raw_materials_list') ? 'checked' : '' }}
                                                                name="permission[]" id="praw_materials_list"
                                                                value='raw_materials_list'>Raw Materials List</label>
                                                        <label for="praw_materials_add"> <input type="checkbox"
                                                                {{ $role->hasPermission('raw_materials_add') ? 'checked' : '' }}
                                                                name="permission[]" id="praw_materials_add"
                                                                value='raw_materials_add'>Raw Materials Add</label>
                                                        <label for="praw_materials_edit"> <input type="checkbox"
                                                                {{ $role->hasPermission('raw_materials_edit') ? 'checked' : '' }}
                                                                name="permission[]" id="praw_materials_edit"
                                                                value='raw_materials_edit'>Raw Materials Edit</label>
                                                        <label for="praw_materials_delete"> <input type="checkbox"
                                                                {{ $role->hasPermission('raw_materials_delete') ? 'checked' : '' }}
                                                                name="permission[]" id="praw_materials_delete"
                                                                value='raw_materials_delete'>Raw Materials Delete</label>
                                                        <hr>
                                                        <div class="h6"><b>Pack Materials : </b></div>
                                                        <label for="ppack_materials_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('pack_materials_list') ? 'checked' : '' }}
                                                                name="permission[]" id="ppack_materials_list"
                                                                value='pack_materials_list'>Pack Materials List</label>
                                                        <label for="ppack_materials_add"> <input type="checkbox"
                                                                {{ $role->hasPermission('pack_materials_add') ? 'checked' : '' }}
                                                                name="permission[]" id="ppack_materials_add"
                                                                value='pack_materials_add'>Pack Materials Add</label>
                                                        <label for="ppack_materials_edit"> <input type="checkbox"
                                                                {{ $role->hasPermission('pack_materials_edit') ? 'checked' : '' }}
                                                                name="permission[]" id="ppack_materials_edit"
                                                                value='pack_materials_edit'>Pack Materials Edit</label>
                                                        <label for="ppack_materials_delete"> <input type="checkbox"
                                                                {{ $role->hasPermission('pack_materials_delete') ? 'checked' : '' }}
                                                                name="permission[]" id="ppack_materials_delete"
                                                                value='pack_materials_delete'>Pack Materials Delete</label>
                                                        <hr>
                                                        <div class="h6"><b>Stationery Materials : </b></div>
                                                        <label for="pstationery_materials_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('stationery_materials_list') ? 'checked' : '' }}
                                                                name="permission[]" id="pstationery_materials_list"
                                                                value='stationery_materials_list'>Stationery Materials
                                                            List</label>
                                                        <label for="pstationery_materials_add"> <input type="checkbox"
                                                                {{ $role->hasPermission('stationery_materials_add') ? 'checked' : '' }}
                                                                name="permission[]" id="pstationery_materials_add"
                                                                value='stationery_materials_add'>Stationery Materials
                                                            Add</label>
                                                        <label for="pstationery_materials_edit"> <input type="checkbox"
                                                                {{ $role->hasPermission('stationery_materials_edit') ? 'checked' : '' }}
                                                                name="permission[]" id="pstationery_materials_edit"
                                                                value='stationery_materials_edit'>Stationery Materials
                                                            Edit</label>
                                                        <label for="pstationery_materials_delete"> <input type="checkbox"
                                                                {{ $role->hasPermission('stationery_materials_delete') ? 'checked' : '' }}
                                                                name="permission[]" id="pstationery_materials_delete"
                                                                value='stationery_materials_delete'>Stationery Materials
                                                            Delete</label>
                                                    </fieldset>

                                                    <fieldset>
                                                        <legend>Stocked Materials</legend>
                                                        <label for="praw_stock_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('raw_stock_list') ? 'checked' : '' }}
                                                                name="permission[]" id="praw_stock_list"
                                                                value='raw_stock_list'>Raw Stocks</label>
                                                        <label for="ppack_stock_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('pack_stock_list') ? 'checked' : '' }}
                                                                name="permission[]" id="ppack_stock_list"
                                                                value='pack_stock_list'>Pack Stocks</label>
                                                        <label for="pstationery_stock_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('stationery_stock_list') ? 'checked' : '' }}
                                                                name="permission[]" id="pstationery_stock_list"
                                                                value='stationery_stock_list'>Stationery Stocks</label>
                                                    </fieldset>

                                                    <hr>
                                                    <fieldset>
                                                        <legend>Ready Products</legend>
                                                        <label for="pready_product"> <input type="checkbox"
                                                                {{ $role->hasPermission('ready_product') ? 'checked' : '' }}
                                                                name="permission[]" id="pready_product"
                                                                value='ready_product'>Ready Products</label>
                                                    </fieldset>


                                                    <hr>
                                                    <fieldset>
                                                        <legend>Daily Production</legend>
                                                        <label for="pproduction_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('production_list') ? 'checked' : '' }}
                                                                name="permission[]" id="pproduction_list"
                                                                value='production_list'>Production List</label>

                                                        <label for="pproduction_add"> <input type="checkbox"
                                                                {{ $role->hasPermission('production_add') ? 'checked' : '' }}
                                                                name="permission[]" id="pproduction_add"
                                                                value='production_add'>Add</label>
                                                        <label for="pproduction_edit"> <input type="checkbox"
                                                                {{ $role->hasPermission('production_edit') ? 'checked' : '' }}
                                                                name="permission[]" id="pproduction_edit"
                                                                value='production_edit'>Edit</label>
                                                        <label for="pproduction_delete"> <input type="checkbox"
                                                                {{ $role->hasPermission('production_delete') ? 'checked' : '' }}
                                                                name="permission[]" id="pproduction_delete"
                                                                value='production_delete'>Delete</label>

                                                        <label for="pproduction_pending"> <input type="checkbox"
                                                                {{ $role->hasPermission('production_pending') ? 'checked' : '' }}
                                                                name="permission[]" id="pproduction_pending"
                                                                value='production_pending'>Pending Production</label>
                                                        <label for="pproduction_rejected"> <input type="checkbox"
                                                                {{ $role->hasPermission('production_rejected') ? 'checked' : '' }}
                                                                name="permission[]" id="pproduction_rejected"
                                                                value='production_rejected'>Rejected Production</label>
                                                        <label for="pproduction_approved"> <input type="checkbox"
                                                                {{ $role->hasPermission('production_approved') ? 'checked' : '' }}
                                                                name="permission[]" id="pproduction_approved"
                                                                value='production_approved'>Approved Production</label>
                                                    </fieldset>
                                                    <hr>
                                                    <fieldset>
                                                        <legend>Samples</legend>
                                                        <label for="psample_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('sample_list') ? 'checked' : '' }}
                                                                name="permission[]" id="psample_list"
                                                                value='sample_list'>Sample List</label>

                                                    </fieldset>

                                                    <fieldset>
                                                        <legend>Product Manufacturing</legend>
                                                        <label for="all_products"> <input type="checkbox"
                                                                {{ $role->hasPermission('all_products') ? 'checked' : '' }}
                                                                name="permission[]" id="all_products"
                                                                value='all_products'>All Products</label>
                                                                <label for="add_products"> <input type="checkbox"
                                                                    {{ $role->hasPermission('add_products') ? 'checked' : '' }}
                                                                    name="permission[]" id="add_products"
                                                                    value='add_products'>Add</label>
                                                                    <label for="edit_products"> <input type="checkbox"
                                                                        {{ $role->hasPermission('edit_products') ? 'checked' : '' }}
                                                                        name="permission[]" id="edit_products"
                                                                        value='edit_products'>Edit</label>
                                                                        <label for="delete_products"> <input type="checkbox"
                                                                            {{ $role->hasPermission('delete_products') ? 'checked' : '' }}
                                                                            name="permission[]" id="delete_products"
                                                                            value='delete_products'>Delete</label>
                                                        <label for="pending_products_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('pending_products_list') ? 'checked' : '' }}
                                                                name="permission[]" id="pending_products_list"
                                                                value='pending_products_list'>Pending Products</label>
                                                        <label for="confirmed_products_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('confirmed_products_list') ? 'checked' : '' }}
                                                                name="permission[]" id="confirmed_products_list"
                                                                value='confirmed_products_list'>Confirmed Products</label>
                                                        <label for="processing_products_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('processing_products_list') ? 'checked' : '' }}
                                                                name="permission[]" id="processing_products_list"
                                                                value='processing_products_list'>Proccessing
                                                            Products</label>
                                                        <label for="packaging_products_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('packaging_products_list') ? 'checked' : '' }}
                                                                name="permission[]" id="packaging_products_list"
                                                                value='packaging_products_list'>Packaging Products</label>
                                                        <label for="ready_to_stock_products_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('ready_to_stock_products_list') ? 'checked' : '' }}
                                                                name="permission[]" id="ready_to_stock_products_list"
                                                                value='ready_to_stock_products_list'>Ready To Stock
                                                            Products</label>
                                                        <label for="in_stocked_products_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('in_stocked_products_list') ? 'checked' : '' }}
                                                                name="permission[]" id="in_stocked_products_list"
                                                                value='in_stocked_products_list'>In Stock Products</label>
                                                        <label for="rejected_products_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('rejected_products_list') ? 'checked' : '' }}
                                                                name="permission[]" id="rejected_products_list"
                                                                value='rejected_products_list'>Rejected Products</label>

                                                    </fieldset>

                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-sm btn-info"
                                                        value="Update Permission">
                                                </div>
                                            </form>
                                            {{-- Production Permission End --}}
                                        @elseif ($role->role_name == 'purchase')
                                            {{-- Factory Manager Permission Start --}}
                                            <form
                                                action="{{ route('admin.addPermission', ['user' => $user, 'role' => $role->id]) }}"
                                                method="POST">
                                                @csrf

                                                @if ($role->permissionCount() < 1)
                                                <label for="all"> <input type="checkbox" checked id="all"
                                                        value='all'>All</label>
                                            @endif
                                                <fieldset>
                                                    <legend>Requisition</legend>
                                                    <label for="pu_req_list"> <input type="checkbox"
                                                            {{ $role->hasPermission('req_list') ? 'checked' : '' }}
                                                            name="permission[]" id="pu_req_list" value='req_list'>
                                                       All List</label>

                                                    <label for="pu_req_pending"> <input type="checkbox"
                                                            {{ $role->hasPermission('req_pending') ? 'checked' : '' }}
                                                            name="permission[]" id="pu_req_pending"
                                                            value='req_pending'>Pending </label>

                                                    <label for="pu_req_approved"> <input type="checkbox"
                                                            {{ $role->hasPermission('req_approved') ? 'checked' : '' }}
                                                            name="permission[]" id="pu_req_approved"
                                                            value='req_approved'>Approved </label>
                                                    <label for="pu_req_pending_purchase"> <input type="checkbox"
                                                            {{ $role->hasPermission('req_pending_purchase') ? 'checked' : '' }}
                                                            name="permission[]" id="pu_req_pending_purchase"
                                                            value='req_pending_purchase'>Pending Purchase</label>
                                                    <label for="pu_req_approved_purchase"> <input type="checkbox"
                                                            {{ $role->hasPermission('req_approved_purchase') ? 'checked' : '' }}
                                                            name="permission[]" id="pu_req_approved_purchase"
                                                            value='req_approved_purchase'>Pending Approved</label>
                                                    <label for="pu_req_purchase"> <input type="checkbox"
                                                            {{ $role->hasPermission('req_purchase') ? 'checked' : '' }}
                                                            name="permission[]" id="pu_req_purchase"
                                                            value='req_purchase'>Purchase</label>
                                                    <label for="pu_req_collected"> <input type="checkbox"
                                                            {{ $role->hasPermission('req_collected') ? 'checked' : '' }}
                                                            name="permission[]" id="pu_req_collected"
                                                            value='req_collected'>Collected</label>
                                                    <label for="pu_req_stocked"> <input type="checkbox"
                                                            {{ $role->hasPermission('req_stocked') ? 'checked' : '' }}
                                                            name="permission[]" id="pu_req_stocked"
                                                            value='req_stocked'>Stocked</label>
                                                </fieldset>

                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-sm btn-info"
                                                        value="Update Permission">
                                                </div>
                                            </form>
                                            {{-- Factory Manager Permission End --}}
                                        @elseif ($role->role_name == 'factory_manager')
                                            {{-- Factory Manager Permission Start --}}
                                            <form
                                                action="{{ route('admin.addPermission', ['user' => $user, 'role' => $role->id]) }}"
                                                method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    @if ($role->permissionCount() < 1)
                                                        <label for="all"> <input type="checkbox" checked id="all"
                                                                value='all'>All</label>
                                                    @endif
                                                    <fieldset>
                                                        <legend>Requisition</legend>
                                                        <label for="f_req_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('req_list') ? 'checked' : '' }}
                                                                name="permission[]" id="f_req_list" value='req_list'>
                                                            All List</label>

                                                        <label for="freq_pending"> <input type="checkbox"
                                                                {{ $role->hasPermission('req_pending') ? 'checked' : '' }}
                                                                name="permission[]" id="freq_pending"
                                                                value='req_pending'>Pending </label>

                                                        <label for="freq_approved"> <input type="checkbox"
                                                                {{ $role->hasPermission('req_approved') ? 'checked' : '' }}
                                                                name="permission[]" id="freq_approved"
                                                                value='req_approved'>Approved </label>
                                                        <label for="freq_pending_purchase"> <input type="checkbox"
                                                                {{ $role->hasPermission('req_pending_purchase') ? 'checked' : '' }}
                                                                name="permission[]" id="freq_pending_purchase"
                                                                value='req_pending_purchase'>Pending Purchase</label>
                                                        <label for="freq_approved_purchase"> <input type="checkbox"
                                                                {{ $role->hasPermission('req_approved_purchase') ? 'checked' : '' }}
                                                                name="permission[]" id="freq_approved_purchase"
                                                                value='req_approved_purchase'>Pending Approved</label>
                                                        <label for="freq_purchase"> <input type="checkbox"
                                                                {{ $role->hasPermission('req_purchase') ? 'checked' : '' }}
                                                                name="permission[]" id="freq_purchase"
                                                                value='req_purchase'>Purchase</label>
                                                        <label for="freq_collected"> <input type="checkbox"
                                                                {{ $role->hasPermission('req_collected') ? 'checked' : '' }}
                                                                name="permission[]" id="freq_collected"
                                                                value='req_collected'>Collected</label>
                                                        <label for="freq_stocked"> <input type="checkbox"
                                                                {{ $role->hasPermission('req_stocked') ? 'checked' : '' }}
                                                                name="permission[]" id="freq_stocked"
                                                                value='req_stocked'>Stocked</label>
                                                    </fieldset>

                                                    <fieldset>
                                                        <legend>Materials</legend>
                                                        <label for="fraw_materials_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('raw_materials_list') ? 'checked' : '' }}
                                                                name="permission[]" id="fraw_materials_list"
                                                                value='raw_materials_list'>Raw Materials List</label>
                                                        <label for="fpack_materials_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('pack_materials_list') ? 'checked' : '' }}
                                                                name="permission[]" id="fpack_materials_list"
                                                                value='pack_materials_list'>Pack Materials List</label>
                                                        <label for="fstationery_materials_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('stationery_materials_list') ? 'checked' : '' }}
                                                                name="permission[]" id="fstationery_materials_list"
                                                                value='stationery_materials_list'>Stationery Materials
                                                            List</label>


                                                    </fieldset>

                                                    <fieldset>
                                                        <legend>Stocked Materials</legend>
                                                        <label for="fraw_stock_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('raw_stock_list') ? 'checked' : '' }}
                                                                name="permission[]" id="fraw_stock_list"
                                                                value='raw_stock_list'>Raw Stocks</label>
                                                        <label for="fpack_stock_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('pack_stock_list') ? 'checked' : '' }}
                                                                name="permission[]" id="fpack_stock_list"
                                                                value='pack_stock_list'>Pack Stocks</label>
                                                        <label for="fstationery_stock_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('stationery_stock_list') ? 'checked' : '' }}
                                                                name="permission[]" id="fstationery_stock_list"
                                                                value='stationery_stock_list'>Stationery Stocks</label>
                                                    </fieldset>

                                                    <hr>
                                                    <fieldset>
                                                        <legend>Ready Products</legend>
                                                        <label for="fready_product"> <input type="checkbox"
                                                                {{ $role->hasPermission('ready_product') ? 'checked' : '' }}
                                                                name="permission[]" id="fready_product"
                                                                value='ready_product'>Ready Products</label>
                                                    </fieldset>


                                                    <hr>
                                                    <fieldset>
                                                        <legend>Daily Production</legend>
                                                        <label for="fproduction_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('production_list') ? 'checked' : '' }}
                                                                name="permission[]" id="fproduction_list"
                                                                value='production_list'>Production List</label>

                                                        <label for="fproduction_add"> <input type="checkbox"
                                                                {{ $role->hasPermission('production_add') ? 'checked' : '' }}
                                                                name="permission[]" id="fproduction_add"
                                                                value='production_add'>Add</label>
                                                        <label for="fproduction_edit"> <input type="checkbox"
                                                                {{ $role->hasPermission('production_edit') ? 'checked' : '' }}
                                                                name="permission[]" id="fproduction_edit"
                                                                value='production_edit'>Edit</label>
                                                        <label for="fproduction_delete"> <input type="checkbox"
                                                                {{ $role->hasPermission('production_delete') ? 'checked' : '' }}
                                                                name="permission[]" id="fproduction_delete"
                                                                value='production_delete'>Delete</label>

                                                        <label for="fproduction_approved"> <input type="checkbox"
                                                                {{ $role->hasPermission('production_approved') ? 'checked' : '' }}
                                                                name="permission[]" id="fproduction_approved"
                                                                value='production_approved'>Approved</label>

                                                        <label for="fproduction_rejected"> <input type="checkbox"
                                                                {{ $role->hasPermission('production_rejected') ? 'checked' : '' }}
                                                                name="permission[]" id="fproduction_rejected"
                                                                value='production_rejected'>Rejected</label>

                                                        <label for="fproduction_pending_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('production_pending_list') ? 'checked' : '' }}
                                                                name="permission[]" id="fproduction_pending_list"
                                                                value='production_pending_list'>Pending Productions</label>
                                                        <label for="fproduction_rejected_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('production_rejected_list') ? 'checked' : '' }}
                                                                name="permission[]" id="fproduction_rejected_list"
                                                                value='production_rejected_list'>Rejected
                                                            Productions</label>
                                                        <label for="fproduction_approved_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('production_approved_list') ? 'checked' : '' }}
                                                                name="permission[]" id="fproduction_approved_list"
                                                                value='production_approved_list'>Approved
                                                            Productions</label>
                                                    </fieldset>
                                                    <hr>
                                                    <fieldset>
                                                        <legend>Samples</legend>
                                                        <label for="fsample_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('sample_list') ? 'checked' : '' }}
                                                                name="permission[]" id="fsample_list"
                                                                value='sample_list'>Sample List</label>

                                                    </fieldset>
                                                    <hr>
                                                    <fieldset>
                                                        <legend>Product Manufacturing</legend>
                                                        <label for="all_products"> <input type="checkbox"
                                                                {{ $role->hasPermission('all_products') ? 'checked' : '' }}
                                                                name="permission[]" id="all_products"
                                                                value='all_products'>All Products</label>
                                                        <label for="pending_products_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('pending_products_list') ? 'checked' : '' }}
                                                                name="permission[]" id="pending_products_list"
                                                                value='pending_products_list'>Pending Products</label>
                                                        <label for="confirmed_products_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('confirmed_products_list') ? 'checked' : '' }}
                                                                name="permission[]" id="confirmed_products_list"
                                                                value='confirmed_products_list'>Confirmed Products</label>
                                                        <label for="processing_products_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('processing_products_list') ? 'checked' : '' }}
                                                                name="permission[]" id="processing_products_list"
                                                                value='processing_products_list'>Proccessing
                                                            Products</label>
                                                        <label for="packaging_products_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('packaging_products_list') ? 'checked' : '' }}
                                                                name="permission[]" id="packaging_products_list"
                                                                value='packaging_products_list'>Packaging Products</label>
                                                        <label for="ready_to_stock_products_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('ready_to_stock_products_list') ? 'checked' : '' }}
                                                                name="permission[]" id="ready_to_stock_products_list"
                                                                value='ready_to_stock_products_list'>Ready To Stock
                                                            Products</label>
                                                        <label for="in_stocked_products_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('in_stocked_products_list') ? 'checked' : '' }}
                                                                name="permission[]" id="in_stocked_products_list"
                                                                value='in_stocked_products_list'>In Stock Products</label>
                                                        <label for="rejected_products_list"> <input type="checkbox"
                                                                {{ $role->hasPermission('rejected_products_list') ? 'checked' : '' }}
                                                                name="permission[]" id="rejected_products_list"
                                                                value='rejected_products_list'>Rejected Products</label>

                                                    </fieldset>


                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-sm btn-info"
                                                        value="Update Permission">
                                                </div>
                                            </form>
                                            {{-- Factory Manager Permission End --}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif

        </div>
    </div>


@endsection


@push('js')
    <script>

    </script>
@endpush
