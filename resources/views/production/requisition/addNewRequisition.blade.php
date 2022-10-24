@extends('production.layouts.productionMaster')

@section('title')
    Production Dashboard
@endsection
@push('css')
@endpush

@section('content')
    <section class="content">
        <br>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Add Requisitions
                    </div>
                </div>
                <div class="card-body">
                    <form
                        action="{{route('production.updateRequisition',['requisition'=>$requisition->id,'type'=>'store'])}}"
                        method="post">
                        @csrf
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date"
                                   value="{{$requisition->date ? \Carbon\Carbon::parse($requisition->date)->format('Y-m-d') :null}}"
                                   name="date">
                        </div>
                        <div id="rawAjax">
                            <label for=""><b>Raw Materials</b>
                                <button class="btn btn-info btn-sm rawSubmitBtn" type="button"
                                        data-url="{{route('production.materialsAjax',['type'=>'raw'])}}"><i
                                        class="fas fa-plus"></i></button>
                            </label>

                        </div>
                        <div class="packAjax pt-3">
                            <label for=""><b>Packaging Materials </b>
                                <button class="btn btn-info btn-sm packSubmitBtn" type="button"
                                        data-url="{{route('production.materialsAjax',['type'=>'Pack'])}}"><i
                                        class="fas fa-plus"></i></button>
                            </label>
                        </div>
                        <div class="stationeryAjax pt-3">
                            <label for=""><b>Stationery Materials </b>
                                <button class="btn btn-info btn-sm stationerySubmitBtn" type="button"
                                        data-url="{{route('production.materialsAjax',['type'=>'stationery'])}}"><i
                                        class="fas fa-plus"></i></button>
                            </label>
                        </div>

                        <div class="form-group mt-3">
                            <input type="submit" class="btn btn-info">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('js')
    <script>
        $('.rawSubmitBtn').click(function (e) {
            e.preventDefault();
            var url = $(this).attr('data-url');
            $.ajax({
                url: url,
                method: "GET",
                success: function (response) {
                    $(".packAjax").hide();
                    $(".stationeryAjax").hide();
                    $("#rawAjax").append(response);
                }
            });
        });

        $(document).on('click', '.rawRemoveBtn', function (e) {
            e.preventDefault();
            $(this).closest('#deleteRaw').remove();
        })

        $('.packSubmitBtn').click(function (e) {
            e.preventDefault();
            var url = $(this).attr('data-url');
            $.ajax({
                url: url,
                method: "GET",
                success: function (response) {
                    $(".stationeryAjax").hide();
                    $("#rawAjax").hide();
                    $(".packAjax").append(response);
                }
            });
        });

        $(document).on('click', '.packRemoveBtn', function (e) {
            e.preventDefault();
            $(this).closest('#deletePack').remove();
        })

        //Stationery
        $('.stationerySubmitBtn').click(function (e) {
            e.preventDefault();
            var url = $(this).attr('data-url');
            $.ajax({
                url: url,
                method: "GET",
                success: function (response) {
                    $(".packAjax").hide();
                    $("#rawAjax").hide();
                    $(".stationeryAjax").append(response);
                }
            });
        });

        $(document).on('click', '.stationeryRemoveBtn', function (e) {
            e.preventDefault();
            $(this).closest('#deleteStationery').remove();
        })

        $(document).on('change', '.raw_id', function () {
            var that = $(this);
            var raw = that.val();
            // alert(raw)
            var url = that.attr('data-url');
            var fullUrl = url + "?raw=" + raw;
            $.ajax({
                url: fullUrl,
                method: "GET",
                success: function (response) {
                    console.log(response)
                    that.closest('.batch').find('.showBatch').html(response);
                }
            });
        })

    </script>

@endpush

