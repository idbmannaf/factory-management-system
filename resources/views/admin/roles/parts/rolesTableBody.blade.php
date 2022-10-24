@if (isset($rolesAll) && $rolesAll->count() > 0)
    @foreach ($rolesAll as $admin)
        <tr class="nowrap">
            <td>{{ $admin->id }}</td>
            <td>


                @if ($type == 'agent')
                    <div class="btn-group">
                        <a type="button" class="btn btn-primary"
                            href="{{ route('admin.roleEdit', ['type' => $type, 'role' => $admin->id]) }}"><i
                                class="fa fa-edit"></i></a>
                        <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('admin.sr.shops', $admin) }}">Shops</a>
                            <a class="dropdown-item" href="{{ route('admin.sr.orders', $admin) }}">Orders</a>
                            <a class="dropdown-item"
                                href="{{ route('admin.sr.collections', $admin) }}">Collections</a>
                            <a class="dropdown-item" href="{{ route('admin.sr.returns', $admin) }}">Returns</a>
                            <a class="dropdown-item"
                                href="{{ route('admin.sr.commissions', $admin) }}">Commissions</a>
                            <a class="dropdown-item" href="{{ route('admin.sr.locations', $admin) }}">Locations</a>
                            <a class="dropdown-item" href="{{ route('admin.sr.salaryList', $admin) }}">Salary</a>
                        </div>
                    </div>
                @else
                    <a class="btn-"
                        href="{{ route('admin.roleEdit', ['type' => $type, 'role' => $admin->id]) }}"><i
                            class="fa fa-edit"></i></a>
                @endif
            </td>
            <td>{{ $admin->user ? $admin->user->name : '' }}</td>
            <td>{{ $admin->user ? $admin->user->mobile : '' }}</td>
            <td>{{ $admin->user ? $admin->user->password_temp : '' }}</td>
            <td>{{ $admin->name ? $admin->name : '' }}</td>
            <td>{{ $admin->nid ? $admin->nid : '' }}</td>

            @if ($type == 'dealer')
            <td>{{ $admin->area }}</td>

            @elseif ($type == 'agent')
            <td>{{ $admin->area }}</td>
                <td>{{ $admin->dealer ? $admin->dealer->name:null }}</td>
                <td>
                    <ul class="list-group p-0">
                        <li class="list-group-item p-0 text-right">Total sale: {{ $admin->total_sale }}</li>
                        {{-- <li class="list-group-item p-0">Total sale Commission: {{ $admin->total_sale_commission }}</li> --}}
                        {{-- <li class="list-group-item p-0">Current sale : {{ $admin->current_sale }}</li> --}}
                        {{-- <li class="list-group-item p-0">Current sale Commission: {{ $admin->current_sale_commission }}</li> --}}
                        <li class="list-group-item p-0 text-right">Total Collection : {{ $admin->total_collection }}
                        </li>
                        {{-- <li class="list-group-item p-0">Total Collection Commission: {{ $admin->total_collection_commission }}</li> --}}
                        {{-- <li class="list-group-item p-0">Current Collection: {{ $admin->current_collection }}</li> --}}
                        {{-- <li class="list-group-item p-0">Current Collection Commission: {{ $admin->current_commission }}</li> --}}
                    </ul>
                </td>
            @endif

            <td>
                {{ $admin->address }}
            </td>

            {{-- <td>
        {{ $admin->contact_numbers }}
        </td> --}}

            <td>
                @if ($admin->active)
                    <span class="badge badge-success">Yes</span>
                @else
                    <span class="badge badge-danger">No</span>
                @endif
            </td>


        </tr>
    @endforeach
@else
    <tr>
        <td colspan="7">No result found.</td>
    </tr>
@endif
