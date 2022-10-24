
@forelse ($temp_packs as $temp)
    {{-- {{dd($temp->stock->raw->name)}} --}}
    <div class="card mandetoryContainer">
        <input type="hidden" class="temp_id" value="{{ $temp->id }}">
        <div style="position: absolute; top:0;right:0; color:red">
            <a href="{{ route('admin.removeMandetoryPack', $product->id) }}" class="btn btn-danger btn-sm removeMandetoryPack"
                style="hover:{color:red;}"><i class="fas fa-times fa-2x"></i></a>
        </div>
        <div class="card-body">

            {{-- Mandetory Section Start  --}}
            <div class="form-group">
                <fieldset id="mandetory">
                    <legend>Mandotory </legend>
                    <div class="text-danger msg"></div>
                    <span>
                        <strong>{{ $temp->stock->raw->name }}
                            {{ $temp->stock->raw->unit_value . $temp->stock->raw->unit }}
                        </strong>
                    </span>

                    <input type="number" class="mandetory_quantity" required min="1" value="0" placeholder="quantity"
                        data-url="{{ route('admin.getUnit') }}"
                        data-temp-url="{{ route('admin.onChangeMandetoryQuantity', $product->id) }}">

                    {{-- <input type="hidden" id="unitValue" value="0">
                    <input type="hidden" id="unit" value="0"> --}}
                    {{-- <input type="hidden" class="temp_id" value="0"> --}}
                    Current Stock: {{ $temp->stock->raw->totalBatchQuantity() }}</strong>

                </fieldset>
            </div>
            {{-- Mandetory Section End  --}}

            {{-- Optional Section start  --}}
            @if (count($temp->items))
                <div class="form-group">
                    <fieldset>
                        <legend>Optional</legend>
                        @foreach ($temp->items as $temp_item)
                            {{-- {{dd($temp_item)}} --}}
                            <label for="stock{{ $temp_item->id }}"> <input type="checkbox" class="stock_select"
                                    name="stock_id[]" value="{{ $temp_item->id }}" id="stock{{ $temp_item->id }}"
                                    data-select-id={{ route('admin.selectUnselect', ['product' => $product->id, 'type' => 'select']) }}
                                    data-unselect-id={{ route('admin.selectUnselect', ['product' => $product->id, 'type' => 'unselect']) }}
                                    data-item_id="">
                                {{ $temp_item->stock->raw->name }}
                                {{ $temp_item->stock->raw->unit_value . $temp_item->stock->raw->unit }}

                                @if ($temp_item->stock->raw->mandatory_qty)
                                    <input type="number" name="mandatory_qty[]"
                                        {{ $temp_item->stock->raw->mandatory_qty ? 'readonly' : '' }}
                                        class="selectQty mandatory_qty"
                                        data-url={{ route('admin.changeQty', ['product' => $product->id, 'type' => 'mandatory']) }}
                                        placeholder="quantity">
                                @else
                                    <input type="number" name="optional_qty[]" class="selectQty optional_qty"
                                        placeholder="quantity"
                                        data-url={{ route('admin.changeQty', ['product' => $product->id, 'type' => 'optional']) }}>
                                @endif



                                <input type="hidden" name="unitValue"
                                    value="{{ $temp_item->stock->raw->unit_value }}">
                                <strong class="curentStock">Current Stock:
                                    {{ $temp_item->stock->raw->totalBatchQuantity() }}</strong>
                                    <input type="hidden" class="temp_item_batch_qty" value="{{ $temp_item->stock->raw->totalBatchQuantity() }}">
                            </label>
                        @endforeach
                    </fieldset>

                </div>
            @endif
            {{-- Optional Section End  --}}
        </div>
    </div>
@empty
    <h4 class="text-danger">No Mandetory Packaging fount</h4>
@endforelse
