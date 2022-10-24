@extends('admin.layouts.adminMaster')
@section('title', 'Admin List')

@push('css')

    <link href="{{ asset('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css') }}">


@endpush

@section('content')

    @include('admin.roles.parts.allproduction')

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
                            obj.id = obj.id || obj.email;
                            return obj;
                        });
                        var data = $.map(data, function (obj) {
                            obj.text = obj.text || obj.email;
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
    <script>
        function exportTasks(_this) {
           let _url = $(_this).data('href');
           window.location.href = _url;
        }
     </script>
@endpush
