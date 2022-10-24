

@extends('production.layouts.productionMaster')

@section('title')
    Production Dashboard
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('cp/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cp/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')
    <section class="content">
        <br>
        @include('alerts.alerts')
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Edit {{$production->product_name}}

                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('production.updateDailyProduction',['production'=>$production->id])}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="product">Product</label>

                            <select name="product" id="product" class="form-control mySelect2">
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                    <option {{$product->id == $production->product_id ? 'selected' : ''}} value="{{$product->id}}">{{json_decode($product->name)->en}} ({{$product->unit_value.$product->unit}} : {{$product->type_value.$product->type}})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="{{$production->quantity}}">
                        </div>
                        <div class="form-group">
                            <label for="pack">Pack</label>
                            <input type="number" class="form-control" id="pack" name="pack" value="{{$production->pack}}">
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Update" class="btn btn-info">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection


@push('js')
    <!-- Select2 -->
    <script src="{{ asset('cp/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('select').select2({theme: 'bootstrap4'});
        });

    </script>



@endpush

