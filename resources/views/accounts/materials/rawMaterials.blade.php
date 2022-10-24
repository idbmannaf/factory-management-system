@extends('accounts.layouts.accountMaster')

@section('title')
    Accounts Dashboard
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

                        <small>Raw Materials</small>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Raw Materials</li>
                    </ol>
                </div>
            </div>
            <div class="container">
                @include('alerts.alerts')
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            All Materials
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive mt-3">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>#SL</th>
                                        <th>Action</th>
                                        <th>Name of the Raw</th>
                                        <th>Category</th>
                                        <th>Unit</th>
                                        <th>Unit Value</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($rawMaterials as $raw)
                                        <tr>
                                            <td>{{ $raw->id }}</td>
                                            <td>
                                                @if (auth()->user()->selectRole('accounts')->permissionCount() < 1 ||
                                                auth()->user()->selectRole('accounts')->hasPermission('raw_materials_edit'))
                                                <a href="" data-toggle="modal" data-target="#edit{{ $raw->id }}"><i
                                                        class="fas fa-edit"></i></a>
                                                        @endif
                                                <a href="" data-toggle="modal" data-target="#view{{ $raw->id }}"> <i
                                                        class="fas fa-eye"></i></a>

                                            </td>
                                            <td>{{ $raw->name }}</td>
                                            <td>{{ $raw->category ? $raw->category->name : '' }}</td>
                                            <td>{{ $raw->unit }}</td>
                                            <td>{{ $raw->unit_value }}</td>
                                            <td>
                                                @if ($raw->active)
                                                    <span class="text-success">Activated</span>
                                                @else
                                                    <span class="text-danger">InActivated</span>
                                                @endif
                                            </td>
                                            {{-- View Edit Modal Start --}}
                                            {{-- Supplier Edit Modal --}}
                                            <div class="modal" id="edit{{ $raw->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit {{ $raw->name }}</h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <form
                                                            action="{{ route('admin.updateMaterials', ['material' => $raw->id, 'type' => 'raw']) }}"
                                                            method="post">
                                                            @csrf
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="name">Name</label>
                                                                    <input type="text" name="name" id="name"
                                                                        class="form-control" value="{{ $raw->name }}"
                                                                        placeholder="Enter Name..">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="category">Category</label>
                                                                    <select name="category" id="category"
                                                                        class="form-control">
                                                                        <option value="">Select Category</option>
                                                                        @foreach ($categories as $cat)
                                                                            <option
                                                                                {{ $cat->id == $raw->category_id ? 'selected' : '' }}
                                                                                value="{{ $cat->id }}">
                                                                                {{ ucfirst($cat->name) }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="unit">Unit</label>
                                                                    <select name="unit" id="unit" class="form-control">
                                                                        <option value="">Select Unit</option>
                                                                        @foreach (config('parameter.raw_unit') as $unit)
                                                                            <option
                                                                                {{ $raw->unit == $unit ? 'selected' : '' }}
                                                                                value="{{ $unit }}">
                                                                                {{ ucfirst($unit) }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="unit_value">Unit Value</label>
                                                                    <input type="number" id="unit_value" name="unit_value"
                                                                        value="{{ $raw->unit_value }}"
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
                                            <div class="modal" id="view{{ $raw->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">{{ $raw->name }}</h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <p><b>Name: </b> {{ $raw->name }}</p>
                                                            <p><b>Category: </b>
                                                                {{ $raw->category ? $raw->category->name : '' }}</p>
                                                            <p><b>Unit: </b> {{ $raw->unit }}</p>
                                                            <p><b>Unit Value: </b> {{ $raw->unit_value }}</p>

                                                            <p><b>Active: </b>
                                                                @if ($raw->active)
                                                                    <span class="badge badge-success">Activated</span>
                                                                @else
                                                                    <span class="badge badge-danger">InActivated</span>
                                                                @endif
                                                            </p>

                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal">Close</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            {{-- View Edit Modal End --}}

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-danger h4">No Raw Materials Found</td>
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
    <!-- ChartJS -->
    <script src="{{ asset('chart.js/Chart.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"
        integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
