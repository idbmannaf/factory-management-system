@extends('admin.layouts.adminMaster')

@push('css')
    <style>

    </style>
@endpush

@section('content')

    <div class="card">
        <div class="card-header w3-deep-orange h3">
            Orders
        </div>
        <div class="card-body">
            <section class="content w3-white">
                <br>
                <div class="container">
                    @include('alerts.alerts')
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h5>From:</h5>
                                        <address>
                                            <strong>{{config('app.name')}}</strong><br>
                                            abc,abcdefg<br>
                                            London, United Kingdom<br>
                                            <strong title="Phone">Phone:</strong> (123) 456-789
                                        </address>
                                    </div>

                                    <div class="col-sm-6 text-right">
                                        <h4 class="border rounded py-2 px-4">Order Number: {{ $order->id }}</h4>
                                        <span>To:</span>
                                        <address>
                                            <strong>Shop: {{ $order->orderForSource->name }} </strong><br>
                                            <strong>Owner: {{ $order->orderForSource->owner_name }} </strong><br>
                                            {{ $order->address }}
                                            <br>
                                            <abbr title="Phone">Mobile:</abbr> {{ $order->mobile }} <br>
                                        </address>
                                        <p>
                                            <span><strong>Invoice Date:</strong> {{ $order->created_at->toDateString() }}</span><br/>
                                            <span><strong>{{ ucfirst($order->order_status) }} Date:</strong>
                                            @if($orderS = $order->order_status)
                                                    {{ $order->created_at->toDateString() }}
                                                @endif
                                        </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="h5">
                                    Order by SR : {{ $order->orderByAgent ? 'Yes' : 'No' }}
                                </div>
                                @if ($order->orderByAgent)
                                    <div class="table-responsive m-t">
                                        <table class="table invoice-table table-sm table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>SR Id</th>
                                                <th>SR Name</th>
                                                <th>Contact</th>
                                                <th>Dealer</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    {{$order->orderByAgent->id}}
                                                </td>
                                                <td>
                                                    {{ $order->orderByAgent->user->name }}
                                                    ({{$order->orderByAgent->name}})
                                                </td>
                                                <td>
                                                    {{$order->orderByAgent->user->mobile}} <br>
                                                    {{$order->orderByAgent->user->email}}
                                                </td>
                                                <td>
                                                    {{ $order->orderByAgent->dealer->user->name }}
                                                    ({{ $order->orderByAgent->dealer->name }})
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                            @endif
                            <!-- /table-responsive -->
                            </div>
                        </div>
                    </div>
                </div>

                <br>

                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header w3-blue">
                                    <h3 class="card-title ">
                                        Manage Product | Order Status : <span
                                            class="badge @if($order->order_status == 'confirmed') badge-success @else badge-primary @endif ">{{ Str::ucfirst($order->order_status) }}</span>
                                    </h3>
                                </div>
                                <!-- /.card-header -->

                                <form class="form-inline" method="post"
                                      action="{{ route('admin.ecommerce.orderOrderStatusUpdate',$order) }}">

                                    @csrf
                                    <div class="card-body p-0">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive table-sm table-bordered">
                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <th style="width: 10px">#</th>
                                                            <th>Unit</th>
                                                            <th>Product Name</th>
                                                            <th>Qty.</th>
                                                            <th>Bonus</th>
                                                            <th>Total Quanity</th>
                                                            <th>Rate</th>
                                                            <th>Price</th>
                                                            <th>Update Qty.</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($order->items as $item)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>
                                                                    {{$item->unit_value}} {{$item->unit}}
                                                                </td>
                                                                <td>{{ $item->product->name }}</td>
                                                                <td>{{ $item->total_quantity }}</td>
                                                                <td>{{$item->bonus}}</td>
                                                                <td>{{$item->total_quantity + $item->bonus}}</td>
                                                                <td>&#2547; {{number_format($item->collection_amount / $item->total_quantity, 2, '.', '')  }}</td>
                                                                <td>&#2547; {{ number_format($item->collection_amount, 2, '.', '') }}</td>
                                                                <td>
                                                                    <input type="number" class="form-control"
                                                                           name="order_qty_{{ $item->id }}"
                                                                           value="{{ $item->total_quantity }}"
                                                                           id="order_qty_{{ $item->id }}">
                                                                    <button class="btn btn-danger"
                                                                            onclick="event.preventDefault();removeProduct({{ $item->id }})">
                                                                        <i class="fa fa-trash"></i></button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>Total:</td>
                                                            <td>&#2547; {{ $order->total_collection_amount }}</td>
                                                            <td>
                                                                <div class="input-group m-auto input-group-sm">
                                                                    <label for="">Status: </label>
                                                                    <select class="form-control" name="order_status"
                                                                            id="order_status"
                                                                        {{$order->order_status == 'delivered' ? 'disabled' : ''}} {{$order->order_status == 'confirmed' ? 'disabled' : ''}} {{$order->order_status == 'confirmed' ? 'processing' : ''}} {{$order->order_status == 'confirmed' ? 'ready_to_ship' : ''}} {{$order->order_status == 'confirmed' ? 'shipped' : ''}} {{$order->order_status == 'collected' ? 'disabled' : ''}}>

                                                                        {{-- <option {{ $order->order_status == 'pending' ? 'selected' : '' }}>pending</option> --}}

                                                                        <option
                                                                            {{ $order->order_status == 'confirmed' ? 'selected' : '' }} value="confirmed">
                                                                            Confirm
                                                                        </option>

                                                                        {{-- <option {{ $order->order_status == 'processing' ? 'selected' : '' }}>processing</option>
                                                                        <option {{ $order->order_status == 'ready_to_ship' ? 'selected' : '' }}>ready_to_ship</option>
                                                                        <option {{ $order->order_status == 'shipped' ? 'selected' : '' }}>shipped</option>
                                                                        <option {{ $order->order_status == 'collected' ? 'selected' : '' }}>collected</option>

                                                                        <option {{ $order->order_status == 'delivered' ? 'selected' : '' }}>delivered</option>
                                                                        <option {{ $order->order_status == 'returned' ? 'selected' : '' }}>returned</option>
                                                                        <option {{ $order->order_status == 'undelivered' ? 'selected' : '' }}>undelivered</option> --}}
                                                                        <option
                                                                            {{ $order->order_status == 'cancelled' ? 'selected' : '' }} value="cancelled">
                                                                            Cancel
                                                                        </option>


                                                                    </select>
                                                                    <div class="input-group-append">
                                                                        <button class="btn btn-success"
                                                                                type="submit" {{$order->order_status == 'delivered' ? 'disabled' : ''}} {{$order->order_status == 'confirmed' ? 'disabled' : ''}} {{$order->order_status == 'confirmed' ? 'processing' : ''}} {{$order->order_status == 'confirmed' ? 'ready_to_ship' : ''}} {{$order->order_status == 'confirmed' ? 'shipped' : ''}} {{$order->order_status == 'collected' ? 'disabled' : ''}}>
                                                                            Update
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                {{-- <div class="text-center border-top pt-1">
                                                  Payment Status:    <span class="badge badge-info"><b>
                                                      {{ $order->payment_status }}
                                                  </b></span>
                                                </div> --}}
                                            </div>
                                            <div class="col-md-12 py-5">


                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <!-- /.card-body -->
                            </div>
                        </div>
                        {{-- <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header w3-blue">
                                  <h3 class="card-title ">
                                        Manage Payment
                                  </h3>
                                </div>
                                <div class="card-body p-0">
                                    <form action="{{route('admin.orderPaymentSubmit',$order)}}" method="POST">
                                        @csrf
                                        <div class="w3-round w3-white p-2">


                                            <div class="form-group">
                                                <label>Paid Amount</label>
                                                <input type="number" name="paid_amount" value="{{ $order->total_due }}" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>Payment Method</label>
                                                <select class="form-control" name="payment_type">
                                                    <option value="">Select Option</option>
                                                    <option value="Hand Cash">Hand Cash</option>
                                                    <option value="Bank Transfer">Bank Transfer</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Mobile/Account No</label>
                                                <input class="form-control" type="text" name="account_number" id="account_number">
                                            </div>
                                            <div class="form-group">
                                                <label>Note</label>
                                                <input type="text" name="note" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-success btn-sm" type="submit">Add Payment</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="col-md-8">
                            <div class="card">
                                <div class="card-header w3-blue">
                                    <h3 class="card-title">Manual Payment</h3>
                                </div>
                                <div class="card-body">
                                    <div class="w3-round w3-white p-2">
                                        @if($order->payments)
                                        @foreach($order->payments as $payment)

                                        @if($payment->payment_status == 'pending')

                                        <div class="border rounded pl-3 w3-yellow">
                                            <h5>Pending Payment</h5>
                                        </div>
                                        <br>

                                                <form method="post" action="{{ route('admin.orderPaymentUpdate',$payment) }}">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Paid Amount</label>
                                                                    <input type="text" name="paid_amount" value="{{ $payment->paid_amount }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">

                                                                                <div class="form-group">
                                                                <label>Payment Method</label>
                                                                <select class="form-control" name="payment_type">
                                                                    <option value="">Select Option</option>
                                                                    <option  {{ $payment->payment_type == 'cash' ? 'selected' : '' }}  value="cash">Hand Cash</option>

                                                                    <option  {{ $payment->payment_type == 'bank' ? 'selected' : '' }}  value="bank">Bank Transfer</option>

                                                                    <option  {{ $payment->payment_type == 'cheque' ? 'selected' : '' }}  value="cheque">Cheque</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="col-sm-6">

                                                            <div class="form-group">
                                                                <label>Bank/Mobile Number</label>
                                                                <input type="text" name="account_number" value="{{ $payment->account_number }}" class="form-control">
                                                            </div>

                                                        </div>
                                                        <div class="col-sm-6">

                                                            <div class="form-group">
                                                                <label>Note</label>
                                                                <input type="text" name="note" value="{{ $payment->note }}" class="form-control">
                                                            </div>


                                                        </div>
                                                        <div class="col-sm-8"></div>

                                                        <div class="col-sm-2">
                                                            <a href="">
                                                                <button class="btn btn-success" type="submit">Update</button>
                                                            </a>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <a onclick="confirm('Do you really want to delete this payment?');" href="{{route('admin.orderpaymentDelete',$payment)}}" class="btn btn-danger">
                                                                Delete
                                                            </a>
                                                        </div>
                                                        <div class="col-sm-3"></div>
                                                    </div>

                                                    <br>

                                                    <div class="float-right">

                                                        <button class="btn btn-sm btn-primary" type="submit">Update</button>
                                                    </div>

                                                </form>

                                        @elseif($payment->payment_status =='completed')


                                        <b>Completed Payment</b> <br>
                                        @if ($loop->first)
                                        <div class="border rounded pl-3 w3-green">
                                            <h5>Completed Payment</h5>
                                        </div>
                                        @endif

                                        <div class="card-body">
                                            <table>
                                                <tr>
                                                    <th>
                                                        Paid amount
                                                    </th>
                                                    <td>:</td>
                                                    <td>
                                                        {{$payment->paid_amount}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Payment type
                                                    </th>
                                                    <td>:</td>
                                                    <td>
                                                        {{$payment->payment_type}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Mobile/account no
                                                    </th>
                                                    <td> : </td>
                                                    <td>
                                                        {{$payment->account_number}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Note
                                                    </th>
                                                    <td>:</td>
                                                    <td>
                                                        {{$payment->note}}
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>

                                        @endif

                                        @endforeach
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                @if(isset($type) && $type == 'delivered')
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header w3-blue">
                                        <h3 class="card-title">Taken Packages Details</h3>
                                    </div>
                                    <div class="card-body">
                                        <table class="w3-table w3-bordered w3-centered">
                                            <tr>
                                                <th>Course level</th>
                                                <th>No of courses</th>
                                                <th>No of persons</th>
                                                <th>No of attempts</th>
                                                <th>No of credits</th>
                                                <th>Duration</th>
                                                <th>Package for</th>
                                                <th>package type</th>
                                                <th>Expired date</th>

                                            </tr>
                                            <tr>
                                                <td>
                                                    {{$order->takenpackage->course_level}}
                                                </td>
                                                <td>
                                                    {{$order->takenpackage->no_of_courses}}
                                                </td>
                                                <td>
                                                    {{$order->takenpackage->no_of_persons}}
                                                </td>
                                                <td>
                                                    {{$order->takenpackage->no_of_attempts}}
                                                </td>
                                                <td>
                                                    {{$order->takenpackage->no_of_credits}}
                                                </td>
                                                <td>
                                                    {{$order->takenpackage->duration}} Days
                                                </td>
                                                <td>
                                                    {{$order->takenpackage->package_for}}
                                                </td>
                                                <td>
                                                    {{$order->takenpackage->package_type}}
                                                </td>
                                                <td>
                                                    {{$order->takenpackage->expired_date}}
                                                </td>
                                            </tr>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </section>
        </div>
    </div>


@endsection


@push('js')
    <script>
        function removeProduct(id) {
            $('#order_qty_' + id).val(0)
        }
    </script>
@endpush
