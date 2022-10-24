@extends('admin.layouts.adminMaster')

@section('title')
@if ($type == 'depo')
GM
@elseif($type == 'distributor')
Distributor
@elseif($type == 'dealer')
SMO
@elseif($type == 'agent')
SR
@else
Role
@endif 
Update
@endsection

@push('css')

<!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('cp/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('cp/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- Bootstrap4 Duallistbox -->

@endpush



@section('content')

@include('admin.roles.parts.roleEditPart')
	 
@endsection


@push('js')
 
 <!-- Select2 -->
<script src="{{ asset('cp/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
  $(document).ready(function () {

  $('.select2').select2({theme: 'bootstrap4'});

  $('.step2-select').select2({
    theme: 'bootstrap4',
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
          obj.id = obj.id || obj.id;
          return obj;
        });
        var data = $.map(data, function (obj) {
          obj.text = obj.mobile || obj.email;
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