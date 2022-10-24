@extends('admin.layouts.adminMaster')
@section('title')
    SR Location List
@endsection
@push('css')
<style>

</style>
@endpush

@section('content')

<div class="card">
    <div class="card-header w3-purple h3">
        {{ $agent->name }} Location List
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
            @include('admin.roles.sr.srInfo')
            </div>
            <div class="col-md-6">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-sm table-striped">
                <thead>
                    <tr>
                        <th>Date Time</th>
                        <th>Latitude</th>
                        <th>Longitude </th>
                        <th>Location </th>
                        <th>Action </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($locations as $location)
                        <tr>
                            <td>{{ $location->created_at }}</td>
                            <td>{{ $location->lat }}</td>
                            <td>{{ $location->lng }}</td>
                            <td>{{ $location->location }}</td>
                            <td>
                                <a class="btn border" href="https://www.google.com/maps?q={{ $location->lat }}+{{ $location->lng }}"><i class="fas fa-map-marked-alt"></i> map</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="">
            {{ $locations->links() }}
        </div>
    </div>
</div>


@endsection


@push('js')
<script>
</script>
@endpush
