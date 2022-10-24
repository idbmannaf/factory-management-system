@push('css')
@endpush
<div class="table-responsive">
    <table class="table table-bordered" style="white-space: nowrap">
        <thead>
            <tr>
                <th>Material</th>
                <th>In Stock</th>
                <th>Req Qty</th>
                <th>Unit Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total_final_price = 0;
            $total_price = 0;
            ?>
            @foreach ($product->sample->sample_items as $sampleItem)

                {{-- 1 I --}}
                @if (($fb = $sampleItem->raw->firstBatch()) && $sampleItem->raw->firstBatch()->total_quantity < $multiply)
                    <tr class="bg-danger">
                        <td>{{ $sampleItem->raw ? $sampleItem->raw->name : '' }}({{ $sampleItem->raw ? $sampleItem->raw->type : '' }})
                        </td>
                        <td>{{ $fb->total_quantity }}</td>
                        <td>
                            <?php
                            $newQty = $multiply - $fb->total_quantity;
                            ?>
                            {{ $fb->total_quantity }}( {{ $multiply }})
                        </td>
                        <td>{{ $fb->final_price }}</td>
                        <td>{{ $fb->final_price * $fb->total_quantity }}</td>

                        <input type="hidden" name="stock[]" value="{{ $fb->id }}">
                        <input type="hidden" name="quantity[]" value="{{ $fb->total_quantity }}">
                        <?php
                        $total_final_price += $fb->final_price;
                        $total_price += $fb->final_price * $fb->total_quantity;
                        ?>
                    </tr>

                    {{-- 2 I --}}
                    @if (($sb = $sampleItem->raw->secondBatch()) && $sampleItem->raw->secondBatch()->total_quantity < $newQty)
                        <tr class="bg-danger">
                            <td>{{ $sampleItem->raw ? $sampleItem->raw->name : '' }}({{ $sampleItem->raw ? $sampleItem->raw->type : '' }})
                            </td>
                            <td>{{ $sb->total_quantity }}</td>
                            <td>
                                <?php
                                $secondQty = $newQty - $sb->total_quantity;
                                ?>
                                {{ $sb->total_quantity }}( {{ $multiply }})
                            </td>
                            <td>{{ $sb->final_price }}</td>
                            <td>{{ $sb->final_price * $sb->total_quantity }}</td>

                            <input type="hidden" name="stock[]" value="{{ $sb->id }}">
                            <input type="hidden" name="quantity[]" value="{{ $sb->total_quantity }}">
                            <?php
                            $total_final_price += $sb->final_price;
                            $total_price += $sb->final_price * $sb->total_quantity;
                            ?>
                        </tr>

                        {{-- 3 I --}}
                        @if (($tb = $sampleItem->raw->thirdBatch()) && $sampleItem->raw->thirdBatch()->total_quantity < $secondQty)
                            <tr class="bg-danger">
                                <td>{{ $sampleItem->raw ? $sampleItem->raw->name : '' }}({{ $sampleItem->raw ? $sampleItem->raw->type : '' }})
                                </td>
                                <td>{{ $tb->total_quantity }}</td>
                                <td>
                                    <?php
                                    $secondQty = $newQty - $tb->total_quantity;
                                    ?>
                                    {{ $tb->total_quantity }}( {{ $multiply }})
                                </td>
                                <td>{{ $tb->final_price }}</td>
                                <td>{{ $tb->final_price * $tb->total_quantity }}</td>
                                <input type="hidden" name="stock[]" value="{{ $tb->id }}">
                                <input type="hidden" name="quantity[]" value="{{ $tb->total_quantity }}">
                                <?php
                                $total_final_price += $tb->final_price;
                                $total_price += $tb->final_price * $tb->total_quantity;
                                ?>
                            </tr>
                            {{-- 3 E --}}
                        @else
                            @if ($tb = $sampleItem->raw->thirdBatch())
                                <tr>
                                    <td>{{ $sampleItem->raw ? $sampleItem->raw->name : '' }}({{ $sampleItem->raw ? $sampleItem->raw->type : '' }})
                                    </td>
                                    <td>{{ $tb->total_quantity }}</td>
                                    <td>

                                        {{ $multiply }}
                                    </td>
                                    <td>{{ $tb->final_price }}</td>
                                    <td>{{ $tb->final_price * $secondQty }}</td>
                                    <input type="hidden" name="stock[]" value="{{ $tb->id }}">
                                    <input type="hidden" name="quantity[]" value="{{ $secondQty }}">
                                    <?php
                                    $total_final_price += $tb->final_price;
                                    $total_price += $tb->final_price * $secondQty;
                                    ?>
                                </tr>
                            @endif
                        @endif

                        {{-- 2 E --}}
                    @else
                        @if ($sb = $sampleItem->raw->secondBatch())
                            <tr>
                                <td>{{ $sampleItem->raw ? $sampleItem->raw->name : '' }}({{ $sampleItem->raw ? $sampleItem->raw->type : '' }})
                                </td>
                                <td>{{ $sb->total_quantity }}</td>
                                <td>
                                    {{ $multiply }}
                                </td>
                                <td>{{ $sb->final_price }}</td>
                                <td>{{ $sb->final_price * $newQty }}</td>

                                <input type="hidden" name="stock[]" value="{{ $sb->id }}">
                                <input type="hidden" name="quantity[]" value="{{ $newQty }}">
                                <?php
                                $total_final_price += $sb->final_price;
                                $total_price += $sb->final_price * $newQty;
                                ?>
                            </tr>
                        @endif
                    @endif



                    {{-- 1 E --}}
                @else
                    @if ($fb = $sampleItem->raw->firstBatch())
                        <tr>
                            <td>{{ $sampleItem->raw ? $sampleItem->raw->name : '' }}({{ $sampleItem->raw ? $sampleItem->raw->type : '' }})
                            </td>
                            <td>{{ $fb->total_quantity }}</td>
                            <td>
                                {{ $multiply }}
                            </td>
                            <td>{{ $fb->final_price }}</td>
                            <td>{{ $fb->final_price * $multiply }}</td>
                            <input type="hidden" name="stock[]" value="{{ $fb->id }}">
                            <input type="hidden" name="quantity[]" value="{{ $multiply }}">
                            <?php
                            $total_final_price += $fb->final_price;
                            $total_price += $fb->final_price * $multiply;
                            ?>
                        </tr>
                    @endif

                @endif

            @endforeach
        </tbody>
        <tfoot>

        </tfoot>
    </table>
    <table class="table table-hovered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Unit</th>
                <th>Unit Value</th>
                <th>Total Unit Price</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $product->sample->name }}</td>
                <td>{{ $product->sample->unit }} </td>
                <td>{{ $product->sample->unit_value }} </td>
                <td>
                    {{ $total_final_price }}
                    <input type="hidden" name="sample_unit_price" value="{{ $total_final_price }}">
                </td>
                <td>
                    {{ $total_price }}
                    <input type="hidden" name="sample_total_price" value="{{ $total_price }}">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" style="width: 150px;" name="name" value="{{ $product->sample->name }}">
                </td>
                <td>
                    <input type="text" name="unit" value="{{ $product->sample->unit }}">
                </td>
                <td>
                    <input type="text" name="unit_value" value="{{ $product->sample->unit_value }}">
                </td>
                <td>
                    <input type="number" name="unit_price" value="{{ round($total_final_price, 2) }}">
                </td>
                <td>
                    <input type="number" name="total_price" value="{{ $total_price }}">
                </td>

            </tr>
        </tbody>
    </table>
</div>
