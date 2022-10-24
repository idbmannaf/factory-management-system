<div class="table-responsive" style="min-height: 30vh;">
    <table class="table table-sm table-striped table-bordered">
        <thead>
            <tr>
                <th>Product Id</th>
                <th>Product name</th>
                <th>Total sold Qty.</th>
                <th>Total return Qty.</th>
                <th>MRP</th>
                <th>Total Shop Com.</th>
                <th>Order Amount</th>
                <th>Total SR Com.</th>
                <th>Total Factory Price</th>
                <th>Total Factory Cost</th>
                <th>Revenue</th>

            </tr>
        </thead>
        <tbody>
            @php
                $delivered_quantity = 0;
                $return_quantity = 0;
                $shop_amount = 0;
                $mrp = 0;
                $sr_amount = 0;
                $collection_amount = 0;
                $factoryPrice = 0;
                $system_balance = 0;
            @endphp
            @foreach ($products as $product)
                <tr class="nowrap">
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->sales->sum('delivered_quantity') }}</td>
                    <td>{{ $product->returns->sum('return_quantity') }}</td>
                    <td>&#2547; {{ $product->sale_price*$product->sales->sum('delivered_quantity') }}</td>
                    <td>&#2547; {{ $product->sales->sum('shop_amount') }}</td>
                    <td>&#2547; {{ $product->sales->sum('collection_amount') }}</td>
                    <td>&#2547; {{ $product->sales->sum('sr_amount') }}</td>
                    <td>&#2547; {{ $product->purchase_price*$product->sales->sum('delivered_quantity') }}</td>
                    <td>&#2547; {{$product->purchase_price*$product->sales->sum('delivered_quantity') - $product->sales->sum('system_balance') }}</td>
                    <td>&#2547; {{ $product->sales->sum('system_balance') }}</td>
                    
                </tr>
                @php
                    $delivered_quantity = $delivered_quantity + $product->sales->sum('delivered_quantity');
                    $return_quantity = $return_quantity + $product->returns->sum('return_quantity');
                    $shop_amount = $shop_amount + $product->sales->sum('shop_amount');
                    $sr_amount = $sr_amount + $product->sales->sum('sr_amount');
                    $collection_amount = $collection_amount + $product->sales->sum('collection_amount');
                    $factoryPrice = $factoryPrice + $product->purchase_price*$product->sales->sum('delivered_quantity');
                    $mrp = $mrp + $product->sale_price*$product->sales->sum('delivered_quantity');
                    $system_balance = $system_balance + $product->sales->sum('system_balance');
                @endphp
            @endforeach
                <tr class="w3-lime">
                    <td></td>
                    <td>Total</td>
                    <th> {{ $delivered_quantity }} </th>
                    <th> {{ $return_quantity }}</th>
                    <th> &#2547; {{ $mrp }} </th>
                    <th> &#2547; {{ $shop_amount }} </th>
                    <th> &#2547; {{ $collection_amount }}</th>
                    <th> &#2547; {{ $sr_amount }}</th>
                    <th> &#2547; {{ $factoryPrice }}</th>
                    <th> &#2547; {{ $factoryPrice - $system_balance }}</th>
                    <th> &#2547; {{ $system_balance }}</th>
                </tr>
        </tbody>
        <thead>
            <tr>
                <th>Product Id</th>
                <th>Product name</th>
                <th>Total sold Qty.</th>
                <th>Total return Qty.</th>
                <th>MRP</th>
                <th>Total Shop Com.</th>
                <th>Order Amount</th>
                <th>Total SR Com.</th>
                <th>Total Factory Price</th>
                <th>Total Factory Cost</th>
                <th>Revenue</th>

            </tr>
        </thead>
    </table>
</div>
<div>
    {{-- {{ $products->links() }} --}}
</div>