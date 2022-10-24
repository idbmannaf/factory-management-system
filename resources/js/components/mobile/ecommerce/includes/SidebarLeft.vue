<template>
<div>
	<i class="screen-overlay"></i>
    <aside class="offcanvas" id="sidebar_left">
	<div class="card-body bg-primary">
		<button class="btn-close close text-white">&times;</button>
		<img :src="pp" class="img-sm rounded-circle" alt="">
		<h6 class="text-white mt-3 mb-0">Welcome {{ user.name ? user.name : '' }}!</h6>
	</div>
	<nav class="nav-sidebar">
		<router-link :to="{name: 'ecommerce.home'}"><i class="fa fa-home"></i> Home</router-link>
		<router-link :to="{name: 'ecommerce.categories'}"><i class="fa fa-th"></i> Categories</router-link>
		<router-link :to="{name: 'ecommerce.home'}"><i class="fa fa-info-circle"></i> About us</router-link>
		<router-link :to="{name: 'ecommerce.home'}"><i class="fa fa-building"></i> Company</router-link>
		<router-link :to="{name: 'ecommerce.profile.settings'}"><i class="fa fa-cog"></i> Settings</router-link>
	</nav>
	<hr>
	<nav class="nav-sidebar">
		<a href="#"> <i class="fa fa-phone"></i> +99812345678</a>
		<a href="#"> <i class="fa fa-envelope"></i> info@somename.uz</a>
		<a href="#"> <i class="fa fa-map-marker"></i> Tashkent city</a>
		<a @click="logout()" v-if="login"> <i class="fas fa-power-off"></i> Logout</a>
		<a href="/login" v-else> <i class="fas fa-sign-in-alt"></i> Login</a>
	</nav>

</aside>
</div>
</template>
<script>
import eventBus from './../../../../event-bus'
export default {
	data() {
		return {
			login: false,
			user: {},
			pp: ' ',
		}
	},
	created() {
		eventBus.$on('checkLogin', (data)=>{
			this.login = data.login
			if (data.user) {
				this.user = data.user
				this.pp = this.user.img_name ?? ' '
			}
		})
	},
	methods: {
		logout(){
			axios.post(window.location.origin+`/logout`).then(res=>{
				location.reload()
			})
		}
	},
}
</script>