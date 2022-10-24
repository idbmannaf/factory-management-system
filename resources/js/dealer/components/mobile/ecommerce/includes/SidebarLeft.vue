<template>
	<dealer-sidebar-left>
		<router-link class="btn-close" :to="{name: 'dealer.ecommerce.home'}">
			<i class="fa fa-home"></i> Home
		</router-link>
		<router-link class="btn-close" :to="{name: 'dealer.ecommerce.product.list'}">
			<i class="fa fa-th"></i> Products
		</router-link>
		<router-link class="btn-close" :to="{name: 'dealer.ecom.incoming.order.list'}">
			<i class="fas fa-truck-loading"></i> 
			Incoming Orders
		</router-link>
		<router-link class="btn-close" :to="{name: 'dealer.ecommerce.order.list'}">
			<i class="fa fa-cube"></i>
			Placed Orders
		</router-link>
		<router-link class="btn-close" :to="{name: 'dealer.ecommerce.home'}">
			<i class="fa fa-info-circle"></i> About us
		</router-link>
		<router-link class="btn-close" :to="{name: 'dealer.ecommerce.settings'}">
			<i class="fa fa-cog"></i> Settings
		</router-link>
	</dealer-sidebar-left>
</template>