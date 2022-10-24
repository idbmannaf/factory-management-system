@extends('accounts.layouts.accountMaster')

@section('title')
    Accounts Dashboard
@endsection

@push('css')


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
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered table-sm">
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
                                            @if (auth()->user()->selectRole('accounts')->permissionCount() < 1 ||
                                            auth()->user()->selectRole('accounts')->hasPermission('pack_materials_edit'))
                                            <a class="text-success" href="" data-toggle="modal" data-target="#edit{{$pack->id}}"><i
                                                    class="fas fa-edit"></i></a>
                                                    @endif
                                            <a class="text-info" href="" data-toggle="modal" data-target="#view{{$pack->id}}"> <i
                                                    class="fas fa-eye"></i></a>

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
                                    {{-- Supplier Edit Modal --}}
<div class="modal" id="edit{{ $pack->id }}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit {{ $pack->name }}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('admin.updateMaterials', ['material' => $pack->id, 'type' => 'pack']) }}" method="post">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $pack->name }}"
                            placeholder="Enter Name..">
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" id="category" class="form-control">
                            <option value="">Select Category</option>
                            @foreach ($categories as $cat)
                                <option {{ $cat->id == $pack->category_id ? 'selected' : '' }}
                                    value="{{ $cat->id }}">{{ ucfirst($cat->name) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <select name="unit" id="unit" class="form-control">
                            <option value="">Select Unit</option>
                            @foreach (config('parameter.pack_unit') as $unit)
                                <option {{ $pack->unit == $unit ? 'selected' : '' }} value="{{ $unit }}">
                                    {{ ucfirst($unit) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="unit_value">Unit Value</label>
                        <input type="number" id="unit_value" name="unit_value" value="{{ $pack->unit_value }}"
                            class="form-control" placeholder="Unit Value..">
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>


{{-- Supplier View Modal --}}
<div class="modal" id="view{{ $pack->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">{{ $pack->name }}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p><b>Name: </b> {{ $pack->name }}</p>
                <p><b>Category: </b> {{ $pack->category ? $pack->category->name : '' }}</p>
                <p><b>Unit: </b> {{ $pack->unit }}</p>
                <p><b>Unit Value: </b> {{ $pack->unit_value }}</p>

                <p><b>Active: </b>
                    @if ($pack->active)
                        <span class="badge badge-success">Activated</span>
                    @else
                        <span class="badge badge-danger">InActivated</span>
                    @endif
                </p>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

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


    <!-- Main content -->
    <section class="content">

    </section>


    {{-- @include('welcome.includes.modals.modalLg') --}}

@endsection



@push('js')


@endpush
