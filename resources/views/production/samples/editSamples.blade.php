@extends('production.layouts.productionMaster')

@section('title')
    Production Dashboard
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
                        Edit Samples
                    </div>
                </div>
                <form action="{{ route('admin.updateSample', $sample) }}" method="post">
                    @csrf
                    <div class="card-body sampleValue" style="background-color: #e5e5e5;">
                        <div class="col-12 py-3">
                            <button type="button" class="btn btn-info addBtn"
                                data-url="{{ route('admin.createSamplesAjax') }}"><i class="fas fa-plus"></i> Add More
                            </button>
                        </div>
                        @foreach ($sample->sample_items as $sampleItem)
                            <div class="row closeDiv py-2">
                                <div class="col-12 col-md-4 raw_id">
                                    <select name="raw_id[]" id="raw_id" class="form-control ">
                                        <option value="">Select Raw</option>
                                        @foreach ($raws as $raw)
                                            <option {{ $raw->id == $sampleItem->raw_id ? 'selected' : '' }}
                                                data-id="{{ $raw->id }}" value="{{ $raw->id }}">
                                                {{ $raw->name }}({{ $raw->unit . $raw->unit_value }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-4">

                                    <input type="number" step="any" min="0" name="unit_item_value[]"
                                        value="{{ $sampleItem->unit_value }}" class="form-control"
                                        placeholder="Unit Value">
                                </div>
                                <div class="col-12 col-md-4">
                                    <button type="button" class="btn btn-danger deleteBtn"><i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label for="">Select Sample Name</label>
                                <select id="user" name="dhpl_product_id"
                                    class="form-control user-select select2-container step2-select select2"
                                    data-placeholder="Mobile" data-ajax-url="{{ route('selectNewProduct') }}"
                                    data-ajax-cache="true" data-ajax-dataType="json" data-ajax-delay="200" style="">
                                <option value="{{$sample->dhpl_product_id}}">{{$sample->name}} ({{$sample->dhplCat ? json_decode($sample->dhplCat->name)->en : ''}})</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="">Sample Unit Value</label>
                                <input type="number" step="any" min="0" name="unit_value" value="{{ $sample->unit_value }}"
                                    placeholder="Unit Value" class="form-control">
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="unit">Unit</label>
                                <select name="unit" id="unit" class="form-control" required>
                                    <option value="">Select Unit</option>
                                    @foreach (config('parameter.all_unit') as $unit)
                                        <option {{ $unit == $sample->unit ? 'selected' : '' }} value="{{ $unit }}">
                                            {{ ucfirst($unit) }}</option>
                                    @endforeach
                                </select>
                                {{-- <label for="">Unit</label> --}}
                                {{-- <input type="text" value="{{$sample->unit}}" name="unit" placeholder="Unit" --}}
                                {{-- class="form-control"> --}}
                            </div>
                            <div class="col-12 mt-2">
                                <label for="active"><input {{ $sample->active ? 'checked' : '' }} type="checkbox"
                                        name="active" id="active"> Active</label>

                            </div>
                            <div class="col-12">
                                <label for="">Procedure/Instruction</label>
                                <textarea name="details" id="" cols="30" rows="3" class="form-control">{{ $sample->details }}</textarea>
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

    <script>
        $(document).on('click', '.addBtn', function(e) {
            e.preventDefault();
            var that = $(this);
            var url = that.attr('data-url');
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    console.log(response)
                    $('.sampleValue').append(response);
                }
            });
        })
        $(document).on('click', '.deleteBtn', function(e) {
            e.preventDefault();
            var that = $(this);
            that.closest('.closeDiv').remove();
        });
        $('.step2-select').select2({
            theme: 'bootstrap4',
            // minimumInputLength: 1,
            ajax: {
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;
                    // alert(data[0].s);
                    var data = $.map(data, function(obj) {
                        obj.id = obj.id || obj.id;
                        return obj;
                    });
                    var data = $.map(data, function(obj) {
                        obj.text = obj.name+"("+obj.cat_title+")";
                        return obj;
                    });
                    return {
                        results: data,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                }
            },
        });
    </script>
@endpush
