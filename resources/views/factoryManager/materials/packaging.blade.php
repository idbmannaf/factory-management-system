@extends('factoryManager.layouts.factoryMaster')

@section('title')
    Factory Manager Dashboard
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
                        <li class="breadcrumb-item"><a href="#">Factory</a></li>
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
                        {{-- @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('pack_materials_add'))
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
                                                            {{ ucfirst($medicine->name) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label for="active">
                                            <input type="checkbox" name="active" checked id="active"> Active
                                        </label>
                                        <button type="submit" class="btn btn-info"><i
                                                class="fas fa-plus"></i>Add</button>
                                    </div>
                                </div>
                            </form>
                        @endif --}}
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered table-sm text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#SL</th>
                                        <th>Action</th>
                                        <th>Name of the Packing Materials</th>
                                        <th>Category</th>
                                        <th>Medicine Type</th>
                                        <th>Unit</th>
                                        <th>Unit Value</th>
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
