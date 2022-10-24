@if (isset($commissions) && $commissions->count() > 0)
@foreach ($commissions as $commission)
<tr class="nowrap">
    
    <td>
        @if (isset($type))
        {{ $loop->iteration }}
    @else
        
    {{ $loop->iteration+($commissions->perPage()*($commissions->currentPage()-1)) }}
    @endif
    </td>
    <td>
        <a class="btn border" href="{{ route('admin.ecommerce.order', $commission->order_id) }}">{{ $commission->order_id }}</a>
        
    </td>
    <td>
        <a class="btn border" href="{{ route('admin.ecommerce.product', $commission->product_id) }}">{{ $commission->product_id }}</a>
    </td>
    <td> &#2547; {{ $commission->total_price }}</td>
    <td>
        
        <div class="btn-group">
            <button class="btn border" >
                {{ $commission->agent->name }} 
            </button>
            <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ route('admin.sr.shops', $commission->agent) }}">Shops</a>
              <a class="dropdown-item" href="{{ route('admin.sr.orders', $commission->agent) }}">Orders</a>
              <a class="dropdown-item" href="{{ route('admin.sr.collections', $commission->agent) }}">Collections</a>
              <a class="dropdown-item" href="{{ route('admin.sr.returns', $commission->agent) }}">Returns</a>
              <a class="dropdown-item" href="{{ route('admin.sr.commissions', $commission->agent) }}">Commissions</a>
              <a class="dropdown-item" href="{{ route('admin.sr.salaryList', $commission->agent) }}">Salary</a>
            </div>
          </div>
    </td>
    <td>{{ $commission->sr_commission }}</td>
    <td> &#2547; {{ $commission->sr_amount }}</td>
    <td>
        <div class="btn-group">
            <button  class="btn border" >{{ $commission->source->name }}</button>
            <button type="button" class="btn w3-deep-orange dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('admin.shop.orders', $commission->source) }}">Orders</a>
                <a class="dropdown-item" href="{{ route('admin.shop.collections', $commission->source) }}">Collections</a>
                <a class="dropdown-item" href="{{ route('admin.shop.returns', $commission->source) }}">Returns</a>
                <a class="dropdown-item" href="{{ route('admin.shop.comissions', $commission->source) }}">Commissions</a>
            </div>
          </div>
        
    </td>
    <td>{{ $commission->shop_commission }}</td>
    <td> &#2547; {{ $commission->shop_amount }}</td>
    <td> &#2547; {{ $commission->system_balance }}</td>
    <td>{{ now()->parse($commission->tr_date)->format('d-M-Y') }}</td>
</tr>
@endforeach
@else
    <tr>
        <td colspan="14">No result found.</td>
    </tr>
@endif