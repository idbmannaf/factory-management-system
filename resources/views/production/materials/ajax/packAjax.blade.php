@forelse($packaging as $pack)
<tr>
    <td>{{ $pack->id }}</td>
    <td>
        @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
auth()->user()->selectRole('production')->hasPermission('pack_materials_edit'))
            <a class="text-success" href="" data-toggle="modal"
                data-target="#edit{{ $pack->id }}"><i
                    class="fas fa-edit"></i></a>
        @endif
        <a class="text-info" href="" data-toggle="modal"
            data-target="#view{{ $pack->id }}"> <i
                class="fas fa-eye"></i></a>
        @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
auth()->user()->selectRole('production')->hasPermission('pack_materials_delete'))
            <a class="text-danger"
                href="{{ route('admin.deleteMaterials', ['material' => $pack->id, 'type', 'pack']) }}"
                onclick="return confirm('Are you sure? You want to delete this Material??');"><i
                    class="fas fa-trash"></i></a>
        @endif
    </td>
    <td>
        @if ($pack->mandatory)
        <span class="badge badge-success"><i class="fas fa-check"></i></span>
        @else
        <span class="badge badge-danger"><i class="fas fa-times"></i></span>
        @endif
    </td>
    <td>
        @if ($pack->mandatory_qty)
            <span class="badge badge-success"><i class="fas fa-check"></i></span>
            @else
            <span class="badge badge-danger"><i class="fas fa-times"></i></span>
        @endif
    </td>
    <td>{{ $pack->name }}</td>

    <td>{{ $pack->unit }}</td>
    <td>{{ $pack->unit_value }}</td>
    <td>{{ $pack->category ? $pack->category->name : '' }}</td>
    <td>{{ $pack->dhplCat ? json_decode($pack->dhplCat->name)->en :'' }}</td>
    <td>{{ $pack->product_type }}</td>
    <td>{{ $pack->product_type_value }}</td>
    <td>
        @if ($pack->active)
            <span class="text-success">Activated</span>
        @else
            <span class="text-danger">InActivated</span>
        @endif
    </td>

</tr>
{{-- View Edit Modal Start --}}
@include('admin.modal.packagingModal')
{{-- View Edit Modal End --}}


@empty
<tr>
    <td colspan="5" class="text-danger h4">No Pack Found</td>
</tr>
@endforelse
