@extends('admin.layouts.adminMaster')

@push('css')
<style>

</style>
@endpush

@section('content')
  @include('admin.categories.parts.categoriesAll')
@endsection


@push('js')
<script>
	$(function(){
		$(document).on('click', '.btn-cat-edit', function(e){
    e.preventDefault();
    var that = $(this),
    url = that.attr('href'),
    table = that.closest('.table-cat');
        // alert(url);
        $.ajax({
          url: url,
          type: 'POST',
          dataType: 'json',
        })
        .done(function(response) {
         table.empty().append(response);
       })
        .fail(function() {
          alert("error");
        });
      });

    $(document).on('submit','.form-cat-update',function(s){
    s.preventDefault();
    var form = $(this),
    url = form.attr('action'),
    type = form.attr('method'),
    alldata = new FormData( this ),
    table = form.closest('table');
    $.ajax({
      url: url,
      type: type,
        // dataType: 'json',
        data: alldata,
        // mimeType:"multipart/form-data",
        contentType: false,
        cache: false,
        processData:false,

      }).done(function(response) {
        table.empty().append(response);
      })
      .fail(function() {
        alert("error");
      });
    });


    $(document).on('click', '.btn-cat-delete', function(e){
    e.preventDefault();
    var that = $(this),
    url = that.attr('href'),
    table = that.closest('.card-panel');
        // alert(url);
        $.ajax({
          url: url,
          type: 'POST',
          dataType: 'json',
        })
        .done(function(response) {
         if(response.success)
         {
          table.remove();
         }
       })
        .fail(function() {
          alert("error");
        });
      });

    $(document).on('click', '.btn-subcat-delete', function(e){
    e.preventDefault();
    var that = $(this),
    url = that.attr('href'),
    table = that.closest('tr');
        // alert(url);
        $.ajax({
          url: url,
          type: 'POST',
          dataType: 'json',
        })
        .done(function(response) {
         if(response.success)
         {
          table.remove();
         }
       })
        .fail(function() {
          alert("error");
        });
      });



    $( "#sortablePanel" ).sortable({
      connectWith: ".connectedSortable",
      distance: 5,
    delay: 300,
    opacity: 0.6,
    cursor: 'move',
        update : function () {
          var order = $('#sortablePanel').sortable('toArray'),
            url = $("#sortablePanel").attr('data-url');
            $.ajax({
            url: url,
            type: 'Post',
            cache: false,
            dataType: 'json',
            data: {sorted_data:order},
            success: function(response)
            {
              if(response.success == true)
              {

              }
              else
              {
                alert('fail');
              }
            },
            error: function(){}
          }); //ajax


      }
    }).disableSelection();


    $(document).on('click', '.subcat-new-toggle', function(e)
    {
      e.preventDefault();

      var that = $( this );
      that.closest('.card-body').find('.table-subcat-new').toggle();
    });


    $(document).on('keyup', '.input-subcat-new', function(e){
      e.preventDefault();
      if(e.key === 'Enter')
      {
        var that = $( this );
        url = that.attr('data-url'),
      val = that.val();

      urls = url + '?name=' + val;

      // alert(urls);

    $.ajax({
      url:urls,
      type: 'GET',
        // dataType: 'json',
        // mimeType:"multipart/form-data",
        // contentType: false,
        // cache: false,
        // processData:false,

      }).done(function(response)
      {
        // table.empty().append(response);
        that.closest('.card-body').find('.subcat-area').empty().append(response);
         that.val('').focus();
      })
      .fail(function() {
        alert("error");
      });
      }
    });

    $(document).on('click', '.btn-subcat-submit', function(e)
    {
      e.preventDefault();

      var that = $( this ),
      url = that.closest('td').find('input').attr('data-url'),
      val = that.closest('td').find('input').val();

      urls = url + '?name=' + val;

      // alert(urls);

    $.ajax({
      url:urls,
      type: 'GET',
        // dataType: 'json',
        // mimeType:"multipart/form-data",
        // contentType: false,
        // cache: false,
        // processData:false,

      }).done(function(response)
      {
        // table.empty().append(response);
        that.closest('.card-body').find('.subcat-area').empty().append(response);
        that.closest('td').find('input').val('').focus();
      })
      .fail(function() {
        alert("error");
      });

    });

	});
</script>
@endpush
