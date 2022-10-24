@extends('production.layouts.productionMaster')

@section('title')
    Production Dashboard
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
                        <h4> View {{$sample->name}}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <p><b>Name: </b> {{$sample->name}}</p>
                    <p><b>Unit: </b>{{$sample->unit}}</p>
                    <p><b>Unit Value: </b>{{$sample->unit_value}}</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Raw</th>
                                <th>Raw Type</th>
                                <th>Unit</th>
                                <th>Unit Value</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($sample->sample_items as $sampleItem)
                                <tr>
                                    <td>{{$sampleItem->raw? $sampleItem->raw->name : ''}}</td>
                                    <td>{{$sampleItem->raw? $sampleItem->raw->type : ''}}</td>
                                    <td>{{$sampleItem->raw? $sampleItem->raw->unit : ''}}</td>
                                    <td>{{$sampleItem->unit_value}}</td>
                                    <td>{{\Carbon\Carbon::parse($sampleItem->created_at)->format('d M,Y')}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-danger h5">No Samples Found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection


@push('js')

@endpush

