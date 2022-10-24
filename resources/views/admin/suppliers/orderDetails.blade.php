@extends('admin.layouts.adminMaster')

@section('title')
Admin Dashboard
@endsection

@push('css')
<style>
    /* @media print {
    thead,tbody,tfoot,tr,td,th, {
       display: block;
    }
    .example-print {
       display: block;
    } */
}
</style>

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
                            <span>Order No (<b>{{$order->id}}</b>) Details of {{$supplier->name}}</span>
                            <span><a href="" onclick="window.print();"> <i class="fas fa-print"></i></a>
                                <a href="{{route('account.downloadSupplierOrderDetails',['order'=>$order->id,'supplier'=>$supplier->id])}}"> <i class="fas fa-download"></i> Download</a>
                            </span>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Raw Material</th>
                                    <th>Raw Type</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Vat</th>
                                    <th>Final Price</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>

                            <tbody id="orders">
                                <?php
                                $total_qty = 0;
                                $total_price= 0;
                                ?>
                                @foreach($order->supplierRequisitionItems($supplier->id) as $item)
                                <tr>
                                    <td>{{$item->raw_materials->name}}
                                    ({{$item->raw_materials->unit_value. $item->raw_materials->unit}})
                                    </td>
                                    <td>{{$item->raw_type}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>{{$item->vat}}</td>
                                    <td>{{$item->final_price}}</td>
                                    <td>{{$item->final_price * $item->quantity}}</td>

                                    <?php
                                    $total_qty += $item->quantity;
                                    $total_price += $item->final_price * $item->quantity;
                                    ?>
                                </tr>
                                @endforeach
                                <tfoot>
                                    <tr>
                                        <th colspan="6" class="text-right">Total Price</th>
                                        <th>{{$total_price}}</th>
                                    </tr>
                                </tfoot>
                            </tbody>
                        </table>
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
