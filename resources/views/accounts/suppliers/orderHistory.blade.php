@extends('accounts.layouts.accountMaster')

@section('title')
Account Dashboard
@endsection

@push('css')
<!-- include summernote css/js -->
{{--
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> --}}

{{--
<link rel="stylesheet" type="text/css" href="{{ asset('css/summernote.css') }}"> --}}

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
                            <span>All Orders of {{$supplier->name}}</span>
                            {{-- <span><input type="text" id="query"
                                    data-url="{{route('admin.orderSearch',$supplier)}}"></span> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#Order Id</th>
                                    <th>Item Count</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody id="orders">
                                @forelse($orders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{count($order->supplierRequisitionItems($supplier->id))}}</td>
                                    <td><div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{route('account.supplierOrderDetails',['order'=>$order->id,'supplier'=>$supplier->id])}}">Order Details</a>
                                            <a class="dropdown-item" href="{{route('account.downloadSupplierOrderDetails',['order'=>$order->id,'supplier'=>$supplier->id])}}"> <i class="fas fa-download"></i> Download</a>
                                        </div>
                                      </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="text-danger h4">No Suppliers Orderes Found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">{{$orders->render()}}</div>
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

<script>
    $("#query").keyup(function(){
        var value =$(this).val();
        var url = $(this).attr('data-url');
        var fullUrl = url+"?q="+value;
        $.ajax({
            url:fullUrl,
            method:'GET',
            success:function(r){
                $('#orders').html(r);
            }
        });
    })
</script>
@endpush
