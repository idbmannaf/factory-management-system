@extends('factoryManager.layouts.factoryMaster')

@section('title')
    Factory Manager Dashboard
@endsection
@push('css')
@endpush

@section('content')
    <section class="content">
        <br>
        @include('alerts.alerts')
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        All Samples
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Action</th>
                                <th>Name</th>
                                <th>Unit</th>
                                <th>Unit Value</th>
                                <th>Procedure/Instruction</th>
                                <th>Active/Inactive</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($samples as $sample)
                            <tr>
                                <td>{{$sample->id}}</td>
                                <td>
                                    <a href="{{route('factory.viewSample',$sample)}}" class="text-success"><i class="fas fa-eye"></i></a>


                                </td>
                                <td>{{$sample->name}}</td>
                                <td>{{$sample->unit}}</td>
                                <td>{{$sample->unit_value}}</td>
                                <td>{{$sample->details}}</td>
                                <td>
                                    @if ($sample->active)
                                        <span class="badge badge-success">Activated</span>
                                    @else
                                        <span class="badge badge-danger">InActivated</span>
                                    @endif
                                </td>
                            </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-danger h5">No Samples Found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{$samples->render()}}
                </div>

            </div>
        </div>
    </section>
@endsection


@push('js')

@endpush

