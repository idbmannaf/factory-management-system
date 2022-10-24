@extends('admin.layouts.adminMaster')

@push('css')
<style>

</style>
@endpush

@section('content')

<div class="card">
    <div class="card-header w3-purple h3">
        
        <div class="row">
            <div class="col-md-7">
                Products <a href="{{ route('admin.ecommerce.product.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
            </div>
            <div class="col-md-5 float-right">
                <div class="input-group mb-2">
                  <input type="text" class="form-control" name="query" id="searchQuery" placeholder="ID, Name, Category">
                  <input type="hidden" name="url" id="url" value="{{ route('admin.search', ['product']) }}">
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
                    <tr class="text-center">
                        <th>Id</th>
                        <th>Action</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Type Value</th>
                        <th>Unit</th>
                        <th>Unit Value</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @include('admin.ecommerce.product.parts.productTableBody')
                </tbody>
            </table>
        </div>
        <div class="" id="pagination">
            {{ $products->links() }}
        </div>
    </div>
</div>


@endsection


@push('js')
<script>
function publish(url,id) {
    console.log(id);
    axios.post(url).then(res => {
        $("#publish_button_"+id).addClass('disabled')
        $("#publish_button_"+id).html(`<i class="fas fa-check-double"></i> Published</button>`)
    })
}
</script>
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
