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
