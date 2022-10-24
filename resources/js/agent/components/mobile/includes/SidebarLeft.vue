<template>
<div>
	<i class="screen-overlay"></i>
    <aside class="offcanvas" id="sidebar_left">
	<div class="card-body bg-primary- w3-green">
		<button class="btn-close close text-white">&times;</button>
		<!-- <img :src="webLogo" class="img-sm rounded-circle" alt=""> -->
		<img v-bind:src="sr.user.img_name" class="img-sm rounded-circle" alt="">
		<h6 class="text-white mt-3 mb-0">SR: {{ sr.name.en }}!</h6>
		<p>Balance: &#2547; {{ sr.current_income }}</p>
	</div>
	<nav class="nav-sidebar my-1">
		<router-link class="btn-close" v-if="loggedIn" :to="{name: 'agent.ecommerce.home'}">
			<i class="fa fa-home"></i> Home
		</router-link>
		<!-- <router-link class="btn-close" v-if="loggedIn" :to="{name: 'agent.ecom.user.list'}">
			<i class="fas fa-users"></i>
			Amar listed Customers
		</router-link> -->
		<router-link class="btn-close" v-if="loggedIn" :to="{name: 'agent.ecom.source.list'}">
			<i class="fas fa-industry"></i>
			Shops
		</router-link>
		<router-link class="btn-close" v-if="loggedIn" :to="{name: 'agent.ecommerce.order.list'}">
			<i class="fa fa-cube"></i>
			Orders
		</router-link>
		<router-link class="btn-close" v-if="loggedIn" :to="{name: 'agent.ecom.return.list'}">
			<i class="fas fa-truck-loading"></i>
			Returns
		</router-link>
		<!-- <router-link class="btn-close" v-if="loggedIn" :to="{name: 'agent.ecommerce.product.list'}">
			<i class="fa fa-th"></i> Products
		</router-link> -->
		<router-link class="btn-close" v-if="loggedIn" :to="{name: 'agent.ecom.collection.list'}">
			<i class="fas fa-money-check-alt"></i>
			Collections
		</router-link>
		<router-link class="btn-close" v-if="loggedIn" :to="{name: 'agent.ecom.salary.list'}">
			<i class="fas fa-chart-line"></i>
			Salary Statement
		</router-link>
	</nav>
	<!-- <hr>
	<nav class="nav-sidebar my-0 py-0">
		<a href="/agent"><i class="fa fa-arrow-left" aria-hidden="true"></i> Switch SR</a>
	</nav> -->
	<hr>
	<nav class="nav-sidebar">
		<a href="#"> <i class="fa fa-phone"></i> {{ sr.user.mobile }}</a>
		<a href="#"> <i class="fa fa-envelope"></i> {{ sr.user.name }}</a>
		<a href="#"> <i class="fa fa-map-marker"></i> {{ sr.name.en }}</a>
	
		<a @click="logout()" v-if="loggedIn"> <i class="fas fa-power-off"></i> Logout</a>
	</nav>
</aside>
</div>
</template>

<script>
export default {
	props: ['agent'],
	data() {
		return {
			sr: {
				name: {
					en : 'SR',
				},
				user: {
					name: 'Name',
					mobile: '01XXXXXXXXX',
				},
				current_income: 0,
			},
			webLogo: window.location.origin+'/img/dhpl.jpg',
			token: null,
			loggedIn: true,
		}
	},
	created() {
		this.token = document.querySelector('meta[name=csrf-token]').content;
		this.getSrInfo();
		this.trackLocation();
	},
	mounted() {
		window.setInterval(() => {
			this.trackLocation()
		}, 60000)
	},
	methods: {
		logout(){
			axios.post(window.location.origin+'/logout').then(res => {
				this.loggedIn = false
				this.$router.push({ name: 'agent.login'});
				window.location.reload();
			})
		},
		thisAgent(){
			var path = window.location.pathname
			var splitPath = path.split("/")
			return splitPath[2]
		},
		getSrInfo(){
			let thisAgentID = this.thisAgent()
			axios.get(window.location.origin+`/api/agent/${thisAgentID}/dashboard/info`).then(res => {
				if (res.status == 200) {
					this.sr = res.data.agent
				}
			});
		}, 
		trackLocation(){
			let thisAgentID = this.thisAgent()
			this.$getLocation({})
			.then(coordinates => {

				axios.post(window.location.origin+`/api/agent/${thisAgentID}/set/location`,{
					lat : coordinates.lat,
					lng : coordinates.lng,
				}).then(res=>{
				})
			})
			.catch(err => {
				// alert('Please clear browser data and Allow Location to Run this App! Otherwise it will logout.')
				// this.logout()
			});
		},
	}
}
</script>