
<tr>
    <td>
       <a href="{{route('account.storeMoreSupplier',['item'=>$item->id,'requisition'=>$requisition->id])}}" class="btn  btn-sm btn-success updateSupplier" data-url=''><i class="fas fa-check"></i></a>
       <a href="#" class="btn  btn-sm btn-danger removeSupplier" data-url=''><i class="fas fa-times"></i></a>

        {{-- <button type="buttton" class="btn  btn-sm btn-success updateSupplier" data-url='{{route('account.storeMoreSupplier',['item'=>$item->id])}}'>Update</button></td> --}}
    {{-- <td>{{$item->user? $item->user->name : ''}}</td> --}}
    <td class="app">
        <select name="supplier" id="supplier" class=" " required>
            <option value="">Suppliers</option>
            @foreach ($suppliers as $supplier)
                <option
                    {{ $supplier->id == $item->supplier_id ? 'selected' : '' }}
                    value="{{ $supplier->id }}">{{ $supplier->name }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        {{ $item->raw_materials->name }}({{ $item->raw_materials->unit }}
        {{ $item->raw_materials->unit_value }})
    </td>
    <td>{{$item->category? $item->category->name : ''}}</td>
    <td>

        <b>Current Stock: </b> {{$item->total_stock()}} <br>
        <b>Total Batch: </b> {{$item->total_batch()}}

    </td>
    <th>
        <input type="number" value="{{ $item->quantity }}" required
        name="quantity" id="quantity">

    </th>
    <th>
        <input type="number" id="price" value="{{ $item->price }}" min="1" required
                name="price">

    </th>
    <th>
        <input type="number" value="{{ $item->vat }}" id="vat">

    </th>
    <th>
        {{ $item->final_price }}

    </th>
    <td>{{ $item->raw_type }}</td>
</tr>
