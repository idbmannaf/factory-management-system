@if($cat->subcats()->first())
<table class="table table-condensed table-subcat">
  <tbody>
    
@foreach($cat->subcats as $subcat)

  @include('admin.categories.ajax.subcatTr')

@endforeach
  </tbody>
</table>
@endif