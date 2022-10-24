<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="cache-control" content="max-age=604800" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">

<title>SR App</title>

<link href="{{ asset('mobile/images/favicon.ico') }}" rel="shortcut icon" type="image/x-icon">

<link rel="stylesheet" href="{{ asset('css/agent/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/w3.css') }}">
<!-- jQuery -->
<script src="{{ asset('mobile/js/jquery-2.0.0.min.js') }}" type="text/javascript"></script>

<!-- Bootstrap4 files-->
<script src="{{ asset('mobile/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
<link href="{{ asset('mobile/css/bootstrap.css') }}" rel="stylesheet" type="text/css"/>

<!-- Font awesome 5 -->
<link href="{{ asset('mobile/fonts/fontawesome/css/all.min.css') }}" type="text/css" rel="stylesheet">

<!-- custom style -->
<link href="{{ asset('mobile/css/mobile.css') }}" rel="stylesheet" type="text/css"/>


<link href="{{ asset('mobile/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('mobile/css/select2-bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
<!-- custom javascript -->
<script src="{{ asset('mobile/js/script.js') }}" type="text/javascript"></script>
<script type="text/javascript">
/// some script

// jquery ready start
$(document).ready(function() {
	// jQuery code

}); 
// jquery end
</script>

<link rel="stylesheet" href="{{ asset('css/agent/app.css') }}">

{{-- <script src="{{ asset('js/agent/app.js') }}" defer></script> --}}

</head>
<body>

<div id="app">

	{{-- <agent-app></agent-app> --}}
    <i class="screen-overlay"></i>

<aside class="offcanvas" id="sidebar_left">
	<div class="card-body bg-primary- w3-green">
		<button class="btn-close close text-white">&times;</button>
		<img src="{{ asset('img/dhpl.jpg') }}" class="img-sm rounded-circle" alt="">
		{{-- <h6 class="text-white mt-3 mb-0">Welcome User!</h6> --}}
	</div>
	<hr>
	<nav class="nav-sidebar">
        <a href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();" class="dropdown-item">
              <i class="fas fa-power-off"></i> {{ __('logout') }}
              {{-- <span class="float-right text-muted text-sm"></span> --}}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
            </form>
	</nav>
</aside>

    <!-- =============== screen-wrap =============== -->
<div class="screen-wrap">

    <header class="app-header fixed-top bg-primary- w3-green">
        <button class="btn-header" type="button" data-trigger="#sidebar_left"><i class="fa fa-bars"></i></button>
        <h5 class="title-header m-auto"> SR Dashboard </h5>
        <div class="header-right">  </div>
    </header> <!-- section-header.// -->
    
    <main class="app-content padding-around" style="padding-top:100px">
    
    <div class="card w3-red">
        <div class="card-body w3-text-white">
            <b>Warning!</b> Your account is inactive. Please contact with the Administration.
        </div>
    </div>
    
    </main>
    
    </div> 
    <!-- =============== screen-wrap end.// =============== -->

</div>


<script src="{{ asset('mobile/js/select2.full.min.js') }}" defer></script>
<script>
  $(document).ready(function(){
    $('.select2').select2({
		maximumSelectionLength: 3,
		theme: 'bootstrap4',
	});
  });
</script>
</body>
</html>