@extends('admin.layouts.adminMaster')

@section('title')
    Admin Dashboard
@endsection

@push('css')
    <!-- include summernote css/js -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> --}}

    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/summernote.css') }}"> --}}
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="container">
                @include('alerts.alerts')
                <div class="card">
                    <div class="card-header">
                        <div class="">
                            <div class="d-flex justify-content-between">
                                <span>All Payment History of {{ $supplier->name }}</span>
                                <span><input type="text"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center p-3">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $supplier->total_phrases_amount }}</h3>
                                    <p>Pharses Amount</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>

                            </div>
                        </div>


                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $supplier->total_paid_amount }} </h3>
                                    <p>Paid Amount</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $supplier->total_phrases_amount - $supplier->total_paid_amount }}</h3>
                                    <p>Due Amount</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="raw">
                        <div class="col-12 col-md-6 m-auto">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Payment Form</h4>
                                </div>
                                <div class="card-body ">
                                    <form action="{{ route('admin.payNow', $supplier) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="paid_amount">Paid Amount</label>
                                            <input type="number" name="paid_amount" id="paid_amount" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="payment_method">Payment Method</label>
                                            <select name="payment_method" id="payment_method" class="form-control">
                                                <option value="">Select Payment Method</option>
                                                <option value="cash">Cash</option>
                                                <option value="bank">Bank</option>
                                                <option value="mobile_banking">Mobile Banking</option>
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label for="account_number">Acccount Number</label>
                                            <input type="text" name="account_number" id="account_number"
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="note">Note</label>
                                            <textarea name="note" id="note" cols="30" rows="3" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info">Pay Now</button>

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-success">Payment History</div>
                        <div class="card-body">
                            <div class="table-responsive mt-3">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Action</th>
                                            <th>Paid Date</th>
                                            <th>Paid By</th>
                                            <th>Previous Balance</th>
                                            <th>Paid Balance</th>
                                            <th>New balance</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($paymentHistories as $payment)
                                            <thead>
                                                <tr>
                                                    <td>{{ $payment->id }}</td>
                                                    <th>
                                                        @if ($last_payment->id == $payment->id)
                                                            <a href="" data-toggle="modal"
                                                                data-target="#edit{{ $payment->id }}"><i
                                                                    class="fas fa-edit"></i></a>
                                                            <a onclick="return confirm('Are you sure? You want to delete this Payment');" href="{{route('admin.deletePayment',['payment'=>$payment->id,'supplier'=>$supplier])}}"><i class="fas fa-trash"></i></a>
                                                        @endif
                                                    </th>
                                                    <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('d M,Y') }}
                                                    </td>
                                                    <td>{{ $payment->user ? $payment->user->name : '' }}</td>
                                                    <td>{{ $payment->previous_balance }}</td>
                                                    <td>{{ $payment->moved_balance }}</td>
                                                    <td>{{ $payment->new_balance }}</td>
                                                </tr>
                                            </thead>
                                            {{-- Edit Modal Start  --}}
                                            <div class="modal fade" id="edit{{$payment->id}}" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Payment
                                                            </h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('admin.updatePayment',['payment'=>$payment->id,'supplier'=>$supplier])}}" method="POST">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="paid_amount">Paid Amount</label>
                                                                    <input type="number" name="paid_amount" id="paid_amount" value="{{$payment->moved_balance}}" class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="payment_method">Payment Method</label>
                                                                    <select name="payment_method" id="payment_method" class="form-control">
                                                                        <option value="">Select Payment Method</option>
                                                                        <option {{$payment->payment_method == 'cash' ? 'selected' : ''}} value="cash">Cash</option>
                                                                        <option {{$payment->payment_method == 'bank' ? 'selected' : ''}} value="bank">Bank</option>
                                                                        <option {{$payment->payment_method == 'mobile_banking' ? 'selected' : ''}} value="mobile_banking">Mobile Banking</option>
                                                                    </select>

                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="account_number">Acccount Number</label>
                                                                    <input type="text" name="account_number" id="account_number" value="{{$payment->account}}"
                                                                        class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="note">Note</label>
                                                                    <textarea name="note" id="note" cols="30" rows="3" class="form-control">{{$payment->note}}</textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-info">Pay Now</button>

                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Edit Modal END  --}}
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-danger h4">No Payment History Found</td>
                                            </tr>

                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center">{{ $paymentHistories->render() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">

    </section>


    {{-- @include('welcome.includes.modals.modalLg') --}}
@endsection



@push('js')
@endpush
