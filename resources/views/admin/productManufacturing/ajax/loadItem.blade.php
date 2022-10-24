@if ($type == 'pack_cat')
    <select name="medicine_type" id="medicine_type" class="form-control"
        data-url="{{ route('admin.loadItem', ['type' => 'show_pack']) }}">
        <option value="">Select Category</option>
        @foreach ($dhpl_cats as $dhpl_cat)
            <option value="{{ $dhpl_cat->dhplCat ? $dhpl_cat->dhplCat->id : '' }}">
                {{ $dhpl_cat->dhplCat ? $dhpl_cat->dhplCat->name : '' }}</option>
        @endforeach
    </select>
@elseif ($type == 'show_pack')
    @if (isset($mandetories))
        <strong>Mandetory</strong>
        @foreach ($mandetories as $item)
            <label for="mendo{{ $item->id }}"> <input type="radio" name="mandotory_stock_id"
                    value="{{ $item->id }}" id="mendo{{ $item->id }}">{{ $item->id }}</label>
        @endforeach
    @endif
    @if (isset($optionals))
        <strong>Optional</strong>
        @foreach ($optionals as $item)
            <label for="mendo{{ $item->id }}"> <input type="radio" name="mandotory_stock_id"
                    value="{{ $item->id }}" id="mendo{{ $item->id }}"> {{ $item->id }}</label>
        @endforeach
    @endif
@endif
