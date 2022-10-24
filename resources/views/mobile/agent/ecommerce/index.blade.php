<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="cache-control" content="max-age=604800" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">


<title>{{ env('APP_NAME') }}</title>

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

<script src="{{ asset('js/agent/app.js') }}" defer></script>

</head>
<body>

<div id="app">

	<agent-ecommerce-app></agent-ecommerce-app>

</div>


</body>
</html>