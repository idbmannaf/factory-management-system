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
                                            @if (auth()->user()->selectRole('accounts')->permissionCount() < 1 ||
                                            auth()->user()->selectRole('accounts')->hasPermission('stationery_materials_edit'))
                                            <a href="" data-toggle="modal" data-target="#edit{{ $stationery->id }}"><i
                                                    class="fas fa-edit"></i></a>
                                                    @endif
                                            <a href="" data-toggle="modal" data-target="#view{{ $stationery->id }}"> <i
                                                    class="fas fa-eye"></i></a>

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
                                        {{-- Supplier Edit Modal --}}
<div class="modal" id="edit{{ $stationery->id }}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit {{ $stationery->name }}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('admin.updateMaterials', ['material' => $stationery->id, 'type' => 'stationery']) }}" method="post">
            @csrf
            <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $stationery->name }}"
                               placeholder="Enter Name..">
                    </div>

                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <select name="unit" id="unit" class="form-control">
                            <option value="">Select Unit</option>
                            @foreach (config('parameter.all_unit') as $unit)
                                <option {{ $stationery->unit == $unit ? 'selected' : '' }} value="{{ $unit }}">
                                    {{ ucfirst($unit) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="unit_value">Unit Value</label>
                        <input type="number" id="unit_value" name="unit_value" value="{{ $stationery->unit_value }}"
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
<div class="modal" id="view{{ $stationery->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">{{ $stationery->name }}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p><b>Name: </b> {{ $stationery->name }}</p>
                <p><b>Unit: </b> {{ $stationery->unit }}</p>
                <p><b>Unit Value: </b> {{ $stationery->unit_value }}</p>

                <p><b>Active: </b>
                    @if ($stationery->active)
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
