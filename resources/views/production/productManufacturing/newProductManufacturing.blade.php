@extends('production.layouts.productionMaster')

@section('title')
    Production Dashboard - Product Manufacturing
@endsection
@push('css')
    <style>
        input {
            width: 80px;
        }

    </style>
@endpush

@section('content')
    <section class="content">
        <br>
        @include('alerts.alerts')
        <div class="container">
            <form action="{{ route('admin.storeProductManufacturing', ['product' => $product]) }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Product Manufacturing
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-4 pb-2">
                                <select name="" id="sample"
                                    data-url="{{ route('production.productManufacturingAjax', ['product'=>$product]) }}"

                                    class="form-control sample"
                                    data-unit-check-url="{{ route('admin.checkRawUnit', ['type' => 'sample']) }}">
                                    <option value="">Select Samples</option>
                                    @foreach ($samples as $sample)
                                        <option {{ $product->sample_id == $sample->id ? 'selected' : '' }}
                                            value="{{ $sample->id }}">{{ $sample->name }}
                                            ({{ $sample->unit . '-' . $sample->unit_value }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-2 show_sample_unit">
                                <select name="sample_unit" id="sample_unit" class='form-control' required>
                                    @if ($product->sample)
                                    @if ($product->sample->unit == 'kg' || $product->sample->unit == 'gm')
                                    <option value="">Select Unit</option>
                                    <option {{ $product->sample->unit == 'kg' ? 'selected' : '' }} value="kg">kg</option>
                                    <option {{ $product->sample->unit == 'gm' ? 'selected' : '' }} value="gm">gm</option>
                                @endif
                                @if ($product->sample->unit == 'ltr' || $product->sample->unit == 'ml')
                                    <option value="">Select Unit</option>
                                    <option {{ $product->sample->unit == 'ltr' ? 'selected' : '' }} value="ltr">Litter</option>
                                    <option {{ $product->sample->unit == 'ml' ? 'selected' : '' }} value="ml">ml</option>
                                @endif
                                    @endif

                                </select>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="">
                                    <input type="number" step="any" min="0"
                                        data-url="{{ route('production.productManufacturingCalculateAjax', $product) }}"
                                        data-user-type= "production"
                                        value="{{ $product->multiply_qty }}" name="multiply" id="qtyMultiply"
                                        class=" form-control" placeholder="Quantity" required min="1">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-12" id="insertSampleItems">
                                @if ($product->sample)
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Raw</th>
                                                    <th>Raw Type</th>
                                                    <th>Unit</th>
                                                    <th>Unit Value</th>
                                                    {{-- <th>Created At</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($product->sample->sample_items as $sampleItem)
                                                    <tr>
                                                        <td>{{ $sampleItem->raw ? $sampleItem->raw->name : '' }}</td>
                                                        <td>{{ $sampleItem->raw ? $sampleItem->raw->type : '' }}</td>
                                                        <td>{{ $sampleItem->unit }}</td>
                                                        <td>{{ $sampleItem->unit_value }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-danger h5">No Samples Found</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>{{ $product->sample->name }}</th>
                                                    <th></th>
                                                    <th>{{ $product->sample->unit }}</th>
                                                    <th>{{ $product->sample->unit_value }}</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                @endif
                            </div>

                            <div class="col-12 col-md-12" id="insertSampleitemsWithPrice">

                            </div>
                        </div>
                        <div class="col-12 m-auto pt-2 text-center">
                            <button type="submit" class="btn btn-info submitBtn" disabled>Submit</button>

                        </div>
                    </div>

            </form>
        </div>
        </div>
    </section>
@endsection


@push('js')
    <script src="{{ asset('js/productManucatrure.js') }}"></script>
    <script>

    </script>
@endpush
