<tr>
    <td>{{$rawStockModifyHistory->raw->name}}</td>
    <td>{{$rawStockModifyHistory->previous_stock}}</td>
    <td>{{$rawStockModifyHistory->addition}}</td>
    <td>{{$rawStockModifyHistory->wastage}}</td>
    <td>{{$rawStockModifyHistory->new_stock}}</td>
    <td>{{$rawStockModifyHistory->remark}}</td>
    <td>{{\Carbon\Carbon::parse($rawStockModifyHistory->created_at)->format('d M, Y')}}</td>
</tr>
