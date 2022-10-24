@extends('admin.layouts.adminMaster')

@section('title')
Admin Dashboard
@endsection
@push('css')
<link rel="stylesheet" href="{{asset('cp/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('cp/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

@endpush

@section('content')
<section class="content">
    <br>
    @include('alerts.alerts')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Create Samples
                </div>
            </div>
            <form action="{{route('admin.storeSample')}}" method="post">
                @csrf
                <div class="card-body sampleValue" data="1" style="background-color: #e5e5e5;">
                    <div class="row closeDiv">
                        <div class="col-12 col-md-4 raw_id">
                            <select name="raw_id[]" id="raw_id" data-unit-check-url="{{route('admin.checkRawUnit',['type'=>'raw'])}}" class="form-control raw" data-url="{{route('admin.checkRawBatch')}}" required>
                                <option value="">Select Raw</option>
                                @foreach($raws as $raw)
                                <option data-id="{{$raw->id}}" value="{{$raw->id}}">
                                    {{$raw->name}}({{$raw->unit}})
                                </option>
                                @endforeach
                            </select>
                            <span class="text-danger rawError" style="display: none">First Select Raw material</span>
                        </div>
                        <div class="col-12 col-md-2 showUnit">

                        </div>

                        <div class="col-12 col-md-4">
                            <input type="number" step="any" min="0" name="unit_item_value[]" class="form-control unitItemValue" placeholder="Unit Value" required>
                            <span class="text-danger unitValueError" style="display: none">First input Unit Value</span>
                        </div>


                        <div class="col-12 col-md-2">
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-success addBtn"
                                    data-url="{{route('admin.createSamplesAjax')}}"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <label for="">Select Sample Name</label>
                            <select id="user" name="dhpl_product_id"
                                    class="form-control user-select select2-container step2-select select2 dhpl_product_id"
                                    data-unit-check-url="{{route('admin.checkRawUnit',['type'=>'product'])}}"
                                    data-placeholder="Product"
                                    data-ajax-url="{{ route('selectNewProduct') }}"
                                    data-ajax-cache="true"
                                    data-ajax-dataType="json"
                                    data-ajax-delay="200"
                                    style="">
                                </select>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="">Sample Unit Value</label>
                            <input type="text" name="unit_value" placeholder="Unit Value" class="form-control" required>
                        </div>
                        <div class="col-12 col-md-4 show_sample_unit">

                        </div>
                        <div class="col-12 my-2">
                            <label for="active"><input type="checkbox" name="active" id="active"> Active</label>

                        </div>
                        <div class="col-12">
                            <label for="">Procedure/Instruction</label>
                            <textarea name="details" id="" cols="30" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="col-12 text-right mt-2">
                            <input class="btn btn-info" type="submit" value="Submit">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection


@push('js')
<script src="{{asset('cp/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('js/sample.js')}}"></script>

<script>

</script>
@endpush
