<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Unit</th>
                <th>Type</th>
                <th>Quantity</th>
                {{-- <th>Unit Price</th>
                <th>Total Price</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($product->pack_product_materials as $product_material)
            <tr>
                <td>{{$product_material->id}}</td>
                <td>{{$product_material->package_raw->name}} ({{$product_material->package_raw->unit_value .
                    $product_material->package_raw->unit }})</td>

                <td>{{$product_material->unit}}</td>
                <td>{{$product_material->type}}</td>
                <td>{{$product_material->quantity}}</td>
                {{-- <td>{{$product_material->unit_price}}</td>
                <td>{{$product_material->total_price}}</td> --}}
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
