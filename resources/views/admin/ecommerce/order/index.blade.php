@extends('admin.layouts.adminMaster')

@push('css')
<style>

</style>
@endpush

@section('content')

<div class="card">
    <div class="card-header w3-deep-orange h3">
        <div class="row">
            <div class="col-md-7">
               {{ucfirst($type)}} Orders List
            </div>
            @if ($type == 'all')
            <div class="col-md-5 float-right">
                <div class="input-group mb-2">
                  <input type="text" class="form-control" name="query" id="searchQuery" placeholder="ID, Shop Name, Shop Mobile, SR Name">


                        <input type="hidden" name="url" id="url" value="{{ route('admin.search', ['order']) }}">
                  <div class="input-group-prepend">
                      <button class="btn btn-primary"><i class="fa fa-search" id="searchIcon"></i></button>
                  </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive" style="min-height: 75vh;">
            <table class="table bordered table-bordered table-sm">
                <thead>
                    <tr>
                        <th>ID #</th>
                        <th>Action</th>
                        <th>Ordered at</th>
                        @if ($type == 'pending')
                            <th>Pending at</th>
                        @elseif ($type == 'confirmed')
                            <th>Confirmed at</th>
                        @elseif ($type == 'processing')
                            <th>Processing at</th>
                        @elseif ($type == 'shipped')
                           <th> Shipped at</th>
                        @elseif ($type == 'collected')
                           <th> Collected at</th>
                        @elseif ($type == 'delivered')
                            <th>Delivered at</th>
                        @elseif ($type == 'cancelled')
                            <th>Cancelled at</th>
                        @elseif ($type == 'returned')
                           <th>Returned at</th>
                        @elseif ($type == 'undelivered')
                            <th>Undelivered At</th>
                        @endif
                        <th>Items</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Order For</th>
                        <th>Order By</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @include('admin.ecommerce.order.parts.orderTableBody')
                </tbody>
            </table>
        </div>
        <div class="responsive" id="pagination">
            {{ $orders->links() }}
        </div>
    </div>
</div>


@endsection


@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$('#searchQuery').on('keyup', function () {
    $('#searchIcon').toggleClass('fa fa-search')
    $('#searchIcon').toggleClass('fas fa-spinner fa-spin')
    var query = $('#searchQuery').val()
    var url = $('#url').val()
    axios.get(url+'?q='+query).then(res => {
        $('#pagination').hide()
        $('#tableBody').html(res.data)
        $('#searchIcon').toggleClass('fa fa-search')
        $('#searchIcon').toggleClass('fas fa-spinner fa-spin')
    });
});
</script>
@endpush
