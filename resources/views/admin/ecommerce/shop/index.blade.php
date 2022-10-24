@extends('admin.layouts.adminMaster')

@section('title')
    Shop List
@endsection

@push('css')
<style>
tr.nowrap td {
        white-space: nowrap;
    }
</style>
@endpush

@section('content')

<div class="card">
    <div class="card-header w3-purple h3">
        <div class="row">
            <div class="col-md-7">
                Shop List
            </div>
            <div class="col-md-5 float-right">
                <div class="input-group mb-2">
                  <input type="text" class="form-control" name="query" id="searchQuery" placeholder="Shop Name, Owner Name, Mobile">
                  <input type="hidden" name="url" id="url" value="{{ route('admin.search', ['shop']) }}">
                  <div class="input-group-prepend">
                      <button class="btn btn-primary"><i class="fa fa-search" id="searchIcon"></i></button>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive" style="min-height: 75vh;">
            <table class="table table-bordered table-sm table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Action</th>
                        <th>Status</th>
                        <th>Account</th>
                        <th>Shop Name</th>
                        <th>Owner Name</th>
                        <th>Mobile</th>
                        <th>Description</th>
                        <th>Address</th>
                        <th>Type</th>
                        <th>Added By</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @include('admin.ecommerce.shop.parts.shopsTableBody')
                </tbody>
            </table>
        </div>
        <div class="responsive" id="pagination">
            {{ $shops->links() }}
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
