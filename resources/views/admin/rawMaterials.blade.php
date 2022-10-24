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
                    <form action="{{ route('admin.addMaterials', ['type' => 'raw']) }}" method="post">
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
                                            @foreach (config('parameter.raw_unit') as $unit)
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
                                            <a href="" data-toggle="modal" data-target="#edit{{ $raw->id }}"><i
                                                    class="fas fa-edit"></i></a>
                                            <a href="" data-toggle="modal" data-target="#view{{ $raw->id }}"> <i
                                                    class="fas fa-eye"></i></a>
                                            <a href="{{ route('admin.deleteMaterials', ['material' => $raw->id, 'type', 'raw']) }}"
                                                onclick="return confirm('Are you sure? You want to delete this Material??');"><i
                                                    class="fas fa-trash"></i></a>
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
                                            {{-- View Edit Modal Start  --}}
                                            @include('admin.modal.rowMaterialModal')
                                            {{-- View Edit Modal End  --}}

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
