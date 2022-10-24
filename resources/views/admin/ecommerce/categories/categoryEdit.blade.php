@extends('admin.layouts.adminMaster')

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />    
@endpush

@section('content')
  @include('admin.categories.parts.categoryEdit')
@endsection


@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js">
</script>

<script type="text/javascript">
    $(function () {

        var jsondata = [
                       { "id": "ajson1", "parent": "#", "text": "Simple root node" },
                       { "id": "ajson2", "parent": "#", "text": "Root node 2" },
                       { "id": "ajson3", "parent": "ajson2", "text": "Child 1" },
                       { "id": "ajson4", "parent": "ajson2", "text": "Child 2" },
        ];

        createJSTree(jsondata);
    });

    function createJSTree(jsondata) {            
        $('#SimpleJSTree').jstree({
            "core": {
                "check_callback": true,
                'data': jsondata
            },
            "plugins": ["contextmenu", "search"],
            "search": {
                "case_sensitive": false,
                "show_only_matches": true
            }
        });
        
    }
    $(document).ready(function () {
            $(".search-input").keyup(function () {
                var searchString = $(this).val();
                $('#SimpleJSTree').jstree('search', searchString);
            });
        });
</script>
@endpush
