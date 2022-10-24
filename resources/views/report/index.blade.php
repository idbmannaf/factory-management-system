

@extends('admin.layouts.adminMaster')

@section('title')
    Admin Dashboard
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('cp/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cp/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')
    <section class="content">
        <br>
        @include('alerts.alerts')
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Report
                    </div>
                </div>
                <div class="card-body">

                </div>

            </div>
        </div>
    </section>
@endsection


@push('js')


@endpush

