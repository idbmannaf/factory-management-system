<template>
<div>
	<i class="screen-overlay"></i>
    <aside class="offcanvas" id="sidebar_left">
	<div class="card-body bg-primary">
		<button class="btn-close close text-white">&times;</button>
		<img src="mobile/images/avatars/1.jpg" class="img-sm rounded-circle" alt="">
		<h6 class="text-white mt-3 mb-0">Welcome dealer!</h6>
	</div>
	<nav class="nav-sidebar my-1">
		<slot></slot>
	</nav>
	<hr>
	<nav class="nav-sidebar my-0 py-0">
		<router-link class="btn-close" :to="{name: 'dealer.agents'}">
			<i class="fa fa-users"></i> Agents
		</router-link>
		<router-link class="btn-close" :to="{name: 'dealer.markets'}">
			<i class="fas fa-store-alt"></i> Markets
		</router-link>
		<a href="/dealer"><i class="fa fa-arrow-left" aria-hidden="true"></i> Dealer Dashboard</a>
	</nav>
	<hr>
	<nav class="nav-sidebar">
		<a href="#"> <i class="fa fa-phone"></i> +99812345678</a>
		<a href="#"> <i class="fa fa-envelope"></i> info@somename.uz</a>
		<a href="#"> <i class="fa fa-map-marker"></i> Tashkent city</a>
		<a href=""> <i class="fas fa-power-off"></i> Logout</a>
	</nav>
</aside>
</div>
</template>