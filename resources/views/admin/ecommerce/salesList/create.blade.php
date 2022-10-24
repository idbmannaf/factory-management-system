@extends('admin.layouts.adminMaster')

@push('css')
<link rel="stylesheet" href="{{ asset('https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css') }}">
<link href="{{ asset('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css') }}" rel="stylesheet" />
<style>
</style>
@endpush

@section('content')

<form action="{{ route('admin.ecommerce.salesList.store', [$list ?? '']) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header w3-indigo h3">
            @isset($list) Edit @else Create @endisset Sales list <button class="btn btn-primary px-4 float-right"><i class="fa fa-save"></i> Save</button>
        </div>
        <div class="card-body">
            @include('alerts.alerts')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">List Name (English)</label>
                        <input class="form-control @error('name_en') is-invalid @enderror" type="text" name="name_en" value="{{ old('name_en') ?: $list->name ?? '' }}">
                        @error('name_en')
                            <span class="btn alert alert-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">List Name (বাংলা)</label>
                        <input class="form-control" type="text" name="name_bn" value="">
                    </div>

                    <div class="form-group">
                        <label for="">Description (english)</label>
                        <textarea rows="4" class="form-control @error('description_en') is-invalid @enderror" type="text" name="description_en">{{ old('description_en') ?: $list->description ?? '' }}</textarea>
                        @error('description_en')
                            <span class="btn alert alert-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Description (বাংলা)</label>
                        <textarea rows="4" class="form-control" type="text" name="description_bn"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Icon</label>
                        @isset($list)
                        <div class="text-center">
                            <img src="{{ $list->img_name }}" style="max-height: 100px; max-width: 100px; margin: auto;" alt="">
                        </div>
                        @endisset
                        <input class="form-control @error('icon') is-invalid @enderror" type="file" name="icon">

                        @error('icon')
                            <span class="btn alert alert-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Banner</label>
                        @isset($list)
                        <div class="text-center">
                            <img src="{{ $list->banner_name }}" style="max-height: 200px; max-width: 400px; margin: auto;" alt="">
                        </div>
                        @endisset
                        <input class="form-control @error('banner') is-invalid @enderror" type="file" name="banner">

                        @error('banner')
                            <span class="btn alert alert-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="products">Select Products</label>
                        <select class="form-control js-example-basic-multiple select2-container step2-select select2" name="products[]" id="products"
                        data-placeholder="Name, Excerpt, Description, What in box"
                        data-ajax-url="{{route('admin.ecommerce.salesList.product.search')}}"
                        data-ajax-cache="true"
                        data-ajax-dataType="json"
                        data-ajax-delay="200"
                        multiple="multiple">
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="active">
                        <label for="active">Active</label>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-primary px-5"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </div>
</form>
@isset($list)
    <div class="card">
        <div class="card-header">
            List Products
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            {{-- <th>Postion</th> --}}
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($list->items->count() > 0)
                        @foreach ($list->items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ $item->product->feature_img }}" alt="" style="max-height: 60px; max-width:60px; margin:auto;">
                                </td>
                                <td>{{ $item->product->name }}</td>
                                <td>
                                    <a class="btn btn-danger btn-sm" href="{{ route('admin.ecommerce.salesList.product.detach', [$item, $item->product]) }}"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        @else
                            <tr>
                                <td>No products on this list</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endisset

@endsection


@push('js')
<script src="{{ asset('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js') }}"></script>

<script>
  $(document).ready(function () {
  $('.select2').select2({
    theme:'bootstrap4',
    minimumInputLength: 1,
    ajax: {
      data: function (params) {
        return {
          q: params.term, // search term
          page: params.page
        };
      },
      processResults: function (data, params) {
        params.page = params.page || 1;
        // alert(data[0].s);
        var data = $.map(data, function (obj) {
          obj.id = obj.id || obj.name.en;
          return obj;
        });
        var data = $.map(data, function (obj) {
          obj.text = obj.text || obj.name.en;
          return obj;
        });
        return {
          results: data,
          pagination: {
            more: (params.page * 30) < data.total_count
          }
        };
      }
    },
  });
});
</script>
@endpush
