<template>
	<agent-sidebar-left>
		<router-link class="btn-close" :to="{name: 'agent.ecommerce.home'}">
			<i class="fa fa-home"></i> Home
		</router-link>
		<router-link class="btn-close" :to="{name: 'agent.ecom.user.list'}">
			<i class="fas fa-users"></i>
			Amar listed Customers
		</router-link>
		<router-link class="btn-close" :to="{name: 'agent.ecom.source.list'}">
			<i class="fas fa-industry"></i>
			Amar listed Shops
		</router-link>
		<router-link class="btn-close" :to="{name: 'agent.ecommerce.order.list'}">
			<i class="fa fa-cube"></i>
			Amar listed Orders
		</router-link>
		<router-link class="btn-close" :to="{name: 'agent.ecom.return.list'}">
			<i class="fas fa-truck-loading"></i>
			Amar Order Returns
		</router-link>
		<!-- <router-link class="btn-close" :to="{name: 'agent.ecommerce.product.list'}">
			<i class="fa fa-th"></i> Products
		</router-link> -->
		<router-link class="btn-close" :to="{name: 'agent.ecom.collection.list'}">
			<i class="fas fa-money-check-alt"></i>
			Amar listed Collections
		</router-link>
		<!-- <router-link class="btn-close" :to="{name: 'agent.ecommerce.home'}">
			<i class="fa fa-info-circle"></i> About us
		</router-link> -->
		<!-- <router-link class="btn-close" :to="{name: 'agent.ecommerce.settings'}">
			<i class="fa fa-cog"></i> Settings
		</router-link> -->
	</agent-sidebar-left>
</template>
