@extends('admin.layouts.adminMaster')
@section('title')
    SR Commission List
@endsection
@push('css')
<style>

</style>
@endpush

@section('content')

<div class="card">
    <div class="card-header w3-purple h3">
        {{ $agent->name }} Commission List
    </div>
    <div class="card-body">
        @include('admin.roles.sr.srInfo')
        <div class="table-responsive">
            <table class="table table-bordered table-sm table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category</th>
                        <th>Commission % </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($commissions as $commission)
                        <tr>
                            <td>{{ $commission->id }}</td>
                            <td>{{ $commission->category ? $commission->category->name : ''}}</td>
                            <td>{{ $commission->commission }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="">
            {{ $commissions->links() }}
        </div>
    </div>
</div>


@endsection


@push('js')
<script>
</script>
@endpush
