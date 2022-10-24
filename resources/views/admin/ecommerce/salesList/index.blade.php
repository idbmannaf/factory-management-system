@extends('admin.layouts.adminMaster')

@push('css')
<style>

</style>
@endpush

@section('content')

<div class="card">
    <div class="card-header w3-purple h3">
        Products <a class="border px-2 rounded w3-hover-shadow w3-hover-blue" href="{{ route('admin.ecommerce.salesList.create') }}"><i class="fa fa-plus"></i></a>
    </div>
    <div class="card-body">
        <div class="table-responsive" style="min-height: 75vh;">
            <table class="table bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Product Count</th>
                        <th>Description</th>
                        <th>Banner</th>
                        <th>Position</th>
                        <th>Active</th>
                        <th>Featured</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salesList as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td><img style="max-width: 100%; max-height: 80px;" src="{{ $item->img_name }}" alt=""></td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->items->count() }}</td>
                            <td>{{ $item->description }}</td>
                            <td> <img style="max-width: 100%; max-height: 80px;" src="{{ $item->banner_name }}" alt=""></td>
                            <td>{{ $item->position }}</td>
                            <td>{{ $item->active ? 'Yes' : 'No' }}</td>
                            <td>{{ $item->featured ? 'Yes' : 'No' }}</td>
                            <td>
                                {{-- <a class="btn btn-secondary btn-sm" href="">view</a> --}}
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.ecommerce.salesList.edit', $item) }}">edit</a>
                                <a class="btn btn-danger btn-sm" href="" onclick="event.preventDefault(); if(confirm('are you sure to delete?')){$('#sales_list_delete_{{ $item->id }}').submit()}" >delete</a>
                                <form action="{{ route('admin.ecommerce.salesList.destroy', [$item]) }}" id="sales_list_delete_{{ $item->id }}" method="post">
                                    @csrf
                                    @method('delete')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="responsive">
            {{ $salesList->links() }}
        </div>
    </div>
</div>


@endsection


@push('js')
<script>

</script>
@endpush
