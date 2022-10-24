<table class="table table-borderd table-sm showI">
    <thead>
        <tr>
            <th></th>
            <th>Pack Material Name</th>
            <th>Unit</th>
        </tr>
    </thead>
    <tbody class="loadItems">
        @foreach ($pack_materials as $pack_material)
        <tr>
            <td>
                <input
                type="checkbox"
                class="input-select-item"
                name="selected"
                id="id{{$pack_material->id}}"
                value="{{$pack_material->id}}"
                {{$pack_material->temp_pack_requisition->where('user_id',Auth::id())->first() ? 'checked' : ''}}
                data-select-url="{{route('production.selectProduct',['pack_material'=>$pack_material->id])}}"
                data-unselect-url="{{route('production.unSelectProduct',['pack_material'=>$pack_material->id])}}"
                >
            </td>
            <td>{{ $pack_material->name }}</td>
            <td>{{$pack_material->unit_value . $pack_material->unit}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@if ($type == 'search')
{{$pack_materials->appends(['q'=>$q,'type'=>$type,'pack_id'=>$pack_id,'medicine_type'=>$medicine_type])->render()}}
@else
{{$pack_materials->render()}}
@endif
