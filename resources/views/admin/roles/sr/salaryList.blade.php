@extends('admin.layouts.adminMaster')
@section('title')
    SR Salary List
@endsection
@push('css')
<style>

</style>
@endpush

@section('content')

<div class="card">
    <div class="card-header w3-purple h3">
        {{ $agent->name }} Salary List
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
            @include('admin.roles.sr.srInfo')
            </div>
            <div class="col-md-6">
            </div>
        </div>
        <div class="table-responsive">
            @include('alerts.alerts')
            <div class="card w3-border-blue py-3 border">
                <form action="{{ route('admin.sr.salary.pay', $agent) }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="col-md-3 text-center">
                            <label for="">SR Income</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">&#2547;</span>
                                </div>
                                <input class="form-control" type="number" name="" id="before" value="{{ $agent->current_income }}" disabled>
                            </div>

                        </div>
                        <div class="col-md-3 text-center">
                            <label for="">Paid Amount</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">&#2547;</span>
                                </div>
                                <input class="form-control" type="number" name="payment" id="payment" value="{{ $agent->current_income }}" min="1" max="{{ $agent->current_income }}" required>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <label for="">Remaining Income</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">&#2547;</span>
                                </div>
                                <input class="form-control" type="number" name="" id="after" value="" disabled>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <label for=""></label>
                            <input class="form-control bg-success" type="submit" name="" id="" value="Save Payment">
                        </div>
                    </div>
                </form>
            </div>
            <table class="table table-bordered table-sm table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Previous Amount</th>
                        <th>Paid Amount </th>
                        <th>Remaining Amount </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salaries as $salary)
                        <tr>
                            <td>{{ $salary->trans_date }}</td>
                            <td> &#2547; {{ $salary->previous_income }}</td>
                            <td> &#2547; {{ $salary->paid_amount }}</td>
                            <td> &#2547; {{ $salary->current_income }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="">
            {{ $salaries->links() }}
        </div>
    </div>
</div>


@endsection


@push('js')
<script>
    $(document).ready(function () {
        $('#payment').on('keyup', function () {
            var beforeAmount = $('#before').val()
            var payment = $('#payment').val()
            var beforeAmount = beforeAmount - payment
            $('#after').val(beforeAmount)
        })
        $('#payment').on('change', function () {
            var beforeAmount = $('#before').val()
            var payment = $('#payment').val()
            var beforeAmount = beforeAmount - payment
            $('#after').val(beforeAmount)
        })
    })
</script>
@endpush
