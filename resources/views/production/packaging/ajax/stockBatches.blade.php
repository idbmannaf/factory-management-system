<div class="col-12">
    <div class="row">
        <div class="table-responsive">
            <table class="table table-responsive">
                <tr>
                    <th>Material</th>
                    <th>In Stock</th>
                    <th>Req Qty</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                </tr>
                {{-- 1 I --}}
                <?php
                    $total_unit_price = 0;
                    $total_price = 0;
                    ?>
                @if (($fb=$pack->firstBatch()) && ($pack->firstBatch()->total_quantity < $qty))
                    <tr class="bg-danger">
                        <td>{{$pack->name}}({{$pack->type}})
                        </td>
                        <td>{{$fb->total_quantity}}</td>
                        <td>
                            <?php
                            $newQty= $qty - $fb->total_quantity;
                                ?>
                            {{$fb->total_quantity }}( {{$qty}})
                        </td>
                        <td>{{$fb->unit_price}}</td>
                        <td>{{$fb->unit_price * $fb->total_quantity}}</td>

                        <input type="hidden" name="stock[{{$pack->id}}][]" value="{{$fb->id}}">
                        <input type="hidden" name="quantity[{{$pack->id}}][]" value="{{$fb->total_quantity}}">
                        <?php
                                $total_unit_price += $fb->unit_price;
                                $total_price += $fb->unit_price * $fb->total_quantity;
                                ?>
                    </tr>
                    {{-- 2 I --}}
                @if (($sb =$pack->secondBatch()) && ($pack->secondBatch()->total_quantity < $newQty)) <tr class="bg-danger">
                <tr class="bg-danger">
                    <td>{{$pack->name}}({{$pack->type}}) </td>
                <td>{{$sb ->total_quantity}}</td>
                <td>
                    <?php
                $secondQty= $newQty - $sb->total_quantity;
                    ?>
                    {{$sb ->total_quantity }}( {{$qty}})
                </td>
                <td>{{$sb ->unit_price}}</td>
                <td>{{$sb ->unit_price * $sb->total_quantity}}</td>

                <input type="hidden" name="stock[{{$pack->id}}][]" value="{{$sb ->id}}">
                <input type="hidden" name="quantity[{{$pack->id}}][]" value="{{$sb ->total_quantity}}">
                <?php
                    $total_unit_price += $sb->unit_price;
                    $total_price += $sb ->unit_price * $sb ->total_quantity;
                    ?>
                </tr>


                    {{-- 3 I --}}
                    @if (($tb= $pack->thirdBatch()) && ($pack->thirdBatch()->total_quantity <
                    $secondQty))
                    <tr class="bg-danger">
                    <td>{{$pack->name}}({{$pack->type}})
                    </td>
                    <td>{{$tb->total_quantity}}</td>
                    <td>
                        <?php
                    $thirdQty= $secondQty - $tb->total_quantity;
                    ?>
                        {{$tb->total_quantity }}( {{$qty}})
                    </td>
                    <td>{{$tb->unit_price}}</td>
                    <td>{{$tb->unit_price * $tb->total_quantity}}</td>
                    <input type="hidden" name="stock[{{$pack->id}}][]" value="{{$tb->id}}">
                    <input type="hidden" name="quantity[{{$pack->id}}][]" value="{{$tb->total_quantity}}">
                    <?php
                    $total_unit_price += $tb->unit_price;
                    $total_price += $tb->unit_price * $tb->total_quantity;
                    ?>
                    </tr>
                    {{-- 3 E --}}
                    @else
                    @if ($tb= $pack->thirdBatch())
                    <tr>
                        <td>{{$pack->name}}({{$pack->type}})
                        </td>
                        <td>{{$tb->total_quantity}}</td>
                        <td>
                           {{$qty - ($pack->secondBatch()->total_quantity + $pack->firstBatch()->total_quantity)}}({{$qty}})

                        </td>
                        <td>{{$tb->unit_price}}</td>
                        <td>{{$tb->unit_price * $secondQty}}</td>
                        <input type="hidden" name="stock[{{$pack->id}}][]" value="{{$tb->id}}">
                        <input type="hidden" name="quantity[{{$pack->id}}][]" value="{{$secondQty}}">
                        <?php
                    $total_unit_price += $tb->unit_price;
                    $total_price += $tb->unit_price * $secondQty;
                    ?>
                    </tr>
                    @endif

                    @endif

                 {{-- 2 E --}}
                 @else
                 @if ($sb=$pack->secondBatch())
                 <tr>
                     <td>{{$pack->name}}({{$pack->type}})
                     </td>
                     <td>{{$sb->total_quantity}}</td>
                     <td>
                        {{$qty - $pack->firstBatch()->total_quantity}}({{$qty}})
                     </td>
                     <td>{{$sb->unit_price}}</td>
                     <td>{{$sb->unit_price * $newQty}}</td>

                     <input type="hidden" name="stock[{{$pack->id}}][]" value="{{$sb->id}}">
                     <input type="hidden" name="quantity[{{$pack->id}}][]" value="{{$newQty}}">
                     <?php
                 $total_unit_price += $sb->unit_price;
                 $total_price += $sb->unit_price * $newQty;
                 ?>
                 </tr>
                 @endif

                 @endif

                    {{-- 1 E --}}
                    @else
                        @if ($fb=$pack->firstBatch())
                            <tr>
                                <td>{{$pack->name}}({{$pack->type}})</td>
                                <td>{{$fb->total_quantity}}</td>
                                <td>
                                    {{$qty}}({{$qty}})
                                </td>
                                <td>{{$fb->unit_price}}</td>
                                <td>{{$fb->unit_price * $qty}}</td>
                                <input type="hidden" name="stock[{{$pack->id}}][]" value="{{$fb->id}}">
                                <input type="hidden" name="quantity[{{$pack->id}}][]" value="{{$qty}}">
                                <?php
                                $total_unit_price += $fb->unit_price;
                                $total_price += $fb->unit_price * $qty;
                                ?>
                            </tr>
                        @endif
                    @endif

            </table>
        </div>
    </div>
</div>
