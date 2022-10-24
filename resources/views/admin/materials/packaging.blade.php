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
                        <small>Packaging</small>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Packaging</li>
                    </ol>
                </div>
            </div>
            <div class="container">
                @include('alerts.alerts')
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">

                            All Packaging <a href="{{route('downloadNow',['type'=>'materials','status'=>'pack'])}}" id="export" class="btn btn-success btn-sm float-right"> <i class="fas fa-download"></i> Export</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.addMaterials', ['type' => 'pack']) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-10">
                                        <div class="row">

                                            <div class="col-12 col-md-6">
                                                <select name="categories[]" id="category" class="form-control" multiple>
                                                    <option value="">Select Category</option>
                                                    @foreach ($categories as $cat)
                                                        <option value="{{ $cat->id }}">{{ ucfirst($cat->name) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="medicine_type" id="medicine_types" class="form-control">
                                                    <option value="">Select Medicine Types</option>
                                                    @foreach ($medicine_types as $medicine)
                                                        <option value="{{ $medicine->id }}">
                                                            {{ ucfirst(json_decode($medicine->name)->en) }}
                                                        </option>
                                                    @endforeach
                                                </select><br>
                                                <label for="mendotory"> <input type="radio" name="mendotory" value="1" id="mendotory"> Mendotory</label>
                                                <label for="mendotory_qty"> <input type="radio" name="mendotory"  value="2" id="mendotory_qty"> Mendotory Qty</label>
                                                <label for="optional"> <input type="radio" name="mendotory"  value="0" id="optional"> Optional</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 text-right">
                                        <label for="active">
                                            <input type="checkbox" name="active" checked id="active"> Active
                                        </label> <br> <br>
                                        <button type="submit" class="btn btn-info"><i
                                                class="fas fa-plus"></i>Add</button>
                                    </div>
                                </div>
                            </form>
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered table-sm text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#SL</th>
                                        <th>Action</th>
                                        <th>Mandatory</th>
                                        <th>Mandatory Qty</th>
                                        <th>Name of the Packing Materials</th>
                                        <th>Unit</th>
                                        <th>Unit Value</th>
                                        <th>Category</th>
                                        <th>Medicine Type</th>
                                        <th>Type</th>
                                        <th>Type Value</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="showPack">
                                    @include('production.materials.ajax.packAjax')
                                </tbody>
                            </table>
                        </div>
                        {{ $packaging->render() }}
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
