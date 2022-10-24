@if (isset($shops) && $shops->count() > 0)
@foreach ($shops as $shop)
<tr class="nowrap">
    <td>
    @if (isset($type))
    {{  $loop->iteration }}
    @else
    {{  $loop->iteration+($shops->perPage()*($shops->currentPage()-1)) }}</td>
    @endif
    <td>
        <div class="btn-group">
            <a  class="btn btn-success text-white" href="{{ route('admin.shop.edit', $shop) }}"><i class="fa fa-edit"></i></a>
            <button type="button" class="btn w3-deep-orange dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('admin.shop.orders', $shop) }}">Orders</a>
                <a class="dropdown-item" href="{{ route('admin.shop.collections', $shop) }}">Collections</a>
                <a class="dropdown-item" href="{{ route('admin.shop.returns', $shop) }}">Returns</a>
                <a class="dropdown-item" href="{{ route('admin.shop.comissions', $shop) }}">Commissions</a>
            </div>
          </div>
    </td>
    <td>{{ $shop->active ? 'Active' : 'Inactive' }}</td>
    <td>
        <ul class="list-group p-0">
          <li class="list-group-item p-0">Total sale: {{ $shop->total_sale }}</li>
          {{-- <li class="list-group-item p-0">Total sale Commission: {{ $shop->total_sale_commission }}</li> --}}
          {{-- <li class="list-group-item p-0">Current sale : {{ $shop->current_sale }}</li> --}}
          {{-- <li class="list-group-item p-0">Current sale Commission: {{ $shop->current_sale_commission }}</li> --}}
          <li class="list-group-item p-0">Total Collection : {{ $shop->total_collection }}</li>
          {{-- <li class="list-group-item p-0">Total Collection Commission: {{ $shop->total_collection_commission }}</li> --}}
          {{-- <li class="list-group-item p-0">Current Collection: {{ $shop->current_collection }}</li> --}}
          {{-- <li class="list-group-item p-0">Current Collection Commission: {{ $shop->current_commission }}</li> --}}
        </ul>
      </td>
    <td>{{ $shop->name }}</td>
    <td>{{ $shop->owner_name }}</td>
    <td>{{ $shop->mobile }}</td>
    <td> {{ $shop->description }}</td>
    <td>{{ $shop->address }}</td>
    <td>{{ Str::ucfirst($shop->type) }}</td>
    <td></td>
</tr>
@endforeach
@else
    <tr>
        <td colspan="7">No Result Found.</td>
    </tr>
@endif