@extends('admin.layouts.adminMaster')

@section('title')
{{ Str::ucfirst($type) }} Report
@endsection

@push('css')
<style>
tr.nowrap td{
    white-space: nowrap;
}
</style>

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('cp/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('cp/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')

<div class="card">
    <div class="card-header w3-purple h3">
        {{ Str::ucfirst($type) }} Report
    </div>
    <div class="card-body">
        <form class="" action="" method="get">
            <div class="row text-center">
                <div class="col-md-3">
                    <select class="form-control m-2" name="time" id="">
                        <option value="">Select Time</option>
                        <option value="today" @if( isset($input['time']) && $input['time'] == 'today') selected @endif>Today</option>

                    </select>


                    @if ($type == 'product')
                    <div class="ml-2">
                        <select class="form-control select2" name="products[]" id="" multiple="multiple" >
                            @foreach ($allProducts as $prod)
                            <option value="{{ $prod->id }}" @if(isset($input['products']) && in_array($prod->id, $input['products'])) selected @endif>{{ $prod->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                </div>
                <div class="col-md-3">
                    <div class="input-group m-2">
                        <label class="col-sm-3" for="">From: </label>
                        <input class="form-control col-sm-9" type="date" name="from" id="" value="{{ $input ? $input['from'] : '' }}">
                    </div>
                    <div class="input-group m-2">
                        <label class="col-sm-3" for="">To: </label>
                        <input class="form-control col-sm-9" type="date" name="to" id="" value="{{ $input ? $input['to'] : '' }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group m-2">
                        <label class="col-sm-3" for="">Supplier: </label>
                        <select class="form-control col-sm-9 select2" name="sr[]" id=""  multiple="multiple">
                            <option value="">Select Supplier</option>
                            @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" @if( isset($input['sr']) &&  in_array($supplier->id, $input['sr'])) selected @endif >{{ $supplier->name }} ({{ $supplier->supllier?$supplier->supllier->name: null }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group m-2">

                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary m-2" type="submit"><i class="fa fa-search"></i> Search</button>
                    <button class="btn btn-primary m-2" type="submit" onclick="return printDiv('printArea');"><i class="fa fa-print"></i> Print</button>
                </div>
            </div>

            <div>

            </div>

            {{-- <input class="form-control mx-2" type="text" name="query" id="" placeholder="search"> --}}

        </form>

        <div class="container">
            @if (!isset($input['time']) && !isset($input['status']) && !isset($input['sr']) && ! isset($input['shop']) && !isset($input['from']) && !isset($input['to']) && !isset($input['products']))
                **Please select some parameter then search for report.
            @endif
        </div>
    </div>
</div>

<div class="card">
    <div class="h4 card-header">
        {{ Str::ucfirst($type) }} Report
    </div>
    <div class="card" id="printArea">
        <div class="card-header">
            @if ($type == 'payments')
                @if(isset($input['time']) || isset($input['status']) || isset($input['sr']) || isset($input['shop']) || isset($input['from']) || isset($input['to']) || isset($input['products']))
                    {{-- @include('admin.report.orderReport') --}}
                    hey Buddy
                @endif
            @endif
        </div>
    </div>
</div>


@endsection


@push('js')
<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        // window.PPClose = true;
        // document.body.innerHTML = originalContents;
    }
</script>
<script>
    $(document).ready(function () {
        $('.select2').select2({theme: 'bootstrap4'});
    });
</script>

 <!-- Select2 -->
 <script src="{{ asset('cp/plugins/select2/js/select2.full.min.js') }}"></script>
@endpush
