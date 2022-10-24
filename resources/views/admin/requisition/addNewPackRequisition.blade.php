@extends('admin.layouts.adminMaster')

@section('title')
    Admin Dashboard
@endsection
@push('css')
    <style>
        .searchItem {
            display: none;
        }

    </style>
@endpush

@section('content')
    <section class="content">
        <br>
        @include('alerts.alerts')
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Add Pack Requisitions
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('production.packRequisitionUpdate', ['requisition' => $requisition->id]) }}"
                        method="post">
                        @csrf
                        <input type="hidden" name="req_type" value="pack">
                        <input type="hidden" value="{{ $requisition->id }}" class="requisition_id">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date"
                                value="{{ $requisition->date ? \Carbon\Carbon::parse($requisition->date)->format('Y-m-d') : null }}"
                                name="date">
                        </div>

                        <div class="packAjax pt-3">
                            <div class="row pt-2 batch" id="deletePack">
                                <div class="col-12 col-md-3">
                                    <div class="col-12">
                                        <label for="">Select Pack Material</label>
                                        <select name="pack_material" id="pack_cat_id" class="form-control pack_id"
                                            data-url-two="{{ route('admin.checkRawBatch') }}"
                                            data-url-one="{{ route('production.loadData', ['type' => 'medicine_type']) }}">
                                            <option value="">Select Packaging materials</option>
                                            @foreach ($packCategories as $pack)
                                                <option value="{{ $pack->id }}">{{ $pack->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 showMedicine_type">

                                    </div>
                                    <div class="col-12  searchItem">
                                        <label for="search" id="ss">Search</label>
                                        <input type="text" id="search" name="q" class="form-control search" data-url="{{route('production.loadData',['type'=>'search'])}}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-9 showProducts">

                                </div>

                            </div>


                        </div>
                        <div id="hi"></div>
                        <div class="showSelectedProducts">
                            @if (count($tempPacks))
                                @include(
                                    'production.requisition.ajax.selectedItems'
                                )
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('js')
    <script>
        $(document).on('change', '.pack_id', function() {
            var that = $(this);
            var url = that.attr('data-url-one');
            $('.showMedicine_type').hide();
            $('.searchItem').hide();
            $('.showProducts').hide();
            $.ajax({
                url: url,
                method: "GET",
                success: function(res) {
                    $('.showMedicine_type').show();
                    $('.showMedicine_type').html(res);
                }
            });
        })
        $(document).on('change', '.medicine_type_id', function() {
            var that = $(this);
            var medicine_type = that.val();
            var url = that.attr('data-url');
            var fullUrl = url + "?medicine_type=" + medicine_type
            $.ajax({
                url: fullUrl,
                method: "GET",
                data: {
                    'pack_id': $('#pack_cat_id').val()
                },
                success: function(res) {
                    $('.searchItem').show();
                    $('.showProducts').show();
                    $('.showProducts').html(res);
                }
            });
        })

        $(document).on("change", ".input-select-item", function(e) {
            if (this.checked) {
                var that = $(this);
                var pack_cat_id = $('#pack_cat_id').val();
                var raw_cat_id = $('.medicine_type_id').val();
                var requisition_id = $('.requisition_id').val();
                var url = that.attr("data-select-url");
                var finalUrl = url + "?pack_cat_id=" + pack_cat_id + "&raw_cat_id=" + raw_cat_id
                $.ajax({
                    url: url,
                    type: 'GET',
                    cache: false,
                    dataType: 'json',
                    data: {
                        pack_cat_id: pack_cat_id,
                        raw_cat_id: raw_cat_id,
                        requisition_id: requisition_id
                    },
                    success: function(response) {
                        // $('#hi').html(response.view);
                        $('.showSelectedProducts').html(response.view);
                        //  $('id'+success.product).attr('checked',true);
                    },
                    error: function() {}
                });

            } else {
                var that = $(this);
                var url = that.attr("data-unselect-url");

                // alert(url);

                $.ajax({
                    url: url,
                    type: 'GET',
                    cache: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('.showSelectedProducts').html(response.view);
                        }

                    },
                    error: function() {}
                });

            }
        });
        $(document).on("input change", ".search", function(e) {
            var that = $(this);
            var url = that.attr('data-url');
            var finalUrl = url+"?q="+that.val();
            // alert($("#medicine_type_id").val())
            $.ajax({
                url:finalUrl,
                method:'GET',
                data:{
                    'type':'search',
                    'pack_id': $("#pack_cat_id").val(),
                    'medicine_type': $("#medicine_type_id").val()
                },
                success:function(response) {
                    $('.showProducts').html(response);
                }
            });
            // alert(finalUrl)
            // $.ajax({
            //     url: fullUrl,
            //     method: "GET",
            //     data:{
            //         'type':'search',
            //         'pack_id': $("#pack_cat_id").val(),
            //         'medicine_type': $("#medicine_type_id").val()
            //     }
            //     success: function(response) {
            //         ('.loadItems').html(response);
            //     }
            // });

        });


        $(document).on("change", ".input-select-unselect-temp", function(e) {

            var that = $(this);
            var dataId = that.attr("data-temp-id");

            if (!this.checked) {

                var url = that.attr("data-unselect-url");

                // alert(url);

                $.ajax({
                    url: url,
                    type: 'GET',
                    cache: false,
                    dataType: 'json',
                    data: {
                        'temp_id': dataId
                    },
                    success: function(response) {
                        if (response.success) {
                            $(".showSelectedProducts").empty().append(response.view);
                            $("#id" + dataId).prop("checked", false);
                            if (response.pack_id > 0) {
                                $("#id" + response.pack_id).prop("checked", false);
                            }
                        }

                    },
                    error: function() {}
                });

            }
        });
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $.ajax({
                url: url,
                method: "GET",
                data: {
                    paginate: 'yes',
                    'pack_id': $("#pack_cat_id").val(),
                    'medicine_type': $("#medicine_type_id").val(),
                },
                success: function(response) {
                    $('.showProducts').html(response);
                }
            });
        });
        $(document).on("keyup", ".quantity_update", function(e) {
            var that = $(this);
            var val = that.val();
            var min_qty = 1;

            var url = that.attr("data-url");
            setTimeout(function() {
                $.ajax({
                    url: url,
                    type: 'GET',
                    cache: false,
                    dataType: 'json',
                    data: {
                        quantity: val
                    },
                    success: function(response) {
                        if (response.success) {
                            $('.tempProductShop').html(response.view);

                        }

                    },
                    error: function() {}
                });
            }, 800);

        });
    </script>

    <script>
        $('.rawSubmitBtn').click(function(e) {
            e.preventDefault();
            var url = $(this).attr('data-url');
            $.ajax({
                url: url,
                method: "GET",
                success: function(response) {
                    $(".packAjax").hide();
                    $(".stationeryAjax").hide();
                    $("#rawAjax").append(response);
                }
            });
        });

        $(document).on('click', '.rawRemoveBtn', function(e) {
            e.preventDefault();
            $(this).closest('#deleteRaw').remove();
        })

        $('.packSubmitBtn').click(function(e) {
            e.preventDefault();
            var url = $(this).attr('data-url');
            $.ajax({
                url: url,
                method: "GET",
                success: function(response) {
                    $(".stationeryAjax").hide();
                    $("#rawAjax").hide();
                    $(".packAjax").append(response);
                }
            });
        });

        $(document).on('click', '.packRemoveBtn', function(e) {
            e.preventDefault();
            $(this).closest('#deletePack').remove();
        })

        //Stationery
        $('.stationerySubmitBtn').click(function(e) {
            e.preventDefault();
            var url = $(this).attr('data-url');
            $.ajax({
                url: url,
                method: "GET",
                success: function(response) {
                    $(".packAjax").hide();
                    $("#rawAjax").hide();
                    $(".stationeryAjax").append(response);
                }
            });
        });

        $(document).on('click', '.stationeryRemoveBtn', function(e) {
            e.preventDefault();
            $(this).closest('#deleteStationery').remove();
        })

        $(document).on('change', '.raw_id', function() {
            var that = $(this);
            var raw = that.val();
            // alert(raw)
            var url = that.attr('data-url');
            var fullUrl = url + "?raw=" + raw;
            $.ajax({
                url: fullUrl,
                method: "GET",
                success: function(response) {
                    console.log(response)
                    that.closest('.batch').find('.showBatch').html(response);
                }
            });
        })
    </script>

    <script>
        // increment and decriment
        $(document).ready(function() {

            $(document).on('click', '.minus', function(e) {
                e.preventDefault();
                var that = $(this);
                var qty = parseInt(that.closest('.incrementbtn').find('.quantity_update').val());
                if (qty > 1) {
                    parseInt(that.closest('.incrementbtn').find('.quantity_update').val(qty - 1));
                    that.attr('disabled', false);
                } else {
                    that.attr('disabled', true);
                }
                that.closest('.incrementbtn').find('.quantity_update').trigger("keyup");
            })

            $(document).on('click', '.plus', function(e) {
                e.preventDefault();
                var that = $(this);
                var qty = parseInt(that.closest('.incrementbtn').find('.quantity_update').val());
                parseInt(that.closest('.incrementbtn').find('.quantity_update').val(qty + 1));
                that.closest('.incrementbtn').find('.quantity_update').trigger("keyup");
            })

            (function() {
                $('[data-toggle="tooltip"]').tooltip()
            })

        });
    </script>

@endpush
