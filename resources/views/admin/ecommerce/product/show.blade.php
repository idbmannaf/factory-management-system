@extends('admin.layouts.adminMaster')

@push('css')
<style>

</style>
@endpush

@section('content')

<div class="card">
    <div class="card-header w3-purple h3">
        Product Details # {{ $product->id }}
    </div>

    <div class="card-body">

        <table class="table table-striped">
            <tr>
                <th>Product Name</th>
                <td>:</td>
                <td>{{ $product->name }}</td>
            </tr>
            <tr>
                <th>Product Short Details</th>
                <td>:</td>
                <td>{{ $product->excerpt }}</td>
            </tr>
            <tr>
                <th>Product Description</th>
                <td>:</td>
                <td>{{ $product->description }}</td>
            </tr>
            <tr>
                <th>What in Box</th>
                <td>:</td>
                <td>{{ $product->what_in_box }}</td>
            </tr>
            <tr>
                <th>Septic</th>
                <td>:</td>
                <td>{{ $product->septic ? 'Yes' : 'No' }}</td>
            </tr>
            <tr>
                <th>Liquid</th>
                <td>:</td>
                <td>{{ $product->liquid ? 'Yes' : 'No' }}</td>
            </tr>
            <tr>
                <th>Inflammable</th>
                <td>:</td>
                <td>{{ $product->inflammable ? 'Yes' : 'No' }}</td>
            </tr>
            <tr>
                <th>Pre-order</th>
                <td>:</td>
                <td>{{ $product->pre_order ? 'Yes' : 'No' }}</td>
            </tr>
            <tr>
                <th>Min. Order Quantity</th>
                <td>:</td>
                <td>{{ $product->min_order_quantity }}</td>
            </tr>
            <tr>
                <th>Factory Price</th>
                <td>:</td>
                <td>{{ $product->purchase_price }}</td>
            </tr>
            <tr>
                <th>Sale Price</th>
                <td>:</td>
                <td>{{ $product->sale_price }}</td>
            </tr>
            <tr>
                <th>Total Unit Ordered</th>
                <td>:</td>
                <td><b>{{ $product->orderItems->sum('total_quantity') }}</b></td>
            </tr>
            <tr>
                <th>Total Unit Shipped</th>
                <td>:</td>
                <td><b>{{ $product->orderItems->sum('total_shipped_quantity') }}</b></td>
            </tr>
            <tr>
                <th>Image</th>
                <td>:</td>
                <td>
                    <img style="max-width: 300px;" src="{{ $product->feature_img }}" alt="">
                </td>
            </tr>
        </table>

    </div>
</div>


@endsection


@push('js')

@endpush
