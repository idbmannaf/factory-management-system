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

                        <small>Stationeries</small>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Stationeries</li>
                    </ol>
                </div>
            </div>
            <div class="container">
                @include('alerts.alerts')
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            All Stationeries
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.addMaterials', ['type' => 'stationery']) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-10">
                                    <div class="row">
                                        <div class="col-12 col-md-3">
                                            <input type="text" name="name" class="form-control"
                                                   placeholder="Enter Name..">
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <select name="unit" id="unit" class="form-control">
                                                <option value="">Select Unit</option>
                                                @foreach (config('parameter.all_unit') as $unit)
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
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#SL</th>
                                    <th>Action</th>
                                    <th>Name</th>
                                    <th>Unit</th>
                                    <th>Unit Value</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($stationeries as $stationery)
                                    <tr>
                                        <td>{{ $stationery->id }}</td>
                                        <td>
                                            <a href="" data-toggle="modal" data-target="#edit{{ $stationery->id }}"><i
                                                    class="fas fa-edit"></i></a>
                                            <a href="" data-toggle="modal" data-target="#view{{ $stationery->id }}"> <i
                                                    class="fas fa-eye"></i></a>
                                            <a href="{{ route('admin.deleteStationery', ['stationery' => $stationery->id]) }}"
                                               onclick="return confirm('Are you sure? You want to delete this stationery??');"><i
                                                    class="fas fa-trash"></i></a>
                                        </td>
                                        <td>{{ $stationery->name }}</td>
                                        <td>{{ $stationery->unit }}</td>
                                        <td>{{ $stationery->unit_value }}</td>
                                        <td>
                                            @if ($stationery->active)
                                                <span class="text-success">Activated</span>
                                            @else
                                                <span class="text-danger">InActivated</span>
                                            @endif
                                        </td>
                                        {{-- View Edit Modal Start  --}}
                                        @include('stationeries.modal')
                                        {{-- View Edit Modal End  --}}

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-danger h4">No Raw Materials Found</td>
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
