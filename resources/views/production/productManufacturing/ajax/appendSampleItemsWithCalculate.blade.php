@push('css')
@endpush
<div  style="border-top: 10px solid gray; padding-bottom:10px; border-redius:30px"></div>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Material</th>
                <th>In Stock</th>
                <th>Req Qty</th>
                <th>Balance</th>
                <th>Status</th>
                @if ($type == 'admin')
                <th>Unit Price</th>
                <th>Total</th>
                @endif

            </tr>
        </thead>
        <tbody>
            <?php
            $total_final_price = 0;
            $total_price = 0;
            ?>
            @foreach ($product->sample->sample_items as $sampleItem)

                {{-- 1 S --}}
                <?php
                $fb_unit = strtolower($sampleItem->raw->firstBatch()->raw->unit);
                ?>
                @if ($fb_unit != $sampleItem->unit)
                    @if ($sampleItem->unit == 'kg')
                        <?php $fb_qty = kTg($sampleItem->unit_value) * $multiply;
                        ?>
                    @elseif ($sampleItem->unit == 'gm')
                        <?php $fb_qty = gTk($sampleItem->unit_value) * $multiply;
                        ?>
                    @elseif ($sampleItem->unit == 'ml')
                        <?php $fb_qty = mTl($sampleItem->unit_value) * $multiply;
                        ?>
                    @elseif ($sampleItem->unit == 'lt')
                        <?php $fb_qty = lTm($sampleItem->unit_value) * $multiply;
                        // $unit = $sampleItem->unit;
                        ?>
                    @endif
                @else
                    <?php $fb_qty = $sampleItem->unit_value * $multiply;
                    // $unit = strtolower($fb->raw->unit);
                    ?>
                @endif

                @if (($fb = $sampleItem->raw->firstBatch()) && $sampleItem->raw->firstBatch()->total_quantity < $fb_qty)

                    <tr class="">
                        <td>{{ $sampleItem->raw ? $sampleItem->raw->name : '' }}({{ $sampleItem->raw ? $sampleItem->raw->unit : '' }})
                        </td>
                        <td>{{ $fb->total_quantity . $fb_unit }}</td>
                        <td>
                            <?php
                            $newQty = $fb->total_quantity - $fb_qty;
                            ?>
                            {{ $fb_qty . $fb_unit }}

                        </td>
                        <td>
                            @if ($newQty <= 0)
                                0
                            @else
                                {{ $newQty }}
                            @endif
                            {{ $fb_unit }}
                        </td>
                        <td>
                            @if ($newQty > 0)
                                <span class="text-success">Access</span>
                            @else
                                <span class="text-warning">Shortage</span>
                            @endif
                        </td>
                        @if ($type == 'admin')
                        <td>
                            {{ $fb->final_price }}
                        </td>
                        <td>{{ $fb->final_price * $fb->total_quantity }}</td>
                        @endif
                        <input type="hidden" name="stock[]" value="{{ $fb->id }}">
                        <input type="hidden" name="price[{{ $fb->id }}]"
                            value="{{ $fb->final_price * $fb->total_quantity }} ">
                        <input type="hidden" name="quantity[{{ $fb->id }}]" value="{{ $fb->total_quantity }}">
                        <?php
                        $total_final_price += $fb->final_price;
                        $total_price += $fb->final_price * $fb->total_quantity;
                        ?>
                    </tr>

                    {{-- Second --}}


                    {{-- 2 I --}}

                    @if (($sb = $sampleItem->raw->secondBatch()) && $sampleItem->raw->secondBatch()->total_quantity < abs($newQty))

                        <?php
                        $sb_unit = strtolower($sampleItem->raw->secondBatch()->raw->unit);
                        ?>
                        <tr class="">
                            <td>
                            </td>
                            <td>{{ $sb->total_quantity }}</td>
                            <td>
                                <?php
                                $secondQty = $sb->total_quantity - abs($newQty);
                                ?>
                                {{ abs($newQty) . $sb_unit }}

                            </td>

                            <td>
                                @if ($secondQty <= 0)
                                    0
                                @else
                                    {{ $secondQty }}
                                @endif
                                {{ $sb_unit }}
                            </td>
                            <td>
                                @if ($secondQty > 0)
                                    <span class="text-success">Access</span>
                                @else
                                    <span class="text-warning">Shortage</span>
                                @endif
                            </td>
                            @if ($type == 'admin')
                            <td>{{ $sb->final_price }}</td>
                            <td>{{ $sb->final_price * $sb->total_quantity }}</td>
                            @endif
                            <input type="hidden" name="stock[]" value="{{ $sb->id }}">
                            <input type="hidden" name="price[{{ $sb->id }}]"
                                value="{{ $sb->final_price * $sb->total_quantity }}">
                            <input type="hidden" name="quantity[{{ $sb->id }}]"
                                value="{{ $sb->total_quantity }}">
                            <?php
                            $total_final_price += $sb->final_price;
                            $total_price += $sb->final_price * $sb->total_quantity;
                            ?>
                        </tr>

                        {{-- 3 I --}}


                        @if (($tb = $sampleItem->raw->thirdBatch()) && $sampleItem->raw->thirdBatch()->total_quantity < abs($secondQty))
                            <?php
                            $tb_unit = strtolower($sampleItem->raw->secondBatch()->raw->unit);
                            ?>
                            <?php
                            $thirdQty = $tb->total_quantity - abs($secondQty);
                            ?>

                            <tr class="{{ $thirdQty < 0 ? 'btn-danger' : '' }}">
                                <td>
                                </td>
                                <td>{{ $tb->total_quantity . $tb_unit }}</td>
                                <td>

                                    {{ abs($secondQty) }}( {{ $tb_unit }})
                                </td>
                                <td>
                                    @if ($thirdQty <= 0)
                                        0
                                    @else
                                        {{ $thirdQty }}
                                    @endif
                                    {{ $tb_unit }}
                                </td>
                                <td>
                                    @if ($thirdQty > 0)
                                        <span class="text-success">Access</span>
                                    @else
                                        <span class="text-warning">Shortage</span>
                                    @endif
                                </td>
                                @if ($type == 'admin')
                                <td>{{ $tb->final_price }}</td>
                                <td>{{ $tb->final_price * $tb->total_quantity }}</td>
                                @endif

                                <input type="hidden" name="stock[]" value="{{ $tb->id }}">
                                <input type="hidden" name="price[{{ $tb->id }}]"
                                    value="{{ $tb->final_price * $tb->total_quantity }}">
                                <input type="hidden" name="quantity[{{ $tb->id }}]"
                                    value="{{ $tb->total_quantity }}">
                                <?php
                                $total_final_price += $tb->final_price;
                                $total_price += $tb->final_price * $tb->total_quantity;
                                ?>
                            </tr>
                            {{-- 3 E --}}
                        @else
                            @if ($tb = $sampleItem->raw->thirdBatch())
                                <?php
                                $status = $tb->total_quantity - abs($secondQty);
                                ?>
                                <tr>
                                    <td>
                                    </td>
                                    <td>{{ $tb->total_quantity }}</td>
                                    <td>
                                        <?php
                                        $unit = strtolower($tb->raw->unit);
                                        ?>

                                        @if ($unit != $sampleItem->unit)
                                            @if ($sampleItem->unit == 'kg')
                                                <?php $qty = kTg($sampleItem->unit_value) * $secondQty;
                                                // $unit = $sampleItem->unit;
                                                ?>
                                            @elseif ($sampleItem->unit == 'gm')
                                                <?php $qty = gTk($sampleItem->unit_value) * $secondQty;
                                                // $unit = $sampleItem->unit;
                                                ?>
                                            @elseif ($sampleItem->unit == 'ml')
                                                <?php $qty = mTl($sampleItem->unit_value) * $secondQty;
                                                // $unit = $sampleItem->unit;
                                                ?>
                                            @elseif ($sampleItem->unit == 'lt')
                                                <?php $qty = lTm($sampleItem->unit_value) * $secondQty;
                                                // $unit = $sampleItem->unit;
                                                ?>
                                            @endif
                                        @else
                                            <?php $qty = $sampleItem->unit_value * $secondQty;
                                            // $unit = strtolower($fb->raw->unit);
                                            ?>
                                        @endif
                                        {{ abs($secondQty) }} {{ $unit }}
                                    </td>
                                    <td>

                                        @if ($status > 0)
                                            <span>{{ $status }}</span>
                                        @else
                                            <span>0</span>
                                        @endif

                                        {{ $unit }}
                                    </td>
                                    <td>
                                        @if ($status > 0)
                                            <span class="text-success">Access</span>
                                        @else
                                            <span class="text-warning">Shortage</span>
                                        @endif
                                    </td>

                                    @if ($type == 'admin')
                                    <td>{{ $tb->final_price }}</td>
                                    <td>{{ $tb->final_price * $tb->total_quantity }}</td>
                                    @endif

                                    <input type="hidden" name="stock[]" value="{{ $tb->id }}">
                                    <input type="hidden" name="price[{{ $tb->id }}]"
                                        value="{{ $tb->final_price * $tb->total_quantity }}">
                                    <input type="hidden" name="quantity[{{ $tb->id }}]"
                                        value="{{ $tb->total_quantity }}">
                                    <?php
                                    $total_final_price += $tb->final_price;
                                    $total_price += $tb->final_price * $tb->total_quantity;
                                    ?>
                                </tr>
                            @endif
                        @endif

                        {{-- 2 E --}}
                    @else
                        @if ($sb = $sampleItem->raw->secondBatch())
                            <?php
                            $status = $sb->total_quantity - abs($newQty);
                            ?>
                            <tr>
                                <td>
                                    {{-- {{ $sampleItem->raw ? $sampleItem->raw->name : '' }}({{ $sampleItem->raw ? $sampleItem->raw->unit : '' }}) --}}
                                </td>
                                <td>{{ $sb->total_quantity }} {{ $sampleItem->raw->unit }}</td>
                                <td>
                                    <?php
                                    $unit = strtolower($sb->raw->unit);
                                    ?>

                                    @if ($unit != $sampleItem->unit)
                                        @if ($sampleItem->unit == 'kg')
                                            <?php $qty = kTg($sampleItem->unit_value) * $newQty;

                                            ?>
                                        @elseif ($sampleItem->unit == 'gm')
                                            <?php $qty = gTk($sampleItem->unit_value) * $newQty;
                                            ?>
                                        @elseif ($sampleItem->unit == 'ml')
                                            <?php $qty = mTl($sampleItem->unit_value) * $newQty;

                                            ?>
                                        @elseif ($sampleItem->unit == 'lt')
                                            <?php $qty = lTm($sampleItem->unit_value) * $newQty;

                                            ?>
                                        @endif
                                    @else
                                        <?php $qty = $sampleItem->unit_value * $newQty;
                                        ?>
                                    @endif
                                    {{-- {{$unit}} --}}
                                    {{-- {{ $qty . $unit }} --}}
                                    {{-- {{ abs($newQty) }} --}}
                                    {{ abs($newQty) }} {{ $unit }}
                                </td>
                                <td>

                                    @if ($status > 0)
                                        <span>{{ $status }}</span>
                                    @else
                                        <span>0</span>
                                    @endif

                                    {{ $unit }}
                                </td>
                                <td>
                                    @if ($status > 0)
                                        <span class="text-success">Access</span>
                                    @else
                                        <span class="text-warning">Shortage</span>
                                    @endif
                                </td>

                                @if ($type == 'admin')
                                <td>{{ $sb->final_price }}</td>
                                <td>{{ $sb->final_price * $sb->total_quantity }}</td>
                                @endif

                                <input type="hidden" name="stock[]" value="{{ $sb->id }}">
                                <input type="hidden" name="price[{{ $sb->id }}]"
                                    value="{{ $sb->final_price * $sb->total_quantity }}">
                                <input type="hidden" name="quantity[{{ $sb->id }}]"
                                    value="{{ $sb->total_quantity }}">
                                <?php
                                $total_final_price += $sb->final_price;
                                $total_price += $sb->final_price * $sb->total_quantity;
                                ?>
                            </tr>
                        @endif
                    @endif



                    {{-- 1 E --}}
                @else
                    @if ($fb = $sampleItem->raw->firstBatch())
                        <tr>
                            <td>{{ $sampleItem->raw ? $sampleItem->raw->name : '' }}({{ $sampleItem->raw ? $sampleItem->raw->unit : '' }})
                            </td>
                            <td>{{ $fb->total_quantity }} {{ $fb->raw->unit }}</td>
                            <td>
                                <?php
                                $unit = strtolower($fb->raw->unit);
                                ?>

                                @if ($unit != $sampleItem->unit)
                                    @if ($sampleItem->unit == 'kg')
                                        <?php $qty = kTg($sampleItem->unit_value) * $multiply;
                                        ?>
                                    @elseif ($sampleItem->unit == 'gm')
                                        <?php $qty = gTk($sampleItem->unit_value) * $multiply;
                                        ?>
                                    @elseif ($sampleItem->unit == 'ml')
                                        <?php $qty = mTl($sampleItem->unit_value) * $multiply;
                                        ?>
                                    @elseif ($sampleItem->unit == 'lt')
                                        <?php $qty = lTm($sampleItem->unit_value) * $multiply;
                                        ?>
                                    @endif
                                @else
                                    <?php $qty = $sampleItem->unit_value * $multiply;
                                    ?>
                                @endif
                                {{ $qty }} {{ $unit }}
                            </td>
                            <td> {{ $status = $fb->total_quantity - $qty }} {{ $unit }}</td>
                            <td>
                                @if ($status > 0)
                                    <span class="text-success">Access</span>
                                @else
                                    <span class="text-warning">Shortage</span>
                                @endif
                            </td>

                            @if ($type == 'admin')
                            <td>
                                {{ $fb->final_price }}
                            </td>
                            <td>{{ $fb->final_price * $qty }}</td>
                            @endif

                            <input type="hidden" name="stock[]" value="{{ $fb->id }}">
                            <input type="hidden" name="price[{{ $fb->id }}]"
                                value="{{ $fb->final_price * $qty }}">
                            <input type="hidden" name="quantity[{{ $fb->id }}]" value="{{ $qty }}">
                            <?php
                            $total_final_price += $fb->final_price;
                            $total_price += $fb->final_price * $qty;
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
                @if ($type == 'admin')
                <th>Total Unit Price</th>
                <th>Total Price</th>
                @endif
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <input type="text" name="name" style="width: 150px;" value="{{ $product->sample->name }}">

                </td>
                <td>
                    @if (isset($sample_unti))
                        {{ $sample_unti }}
                        <input type="hidden" name="unit" value="{{ $sample_unti }}">
                    @else
                        {{ $product->sample->unit }}
                    @endif
                </td>
                <td>
                    @if ($product->sample->unit != $sample_unti)
                        @if ($product->sample->unit == 'kg' && $sample_unti == 'gm')
                            {{ $final_unit_value = kTg($product->sample->unit_value) * $multiply }}
                        @endif
                        @if ($product->sample->unit == 'gm' && $sample_unti == 'kg')
                            {{ $final_unit_value = gTk($product->sample->unit_value) * $multiply }}
                        @endif

                        @if ($product->sample->unit == 'ltr' && $sample_unti == 'ml')
                            {{ $final_unit_value = mTl($product->sample->unit_value) * $multiply }}
                        @endif
                        @if ($product->sample->unit == 'ml' && $sample_unti == 'ltr')
                            {{ $final_unit_value = lTm($product->sample->unit_value) * $multiply }}
                        @endif
                    @else
                        {{ $final_unit_value = $product->sample->unit_value * $multiply }}
                    @endif
                    <input type="hidden" name="unit_value" value="{{ $final_unit_value }}">
                </td>
                @if ($type == 'admin')
                <td>
                    {{ $total_final_price }}
                    <input type="hidden" name="unit_price" value="{{ $total_final_price }}">
                </td>
                <td>
                    {{ $total_price }}
                    <input type="hidden" name="total_price" value="{{ $total_price }}">
                </td>
                @endif
            </tr>
            {{-- <tr>
                <td>
                    <input type="text" style="width: 150px;" name="sample_name" value="{{ $product->sample->name }}">
                </td>
                <td>
                    <input type="hidden" name="sample_unit" value="{{ $product->sample->unit }}">
                </td>
                <td>
                    <input type="hidden" name="sample_unit_value" value="{{ $final_unit_value }}">
                </td>
                <td>
                    <input type="hidden" name="sample_unit_price" value="{{ $total_final_price }}">
                </td>
                <td>
                    <input type="hidden" name="sample_total_price" value="{{ $total_price }}">
                </td>

            </tr> --}}
        </tbody>
    </table>
</div>
