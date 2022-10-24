@extends('admin.layouts.adminMaster')

@section('title')
    Admin Dashboard - Prduct Manufacturing
@endsection
@push('css')
@endpush

@section('content')
    <section class="content">
        <br>
        @include('alerts.alerts')
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4>View Product Manufacturing - {{ $product->name }} </h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                            <p><b>Product Name: </b>{{ $product->name }}</p>
                            <p><b>Product Unit: </b>{{ $product->unit }}</p>
                            <p><b>Product Unit Value: </b> {{ $product->unit_value }}
                                <input type="hidden" id="ProductUnitValue" value="{{ $product->unit_value }}">
                            </p>
                            <p><b>Product Total Unit Price: </b>{{ $product->unit_price }}</p>
                            <p><b>Product Total Price: </b>{{ $product->total_price }}</p>
                            <p><b>packaging_unit_value: </b>{{ $product->packaging_unit_value }}</p>
                            <p><b>Status: </b>

                                @if ($product->status == 'in_stoked')
                                    <span class="badge badge-success">In Stoked</span>
                                @else
                                    <span class="badge badge-success">{{ $after_proccess_product->status }}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <h4><b>Raw Materials</b></h4>
                    @include(
                        'admin.productManufacturing.ajax.rawProductMaterials'
                    )
                    @if ($after_proccess_product->status == 'packaging')
                        <h4><b>Packaging</b></h4>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        {{-- <th>Unit</th>
                                        <th>Type</th> --}}
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Total Price</th>
                                        {{-- <th>Mandotory</th> --}}
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($after_proccess_product->afterProccessProductMaterials as $product_material)
                                        <tr>
                                            <td>{{ $product_material->id }}</td>
                                            <td>{{ $product_material->raw->name }}
                                                ({{ $product_material->raw->unit_value . $product_material->raw->unit }})
                                            </td>

                                            {{-- <td>{{ $product_material->unit }}</td>
                                            <td>{{ $product_material->type }}</td> --}}
                                            <td>{{ $product_material->quantity }}</td>
                                            <td>{{ $product_material->unit_price }}</td>
                                            <td>{{ $product_material->total_price }}</td>
                                            {{-- <td>
                                                @if ($product_material->raw->mandatory)
                                                    <span class="text-info">Yes</span>
                                                @else
                                                    <span class="text-danger">No</span>
                                                @endif
                                            </td> --}}
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                        <form
                            action="{{ route('admin.updateProductManufacturing', ['product' => $product, 'status' => 'in_stocked']) }}"
                            method="POST">
                            @csrf
                            <input type="hidden" name="afterProssessingId" value="{{$after_proccess_product->id}}">
                            <button type='submit' class="btn btn-success">Stocked</button>
                        </form>
                    @endif


                </div>
            </div>
        </div>
    </section>
@endsection


@push('js')
    <script>
        $(document).on('click', '.stock_select', function() {
            var that = $(this);
            if (that.is(":checked")) {
                var selectedQty = that.closest('label').find('.selectQty').val();
                that.closest('label').find('.selectQty').attr('required', true)
            } else {
                that.closest('label').find('.selectQty').attr('required', false)
            }
        });


        $(document).on('change', '#stock_id', function() {
            var that = $(this);
            if (that.val() > 0) {
                var v = that.closest('.form-group').find('.qty').attr('required', true);
                url = that.attr('data-url');
                finalUrl = url + "?stock=" + that.val();
                $.ajax({
                    url: finalUrl,
                    method: "GET",
                    success: function(response) {
                        Number(that.closest('.form-group').find('#unitValue').val(response));
                        var unitValue = Number(that.closest('.form-group').find('.mandotoryQty').val());
                        if (unitValue < 0) {
                            $('.packBtn').attr('disabled', true);
                        } else {
                            $('.packBtn').attr('disabled', false);
                        }
                    }
                })

            } else {
                var v = that.closest('.form-group').find('.qty').attr('required', false);
                Number(that.closest('.form-group').find('#unitValue').val(0));
                $('.packBtn').attr('disabled', true);
            }
        })


        $(document).on('input', '.mandotoryQty', function() {
            var that = $(this);
            var qty = that.val();
            var stock_id = Number(that.closest('.form-group').find('#stock_id').val());
            var product_unit = Number($('#ProductUnitValue').val())
            var unitValue = Number(that.closest('.form-group').find('#unitValue').val());

            if (unitValue <= 0) {
                $('.packBtn').attr('disabled', true);
            } else {
                $('.packBtn').attr('disabled', false);
            }
            if (unitValue * qty > product_unit) {
                $('.msg').text('Unit Value more than product unit value');
                $('.packBtn').attr('disabled', true);
            } else {
                $('.msg').text('');
                $('.packBtn').attr('disabled', false);
            }

            // if (that.val() <= 0) {
            //     $('.packBtn').attr('disabled', true);
            // } else {
            //     $('.packBtn').attr('disabled', false);
            // }

        })
    </script>
    <script>
        $(document).on('change', '#pack_cat', function() {
            var url = $(this).attr('data-url');
            $.ajax({
                url: url,
                method: "GET",
                data: {
                    pack_id: $(this).val()
                },
                success: function(response) {
                    $('#medicineShow').html(response);
                }
            })

        });
        $(document).on('change', '#medicine_type', function() {
            var url = $(this).attr('data-url');
            $.ajax({
                url: url,
                method: "GET",
                data: {
                    dhpl_cat_id: $(this).val(),
                    pack_cat_id: $('#pack_cat').val()
                },
                success: function(response) {
                    $('#showMandetory').html(response.mandetory);
                    $('#showOptional').html(response.optional);
                }
            })

        })
    </script>
    <script>
        $('#addPack').click(function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            var pack_id = $('#addPack').attr("data-prev-id")
            $.ajax({
                url: url,
                method: "GET",
                data: {
                    pack_id: pack_id
                },
                success: function(response) {
                    $('.showPack').append(response);
                }
            })

        })
    </script>
    <script>
        $(document).on('change', '.pack_id', function() {
            var that = $(this);
            var url = that.attr('data-url');
            var pack_id = that.val();
            var quantity = that.closest('#deletePack').find('.qty').val();
            $.ajax({
                url: url,
                method: "GET",
                data: {
                    url: url,
                    pack_id: pack_id,
                    quantity: quantity
                },
                success: function(res) {
                    $('#addPack').attr("data-prev-id", res.pack_id)
                    that.closest('#deletePack').find('.appendMaterials').html(res.html);
                }
            });
        })

        $(document).on('change keyup', '.qty', function() {
            var that = $(this);
            var quantity = that.val();
            var url = that.closest('#deletePack').find('.pack_id').attr('data-url');
            var pack_id = that.closest('#deletePack').find('.pack_id').val();
            $.ajax({
                url: url,
                method: "GET",
                data: {
                    url: url,
                    pack_id: pack_id,
                    quantity: quantity
                },
                success: function(res) {
                    $('#addPack').attr("data-prev-id", res.pack_id)
                    that.closest('#deletePack').find('.appendMaterials').html(res.html);
                }
            });
        })
    </script>
    <script>
        $(document).on('click', '.packRemoveBtn', function(e) {
            $(this).closest('#deletePack').remove();
            $('#addPack').attr("data-prev-id", '')
        })
    </script>
@endpush
