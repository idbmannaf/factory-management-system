<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">

    <title>{{ env('APP_NAME') }} @yield('title')</title>

    <link rel="stylesheet" href="{{asset('assets/sweetalert2/dist/sweetalert2.css')}}">

    <!-- SweetAlert2 -->
    {{-- <link rel="stylesheet" href="{{ asset('cp/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}"> --}}

    <script src="{{asset('assets/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('cp/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('cp/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('cp/dist/css/adminlte.min.css') }}">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('cp/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <!-- Google Font: Source Sans Pro -->
    <link href="{{ asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700') }}" rel="stylesheet">



    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/w3.css') }}">


    <meta name="csrf-token" content="{{ csrf_token() }}">


    <style>

        .nav-legacy.nav-sidebar .nav-item>.nav-link {

            border-top: 1px solid #dfdfdf !important;
        }




    </style>


    @stack('css')




</head>
<body class="hold-transition sidebar-mini layout-fixed text-sm ">

<div class="wrapper">


@include('accounts.layouts.accountHeader')
@include('accounts.layouts.accountLeftsidebar')



<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        @yield('content')

    </div>


{{--    @include('admin.layouts.adminFooter')--}}

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('cp/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('cp/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- overlayScrollbars -->
<script src="{{ asset('cp/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('cp/dist/js/adminlte.min.js') }}"></script>


@stack('js')

<script>
    $(function(){
        $(document).on('click', '.bt-cash', function(e){
            e.preventDefault();
            var that = $( this );
            $(".bt-pay-type").removeClass('active');
            that.addClass('active');
            $(".payment_type").val('cash');
            $(".fg-bank").hide(200);
            $(".fg-cheque").hide(200);
        });

        $(document).on('click', '.bt-bank', function(e){
            e.preventDefault();
            var that = $( this );
            $(".bt-pay-type").removeClass('active');
            that.addClass('active');
            $(".payment_type").val('bank');
            $(".fg-cheque").hide(200);
            $(".fg-bank").show(200);
        });

        $(document).on('click', '.bt-mobile-bank', function(e){
            e.preventDefault();
            var that = $( this );
            $(".bt-pay-type").removeClass('active');
            that.addClass('active');
            $(".payment_type").val('mobile bank');
            $(".fg-cheque").hide(200);
            $(".fg-bank").show(200);
        });

        $(document).on('click', '.bt-cheque', function(e){
            e.preventDefault();
            var that = $( this );
            $(".bt-pay-type").removeClass('active');
            that.addClass('active');
            $(".payment_type").val('cheque');
            $(".fg-bank").hide(200);
            $(".fg-cheque").show(200);
        });

    });
</script>


</body>
</html>
