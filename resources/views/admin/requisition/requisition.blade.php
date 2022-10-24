@extends('production.layouts.productionMaster')

@section('title')
    Account Dashboard
@endsection
@push('css')
@endpush

@section('content')
    <section class="content">
        <br>
        <div class="container">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="card-title ">
                        Requisitions View
                    </div>
                </div>
                <div class="card-body">
                    <h5><b>Requisition </b></h5>
                    <p><b>User: </b>{{$requisition->user ? $requisition->user->id : ''}}</p>
                    <p><b>Date: </b>{{$requisition->date}}</p>
                    <p><b>Status: </b>{{$requisition->status}}</p>
                    <p><b>Total Qty: </b>{{$requisition->total_quantity}}</p>
                    <p><b>Total Price: </b>{{$requisition->total_price}}</p>
{{--                    @if ($requisition->status == 'approved' )--}}
{{--                        <form action="{{route('production.updateStatusRequisition',['requisition'=>$requisition->id])}}" method="post">--}}
{{--                            @csrf--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="status">Update Status</label>--}}
{{--                                <select name="status" id="status">--}}
{{--                                    <option value="collected">Collected</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <input type="submit" class="btn btn-info">--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    @endif--}}

                </div>
                <div class="card">
                    <form action="{{route('accounts.requisitionProcessUpdate',['requisition'=>$requisition->id])}}" method="post">
                        @csrf
                        @if ($requisition->status =='pending')
                            <input type="hidden" name="type" value="approved">
                        @endif
                        @if ($requisition->status =='collected')
                            <input type="hidden" name="type" value="stocked">
                        @endif

                    <div class="card-body">
                        <h5>Requisition Items</h5>
                        <div class="table-responsive">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User Id</th>
                                    <th>Supplier</th>
                                    <th>Raw Material</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Type</th>
                                </tr>
                                </thead>
                                <tbody>

                               @forelse($requisition->requisition_items as $item)
                                   <input type="hidden" name="id[]" value="{{$item->id}}">
                                   <tr>
                                       <td>{{$item->id}}</td>
                                       <td>{{$item->user? $item->user->name : ''}}</td>
                                       <td>{{$item->supplier ? $item->supplier->name : ''}}</td>
                                       <td>
                                           {{$item->raw_materials->name}}({{$item->raw_materials->unit}} {{$item->raw_materials->unit_value}})
                                       </td>
                                       <th>
                                           @if ($requisition->status == 'pending')
                                               <input type="number" value="{{$item->quantity}}" name="quantity[]">
                                           @else
                                               {{$item->quantity}}
                                           @endif

                                       </th>
                                       <th>
                                           @if ($requisition->status == 'pending')
                                               <input type="number" value="{{$item->price}}" name="price[]">
                                           @else
                                               {{$item->price}}
                                           @endif

                                       </th>
                                       <td>{{$item->raw_type}}</td>
                                   </tr>
                                   @empty
                                   <tr>
                                       <td colspan="4" class="text-danger ">No Item Found</td>
                                   </tr>
                               @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                       <div class="text-right">
                           @if ($requisition->status == 'pending')
                               <input type="submit" class="btn btn-info" value="Approved">
                           @elseif($requisition->status == 'collected')
                               <input type="submit" class="btn btn-success" value="Stocked">
                           @endif
                       </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('js')

@endpush

