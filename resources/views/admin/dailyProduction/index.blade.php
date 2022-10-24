

@extends('admin.layouts.adminMaster')

@section('title')
    Admin Dashboard
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
                    <div class="d-flex justify-content-between">
                        <div>Daily Production</div>
                        <div>
                            @if ($type == 'all')
                            <a href="{{route('downloadNow',['type'=>'dailyProduction','status'=>'all'])}}" class="btn btn-success btn-sm"> <i class="fas fa-download"> </i>Download</a>
                                @elseif ($type == 'pending')
                                <a href="{{route('downloadNow',['type'=>'dailyProduction','status'=>'pending'])}}" class="btn btn-success btn-sm"> <i class="fas fa-download"> </i>Download</a>
                                @elseif ($type == 'approved')
                                <a href="{{route('downloadNow',['type'=>'dailyProduction','status'=>'approved'])}}" class="btn btn-success btn-sm"> <i class="fas fa-download"> </i>Download</a>
                                @elseif ($type == 'rejected')
                                <a href="{{route('downloadNow',['type'=>'dailyProduction','status'=>'rejected'])}}" class="btn btn-success btn-sm"> <i class="fas fa-download"> </i>Download</a>
                            @endif

                        </div>
                    </div>
                </div>
                @if ($type == 'all')
                <div class="card-body op-hide">
                    <form action="{{route('admin.dailyProductionPost')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="product">Product</label>
                            <select name="product" id="product" class="form-control select2">
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{$product->id}}">{{json_decode($product->name)->en}} ({{$product->unit_value.$product->unit}} : {{$product->type_value.$product->type}})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity">
                        </div>
                        <div class="form-group">
                            <label for="pack">Pack</label>
                            <input type="number" class="form-control" id="pack" name="pack">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-info">
                        </div>
                    </form>


                </div>
                @endif
                <div class="card">
                    <div class="card-header bg-blue">
                        Daily Production History
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm" style="white-space: nowrap">
                                <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Action</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Pack</th>
                                    <th>Category Name</th>
                                    <th>Unit</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($dailyProduction as $dp)
                                    <tr>
                                        <td>{{$dp->product_id}}</td>
                                        <td>
                                            @if($dp->status == 'pending')
                                            <div class="btn-group btn-sm">
                                                <a href="{{route('admin.editDailyProduction',['production'=>$dp->id])}}"  class="btn btn-info btn-xs">Edit</a>
                                                <a href="{{route('admin.deleteDailyProduction',['production'=>$dp->id])}}" class="btn btn-danger btn-xs" onclick="return confirm('are you sure? You want to delete this production??');">Delete</a>
                                                <a href="{{route('admin.updateDailyProductionStatus',['production'=>$dp->id,'status'=>'approved'])}}"  class="btn btn-info btn-xs">Approve</a>
                                                <a href="{{route('admin.updateDailyProductionStatus',['production'=>$dp->id,'status'=>'rejected'])}}"  class="btn btn-danger btn-xs">Reject</a>
                                            </div>
                                                @endif
                                        </td>
                                        <td>{{$dp->product_name}}</td>
                                        <td>{{$dp->quantity}}</td>
                                        <td>{{$dp->pack}}</td>
                                        <td>{{$dp->category_name}}</td>
                                        <td>{{$dp->unit_value. $dp->unit}}</td>
                                        <td>{{$dp->type_value. $dp->type}}</td>
                                        <td>{{$dp->status}}</td>
                                        <td>{{\Carbon\Carbon::parse($dp->created_at)->format('d M,Y')}}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{$dailyProduction->render()}}
                    </div>
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
            $('.select2').select2({theme: 'bootstrap4'});
        });
        $('#mySelect2').select2({
            dropdownParent: $('.modal')
        });
    </script>



@endpush

