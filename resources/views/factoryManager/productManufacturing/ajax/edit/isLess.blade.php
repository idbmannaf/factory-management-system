<div class="table-responsive">
    <input type="hidden" name="status" value="{{$status}}">
    <table class="table table-borderd">
        <thead>
            <tr>
                <th>Raw</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
    $total_unit_price= 0;
    $total_price= 0;
            ?>
            @foreach ($product->product_materials as $product_material)
            <input type="hidden" name="ids[]" value="{{$product_material->id}}">
            <tr>
                <td>{{$product_material->raw->name}} {{$product_material->raw->unit_value .$product_material->raw->unit}}</td>
                <td>{{$product_material->quantity - $multiply}} ({{$multiply}})
                    <input type="hidden" name="quantity[]" value="{{$product_material->quantity - $multiply}}">
                </td>

                <td>{{$product_material->unit_price}}</td>
                <td>{{$product_material->unit_price * $multiply}}
                    <input type="hidden" name="quantity[]" value="{{$product_material->unit_price * $multiply}}">
                </td>
                <?php
                $total_unit_price +=$product_material->unit_price;
                $total_price += $product_material->unit_price * $multiply;
                ?>
            </tr>

            @endforeach
        </tbody>
    </table>
    <table class="table table-hovered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Unit</th>
                <th>Unit Value</th>
                <th>Total Unit Price</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>{{$product->sample_name}}</td>
                <td>{{$product->sample_unit}} </td>
                <td>{{$product->sample_unit_value}} </td>
                <td>
                    {{$total_unit_price}}
                    <input type="hidden" name="sample_unit_price" value="{{$total_unit_price}}">
                </td>
                <td>
                    {{$product->total_price}}
                    <input type="hidden" name="sample_total_price" value="{{$product->total_price}}">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" style="width: 150px;" name="name" value="{{$product->name}}">
                </td>
                <td>
                    <input type="text" name="unit" value="{{$product->unit}}">
                </td>
                <td>
                    <input type="text" name="unit_value" value="{{$product->unit_value}}">
                </td>
                <td>
                    <input type="number" name="unit_price" value="{{round($total_price)}}">
                </td>
                <td>
                    <input type="number" name="total_price" value="{{$total_price}}">
                </td>

            </tr>
        </tbody>
    </table>
</div>
