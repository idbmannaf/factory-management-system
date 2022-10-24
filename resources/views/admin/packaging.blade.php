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
                        All Packaging
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.addMaterials',['type'=>'pack'])}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Enter Name..">
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <select name="category" id="category" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ ucfirst($cat->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <select name="unit" id="unit" class="form-control">
                                            <option value="">Select Unit</option>
                                            @foreach (config('parameter.pack_unit') as $unit)
                                            <option value="{{$unit}}">{{ucfirst($unit)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <input type="number" step="any" min="0" name="unit_value" class="form-control"
                                            placeholder="Unit Value..">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="active">
                                    <input type="checkbox" name="active" id="active"> Active
                                </label>
                                <button type="submit" class="btn btn-info"><i class="fas fa-plus"></i>Add</button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-bordered table-sm">
                            <thead>
                            <tr>
                                <th>#SL</th>
                                <th>Action</th>
                                <th>Name of the Packing Materials</th>
                                <th>Category</th>
                                <th>Unit</th>
                                <th>Unit Value</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($packaging as $pack)
                                <tr>
                                    <td>{{$pack->id}}</td>
                                    <td>
                                        <a class="text-success" href="" data-toggle="modal" data-target="#edit{{$pack->id}}"><i
                                                class="fas fa-edit"></i></a>
                                        <a class="text-info" href="" data-toggle="modal" data-target="#view{{$pack->id}}"> <i
                                                class="fas fa-eye"></i></a>
                                        <a class="text-danger" href="{{route('admin.deleteMaterials',['material'=>$pack->id,'type','pack'])}}" onclick="return confirm('Are you sure? You want to delete this Material??');"><i class="fas fa-trash"></i></a>
                                    </td>
                                    <td>{{$pack->name}}</td>
                                    <td>{{$pack->category ? $pack->category->name : ''}}</td>
                                    <td>{{$pack->unit}}</td>
                                    <td>{{$pack->unit_value}}</td>
                                    <td>
                                        @if ($pack->active)
                                            <span class="text-success">Activated</span>
                                        @else
                                            <span class="text-danger">InActivated</span>
                                        @endif
                                    </td>

                                </tr>
                                 {{-- View Edit Modal Start  --}}
                                 @include('admin.modal.packagingModal')
                                 {{-- View Edit Modal End  --}}


                            @empty
                                <tr>
                                    <td colspan="5" class="text-danger h4">No Pack Found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>


@endsection



@push('js')


@endpush
