@extends('admin.layouts.adminMaster')
@section('title')
    SR Collection List
@endsection
@push('css')
<style>

</style>
@endpush

@section('content')

<div class="card">
    <div class="card-header w3-purple h3">
        SR Collection List
    </div>
    <div class="card-body">
        @include('admin.roles.sr.srInfo')
        <div class="table-responsive">
            <table class="table table-bordered table-sm table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Action</th>
                        <th>Date</th>
                        {{-- <th>SR</th> --}}
                        <th>Shop</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($collections as $collection)
                        <tr>
                            <td>{{ $collection->id }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.collection.edit', $collection) }}">Details</a>    
                            </td>
                            <td>{{ now()->parse($collection->trans_date)->format('d M Y') }}</td>
                            {{-- <td>{{ $collection->agent->name }}</td> --}}
                            <td>{{ $collection->source->name }} ({{ $collection->source->mobile }})</td>
                            <td>{{ $collection->paid_amount }}</td>
                            <td>{{ Str::ucfirst($collection->status) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="">
            {{ $collections->links() }}
        </div>
    </div>
</div>


@endsection


@push('js')
<script>
</script>
@endpush
