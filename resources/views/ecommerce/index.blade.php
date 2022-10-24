@extends('layouts.app')
@push('css')

@endpush
@section('content')
{{-- <div>
@include('layouts.slider')

<div class="home-intro bg-primary" id="home-intro">
    <div class="container">

        <div class="row align-items-center">
            <div class="col-lg-8">
                <p>
                    The fastest way to grow your business with the leader in <span class="highlighted-word">Technology</span>
                    <span>Check out our options and features included.</span>
                </p>
            </div>
            <div class="col-lg-4">
                <div class="get-started text-left text-lg-right">
                    <a href="#" class="btn btn-dark btn-lg text-3 font-weight-semibold px-4 py-3">Get Started Now</a>
                    <div class="learn-more">or <a href="index.html">learn more.</a></div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="container">

    <div class="row text-center pt-3">
        <div class="col-md-10 mx-md-auto">
            <h1 class="word-rotator slide font-weight-bold text-8 mb-3 appear-animation" data-appear-animation="fadeInUpShorter">
                <span>Porto is </span>
                <span class="word-rotator-words bg-dark">
                    <b class="is-visible">incredibly</b>
                    <b>especially</b>
                    <b>extremely</b>
                </span>
                <span> beautiful and fully responsive.</span>
            </h1>
            <p class="lead appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="300">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce elementum, nulla vel pellentesque consequat, ante nulla hendrerit arcu, ac tincidunt mauris lacus sed leo.
            </p>
        </div>
    </div>

</div>

<div class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200">
    <div class="home-concept mt-5">
        <div class="container">

            <div class="row text-center">
                <span class="sun"></span>
                <span class="cloud"></span>
                <div class="col-lg-2 ml-lg-auto">
                    <div class="process-image">
                        <img src="img/home/home-concept-item-1.png" alt="" />
                        <strong>Strategy</strong>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="process-image process-image-on-middle">
                        <img src="img/home/home-concept-item-2.png" alt="" />
                        <strong>Planning</strong>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="process-image">
                        <img src="img/home/home-concept-item-3.png" alt="" />
                        <strong>Build</strong>
                    </div>
                </div>
                <div class="col-lg-4 ml-lg-auto">
                    <div class="project-image">
                        <div id="fcSlideshow" class="fc-slideshow">
                            <ul class="fc-slides">
                                <li><a href="portfolio-single-wide-slider.html"><img class="img-responsive" src="img/projects/project-home-1.jpg" alt="" /></a></li>
                                <li><a href="portfolio-single-wide-slider.html"><img class="img-responsive" src="img/projects/project-home-2.jpg" alt="" /></a></li>
                                <li><a href="portfolio-single-wide-slider.html"><img class="img-responsive" src="img/projects/project-home-3.jpg" alt="" /></a></li>
                            </ul>
                        </div>
                        <strong class="our-work">Our Work</strong>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div> --}}


    <div class="card-body- text-center- d-none d-md-block" style="height: 85vh; background: url({{ asset('img/slides/slide2.jpg') }}) no-repeat top right; background-size: 100%">
        <div class="container pt-4 text-white w3-xxlarge pt-4" style="line-height: 34pt">
            Welcome to, <br>
            {{ env('APP_FULL_NAME') ?? 'Dhaka Homoeo Hall Pvt. Ltd.' }}
        </div>
        <div class="container pt-5">
            <a class="btn btn-secondary border-none text-5 w3-orange w3-text-white" href="{{ route('login') }}">Login</a>
        </div>
        {{-- <img class="m-auto" style="max-width: 100%" src="{{ asset('img/slides/slide1.jpg') }}" alt=""> --}}
    </div>
    <div class="card-body- text-center- d-md-none" style="height: 80vh; background: url({{ asset('img/slides/slide1.jpg') }}) no-repeat top right; background-size: 100%">
        <div class="container text-white w3-xxlarge pt-4" style="line-height: 34pt">
            Welcome to, <br>
            {{ env('APP_FULL_NAME') ?? 'Dhaka Homoeo Hall Pvt. Ltd.' }}
        </div>
        <div class="container pt-5">
            <a class="btn btn-secondary text-5 w3-orange w3-text-white" href="{{ route('login') }}">Login</a>
        </div>
        {{-- <img class="m-auto" style="max-width: 100%" src="{{ asset('img/slides/slide1.jpg') }}" alt=""> --}}
    </div>
@endsection
