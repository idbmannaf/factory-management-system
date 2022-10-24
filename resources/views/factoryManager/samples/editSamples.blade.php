@extends('production.layouts.productionMaster')

@section('title')
    Production Dashboard
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
                        Edit Samples
                    </div>
                </div>
                <form action="{{route('admin.updateSample',$sample)}}" method="post">
                    @csrf
                    <div class="card-body sampleValue" style="background-color: #e5e5e5;">
                        <div class="col-12 py-3">
                            <button type="button" class="btn btn-info addBtn"
                                    data-url="{{route('admin.createSamplesAjax')}}"><i class="fas fa-plus"></i> Add More
                            </button>
                        </div>
                        @foreach($sample->sample_items as $sampleItem)
                            <div class="row closeDiv py-2">
                                <div class="col-12 col-md-4 raw_id">
                                    <select name="raw_id[]" id="raw_id" class="form-control ">
                                        <option value="">Select Raw</option>
                                        @foreach($raws as $raw)
                                            <option
                                                {{$raw->id == $sampleItem->raw_id ? 'selected': ''}} data-id="{{$raw->id}}"
                                                value="{{$raw->id}}">{{$raw->name}}({{$raw->unit.$raw->unit_value}})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-4">

                                    <input type="number" step="any" min="0"  name="unit_item_value[]" value="{{$sampleItem->unit_value}}"
                                           class="form-control" placeholder="Unit Value">
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
                                <label for="">Sample Name</label>
                                <input type="text" name="name" value="{{$sample->name}}" placeholder="Sample Name"
                                       class="form-control">
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="">Sample Unit Value</label>
                                <input type="number" step="any" min="0"  name="unit_value" value="{{$sample->unit_value}}"
                                       placeholder="Unit Value" class="form-control">
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="unit">Unit</label>
                                <select name="unit" id="unit" class="form-control" required>
                                    <option value="">Select Unit</option>
                                    @foreach(config('parameter.all_unit') as $unit)
                                        <option {{$unit == $sample->unit ? 'selected' :''}} value="{{$unit}}">{{ucfirst($unit)}}</option>
                                    @endforeach
                                </select>
{{--                                <label for="">Unit</label>--}}
{{--                                <input type="text" value="{{$sample->unit}}" name="unit" placeholder="Unit"--}}
{{--                                       class="form-control">--}}
                            </div>
                            <div class="col-12 mt-2">
                                <label for="active"><input {{$sample->active ? 'checked' : ''}} type="checkbox"
                                                           name="active" id="active"> Active</label>

                            </div>
                            <div class="col-12">
                                <label for="">Procedure/Instruction</label>
                                <textarea name="details" id="" cols="30" rows="3"
                                          class="form-control">{{$sample->details}}</textarea>
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
    <script>
        $(document).on('click', '.addBtn', function (e) {
            e.preventDefault();
            var that = $(this);
            var url = that.attr('data-url');
            $.ajax({
                url: url,
                method: 'GET',
                success: function (response) {
                    console.log(response)
                    $('.sampleValue').append(response);
                }
            });
        })
        $(document).on('click', '.deleteBtn', function (e) {
            e.preventDefault();
            var that = $(this);
            that.closest('.closeDiv').remove();
        })

    </script>
@endpush

