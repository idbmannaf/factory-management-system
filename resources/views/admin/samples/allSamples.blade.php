@extends('admin.layouts.adminMaster')

@section('title')
    Admin Dashboard
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
                    <div class="d-flex justify-content-between">

                        <div>
                            All Samples <a class="btn btn-info" href="{{route('admin.createSample')}}"><i
                            class="fas fa-plus"></i></a>
                        </div>

                        <div>
                            <a href="{{ route('downloadNow', ['type' => 'sample', 'status' => 'all']) }}"
                                class="btn btn-success btn-sm"> <i class="fas fa-download"> </i>Download</a>
                        </div>
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
                                    <a href="{{route('admin.editSample',$sample)}}" class="text-info"><i class="fas fa-edit"></i></a>
                                    <a href="{{route('admin.viewSample',$sample)}}" class="text-success"><i class="fas fa-eye"></i></a>
                                    <form class="d-inline-block" action="{{route('admin.deleteSample',$sample)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Are you sure? you want to delete this Sample?')" type="submit" class="text-danger" style="border:none; background-color: transparent"><i class="fas fa-trash"></i></button>
                                    </form>

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

