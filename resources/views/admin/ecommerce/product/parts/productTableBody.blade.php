@if (isset($products) && $products->count() > 0)
@foreach ($products as $product)
<tr class="text-center">
    <td>{{ $product->id }}</td>
    <td class="text-center">
        <div class="btn-group">
            <a type="button" class="btn btn-primary" href="{{ route('admin.ecommerce.product.edit', $product) }}"><i class="fa fa-edit"></i></a>
            <button type="button" class="btn btn-primary w3-opacity dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ route('admin.ecommerce.product', $product) }}">View</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Delete</a>
            </div>
          </div>
    </td>
    <td class="text-center">
        @if ($product->status == 'pending')
            <button class="btn btn-success btn-sm" id="publish_button_{{ $product->id }}" onclick="publish('{{ route('admin.ecommerce.product.publish', $product) }}',{{ $product->id }})"> <i class="fas fa-check"></i> Publish</button>
        @else
            <button class="btn btn-success btn-sm disabled"><i class="fas fa-check-double"></i> Published</button>
        @endif
    </td>
    <td class="text-center"><img style="max-width: 100%; max-height: 40px;margin: auto;" src="{{ $product->feature_img }}" alt=""></td>
    <td>{{ $product->category->name ?? '' }}</td>
    <td>{{ $product->name }}</td>
    <td>{{ ucfirst($product->type) }}</td>
    <td>{{ ucfirst($product->type_value) }}</td>
    <td>{{ $product->unit }}</td>
    <td>{{ $product->unit_value }}</td>
    <td class="text-center">
        &#2547; {{ $product->sale_price }} 
   </td>
</tr>
@endforeach
@else
    <tr>
        <td colspan="15">No result found.</td>
    </tr>
@endif