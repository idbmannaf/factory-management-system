@extends('admin.layouts.adminMaster')
@section('title', 'Connecting Park')

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />    
@endpush

@section('content')

    <div class="jsTreeUrl" data-create-url="{{route('admin.updateCategoriesByJsTree','create_node')}}"
    data-rename-url="{{route('admin.updateCategoriesByJsTree','rename_node')}}" 
    data-delete-url="{{route('admin.updateCategoriesByJsTree','delete_node')}}" 
    data-copy-url="{{route('admin.updateCategoriesByJsTree','copy_node')}}" 
    data-select-url="{{route('admin.updateCategoriesByJsTree','select_node')}}" 
    data-cut-url="{{route('admin.updateCategoriesByJsTree','cut_node')}}" 
    data-dnd-url="{{route('admin.updateCategoriesByJsTree','move_node')}}"></div>

  @include('admin.ecommerce.categories.parts.productCategories')
  
@endsection


@push('js')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js">
</script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js">
</script>

<script type="text/javascript">
    $(function () {

        var cats = <?php echo json_encode($categories); ?>;

        createJSTree(cats);
    });

    function createJSTree(cats) {            
        $('#SimpleJSTree').jstree({
            "core": {
                "check_callback": true,
                'data': cats,
                strings : {
                    'New node': 'New Category'
                }
            },
            "plugins": ["contextmenu", "search","dnd"],
            "search": {
                "case_sensitive": false,
                "show_only_matches": true
            },
        }).on('create_node.jstree', function (e, data) {
            var url = $(".jsTreeUrl").attr("data-create-url");
            $.get(url, { 'parent_id' : data.node.parent, 'position' : data.position, 'text' : 'New Category' })
                .done(function (d) {
                    data.instance.set_id(data.node, d.data.id);
                })
                .fail(function () {
                    data.instance.refresh();
                });
            }).on('rename_node.jstree', function (e, data) {

            var url = $(".jsTreeUrl").attr("data-rename-url");

                $.get(url, { 'id' : data.node.id, 'text' : data.text})
                    .fail(function () {
                        data.instance.refresh();
                    });
                }).on('delete_node.jstree', function (e, data) {
                    var url = $(".jsTreeUrl").attr("data-delete-url");
                    $.get(url, { 'id' : data.node.id })
                        .fail(function () {
                            data.instance.refresh();
                        });
                    }).on('move_node.jstree', function (e, data) {
   
                    var url = $(".jsTreeUrl").attr("data-dnd-url");
                    $.get(url, { 'id' : data.node.id,'position' : data.position,'parent_id':data.node.parent,'text': data.node.text })
                        .fail(function () {
                            data.instance.refresh();
                        });
                    }).on('copy_node.jstree', function (e, data) {
                    var url = $(".jsTreeUrl").attr("data-copy-url");
                    $.get(url, { 'id' : data.node.id,'position' : data.position,'parent_id':data.node.parent })
                        .done(function (d) {
                            data.instance.set_id(data.node, d.data.id);
                        })
                        .fail(function () {
                            data.instance.refresh();
                        });
                    }).on("select_node.jstree", function (e, data) {
                           
                        var url = $(".jsTreeUrl").attr("data-select-url");

                        $.get(url, { 'id' : data.node.id })
                        .done(function (d) {
                            $(".data-ajax-container").empty().append(d.page);
                        })
                        .fail(function () {
                            data.instance.refresh();
                        });

             });
        
    }
    $(document).ready(function () {
        $(".search-input").keyup(function () {
            var searchString = $(this).val();
            $('#SimpleJSTree').jstree('search', searchString);
        });
    });

    $(function(){
  $(document).on('submit','.form-data-submit',function(s){
      s.preventDefault();
      var form = $(this),
      // box = $(this).closest(".box"),
      url = form.attr('action'),
      type = form.attr('method'),
      alldata = new FormData( this );
      // alert(alldata);
      $(".help-block").remove();
      $.ajax({
        url: url,
        type: type,
        // dataType: 'json',
        data: alldata,
        // mimeType:"multipart/form-data",
        contentType: false,
        cache: false,
        processData:false,
        // beforeSend: function()
        // {
        // },
        // complete: function()
        // {
        // },
      }).done(function(response){
        if(response.success == true)
        {
          // $('.all-data-area').prepend(response.page);
          // $(".d-d").text(response.d);
          // $(".success-js-alert").show();
          $(".data-ajax-container").empty().append(response.page);

          if(response.success){
            swal({
            text: response.sessionError,
            title: "Great!",
            timer: 8000,
            type: "success",
            showConfirmButton: true,
            confirmButtonText: "Close",
            confirmButtonColor: "#000033"
            });
          }
        }
        else
        {
          $.each( response.errors, function( key, value ) {
            $("[name~='"+key+"']").after( "<span class='help-block text-red'><strong>"+value+"</strong></span>" );
          });
          if(response.sessionError){
            swal({
            text: response.sessionError,
            title: "Opps!",
            timer: 8000,
            type: "error",
            showConfirmButton: true,
            confirmButtonText: "Close",
            confirmButtonColor: "#ff0000"
            });
          }
        }
      }).fail(function(){
        alert('error');
      });
    });

    ///////////////

    $(document).on('click','.btn-cat-create-ajax', function(e){
        // e.preventDefault();

            var that = $(this);
           var url = that.attr('data-url');


        $('#SimpleJSTree').jstree("create_node", null, null, "first", function (node) {
        this.edit(node);

         
    });

    // //    alert(url);

    //    $.ajax({
    //     url: url,
    //     type: "GET",
    //     // dataType: 'json',
    //     // data: alldata,
    //     // mimeType:"multipart/form-data",
    //     contentType: false,
    //     cache: false,
    //     processData:false,
 
    //   }).done(function(response){

    //     $("#SimpleJSTree ul").prepend(response.page);
       
         
    //   }).fail(function(){
    //     alert('error');
    //   });

       

    });
});
</script>
@endpush