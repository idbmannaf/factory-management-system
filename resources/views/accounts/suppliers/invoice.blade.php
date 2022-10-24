<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice Download</title>
</head>
<body>
    <table style="width: 100%">
        <thead>
            <tr>
                <td colspna="5"  style="text-align:center;font-size: 25px"> Invoice {{$supplier->name}}</td>
            </tr>
        </thead>
    </table>
    <table>
        <thead>
            <tr>
                <td colspna="5" align="center" style="font-size: 18px"> Order No (<b>{{$order->id}}</b>) Details of {{$supplier->name}}</td>
            </tr>
        </thead>
    </table>


    <table class="table table-bordered" style="white-space: nowrap; width=100%;">
        <thead style="border-top: 2px solid; border-bottom:2px solid;">
            <tr>
                <th>Raw Material</th>
                <th>Raw Type</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Vat</th>
                <th>Final Price</th>
                <th>Total Price</th>
            </tr>
        </thead>

        <tbody id="orders">
            <?php
            $total_qty = 0;
            $total_price= 0;
            ?>
            @foreach($order->supplierRequisitionItems($supplier->id) as $item)
            <tr>
                <td>{{$item->raw_materials->name}}
                    ({{$item->raw_materials->unit_value. $item->raw_materials->unit}})
                </td>
                <td>{{$item->raw_type}}</td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->price}}</td>
                <td>{{$item->vat}}</td>
                <td>{{$item->final_price}}</td>
                <td>{{$item->final_price * $item->quantity}}</td>

                <?php
                $total_qty += $item->quantity;
                $total_price += $item->final_price * $item->quantity;
                ?>
            </tr>
            @endforeach
        <tfoot style="border-top: 2px solid">
            <tr>
                <th colspan="6" style=";text-align:right;font-size: 15px; font-weight: 700;">Total Price</th>
                <th style="font-size: 15px; font-weight: 700;">{{$total_price}}</th>
            </tr>
        </tfoot>
        </tbody>
    </table>

</body>
</html>
