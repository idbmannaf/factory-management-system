<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{asset('prt/css/w3.css')}}">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <link rel="stylesheet" href="{{asset('prt/css/theme.css')}}">

        {{-- <!-- Vendor CSS -->
		<link rel="stylesheet" href="{{asset('prt/vendor/bootstrap/css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('prt/vendor/fontawesome-free/css/all.min.css')}}">
		<link rel="stylesheet" href="{{asset('prt/vendor/animate/animate.min.css')}}">
		<link rel="stylesheet" href="{{asset('prt/vendor/simple-line-icons/css/simple-line-icons.min.css')}}">
        <link rel="stylesheet" href="{{asset('prt/vendor/owl.carousel/assets/owl.carousel.min.css')}}">
		<link rel="stylesheet" href="{{asset('prt/vendor/owl.carousel/assets/owl.theme.default.min.css')}}">
		<link rel="stylesheet" href="{{asset('prt/vendor/magnific-popup/magnific-popup.min.css')}}">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{asset('prt/css/theme.css')}}">
		<link rel="stylesheet" href="{{asset('prt/css/theme-elements.css')}}">
		<link rel="stylesheet" href="{{asset('prt/css/theme-blog.css')}}">
		<link rel="stylesheet" href="{{asset('prt/css/theme-shop.css')}}">

		<!-- Current Page CSS -->
		<link rel="stylesheet" href="{{asset('prt/vendor/rs-plugin/css/settings.css')}}">
		<link rel="stylesheet" href="{{asset('prt/vendor/rs-plugin/css/layers.css')}}">
		<link rel="stylesheet" href="{{asset('prt/vendor/rs-plugin/css/navigation.css')}}">
		<link rel="stylesheet" href="{{asset('prt/vendor/circle-flip-slideshow/css/component.css')}}">


		<!-- Demo CSS -->


		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{asset('prt/css/skins/default.css')}}">

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{asset('prt/css/custom.css')}}">

		<!-- Head Libs -->
        <script src="{{asset('prt/vendor/modernizr/modernizr.min.js')}}"></script> --}}
        @stack('css')
    </head>

    <body>
        <div id="app">
            {{-- @include('layouts.header') --}}

            <main class="">
                <div class="card p-0 m-0">
                    <div class="card-header text-8 px-5" style="background-color: #38B749">
                        <a class="text-white" href="/" style="text-decoration: none">
							<img class="w3-round-large" style="max-width: 80px; max-height:80px" src="{{ asset('img/dhpl.jpg') }}" alt="">
                            DHPL Factory
						</a>
                    </div>
					<div class=" py-4" style="background-color: #283291 ">

					</div>
                @yield('content')
                </div>
            </main>
            <footer id="">
                <div class="container">
                    <div class="text-center">
                        <span>© Copyright 2021. All Rights Reserved.</span>
                        <span> | </span>
                        <span class="">Developed by Multisoft</span>
                    </div>
                </div>
            </footer>
            {{-- @include('layouts.footer') --}}
        </div>

		{{-- <!-- Vendor -->
		<script src="{{asset('prt/vendor/jquery/jquery.min.js')}}"></script>
		<script src="{{asset('prt/vendor/jquery.appear/jquery.appear.min.js')}}"></script>
		<script src="{{asset('prt/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
		<script src="{{asset('prt/vendor/jquery.cookie/jquery.cookie.min.js')}}"></script>
		<script src="{{asset('prt/vendor/popper/umd/popper.min.js')}}"></script>
		<script src="{{asset('prt/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('prt/vendor/common/common.min.js')}}"></script>
		<script src="{{asset('prt/vendor/jquery.validation/jquery.validate.min.js')}}"></script>
		<script src="{{asset('prt/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
		<script src="{{asset('prt/vendor/jquery.gmap/jquery.gmap.min.js')}}"></script>
		<script src="{{asset('prt/vendor/jquery.lazyload/jquery.lazyload.min.js')}}"></script>
		<script src="{{asset('prt/vendor/isotope/jquery.isotope.min.js')}}"></script>
		<script src="{{asset('prt/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
		<script src="{{asset('prt/vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
		<script src="{{asset('prt/vendor/vide/jquery.vide.min.js')}}"></script>
		<script src="{{asset('prt/vendor/vivus/vivus.min.js')}}"></script>

		<!-- Theme Base, Components and Settings -->
		<script src="{{asset('prt/js/theme.js')}}"></script>

		<!-- Current Page Vendor and Views -->
		<script src="{{asset('prt/vendor/rs-plugin/js/jquery.themepunch.tools.min.js')}}"></script>
		<script src="{{asset('prt/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>
		<script src="{{asset('prt/vendor/circle-flip-slideshow/js/jquery.flipshow.min.js')}}"></script>
		<script src="{{asset('prt/js/views/view.home.js')}}"></script>

		<!-- Theme Custom -->
		<script src="{{asset('prt/js/custom.js')}}"></script>

		<!-- Theme Initialization Files -->
		<script src="{{asset('prt/js/theme.init.js')}}"></script> --}}
        @stack('js')
    </body>
    </html>
