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
                        Raw Materials <span data-href="{{route('downloadNow',['type'=>'materials','status'=>'raw'])}}" id="export" class="btn btn-success btn-sm float-right" onclick="exportTasks(event.target);"> <i class="fas fa-download"></i> Export</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>#SL</th>
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
