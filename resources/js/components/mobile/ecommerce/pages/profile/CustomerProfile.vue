<template>
    <div>
        <section class="padding-x pb-3 bg-primary text-white">
            <figure class="icontext align-items-center mr-4" style="max-width: 300px;">
                <img class="icon icon-md rounded-circle" :src="pp">
                <figcaption class="text">
                    <p class="h5 title">{{ user.name }}</p>
                    <p class="text-white-50">{{ user.email }}</p>
                    <p class="text-white-50">{{ user.mobile }}</p>
                </figcaption>
            </figure>
        </section>

        <section class="padding-around">
            <ul class="row">
                <li class="col-4">
                    <a href="#" class="btn-card-icontop btn">
                        <span class="icon"> <i class="fa fa-heart"></i> </span>
                        <small class="text text-center"> Wishlist </small>
                    </a>
                </li>
                <li class="col-4">
                    <a href="#" class="btn-card-icontop btn">
                        <span class="icon"> <i class="fa fa-shopping-basket"></i> </span>
                        <small class="text text-center"> Purchases</small>
                    </a>
                </li>
                <li class="col-4">
                    <a href="#" class="btn-card-icontop btn">
                        <span class="icon"> <i class="fa fa-wallet"></i> </span>
                        <small class="text text-center"> Wallet</small>
                    </a>
                </li>
            </ul>
        </section>  

        <hr class="divider">

        <ecommerce-customer-orders></ecommerce-customer-orders>

        <hr class="divider"> 

        <ecommerce-seller-shop></ecommerce-seller-shop>

        <hr class="divider"> 
        <section class="padding-top">
            <h5 class="title-section padding-x">Account</h5>
            <nav class="nav-list">
                <a class="btn-list" href="#">
                    <i class="icon-control fa fa-chevron-right"></i>
                    <span class="text">Notifications</span>
                </a>
                <router-link class="btn-list" :to="{name: 'ecommerce.profile.settings'}">
                    <i class="icon-control fa fa-chevron-right"></i>
                    <span class="text">Settings</span>
                </router-link>
                <a class="btn-list" href="#"> 
                    <i class="icon-control fa fa-chevron-right"></i>
                    <span class="text">Support</span>
                </a>
            </nav>
        </section> 

        <hr class="divider"> 
        <section class="padding-top">
        <h5 class="title-section padding-x">Personal</h5>
        <nav class="nav-list">
            <router-link class="btn-list" :to="{ name: 'ecommerce.profile.edit' }">
                <i class="icon-action fa fa-pen"></i>
                <small class="title">Name</small>
                <span class="text">{{ user.name }}</span>
            </router-link>
            <router-link class="btn-list" :to="{ name: 'ecommerce.profile.edit' }">
                <i class="icon-action fa fa-pen"></i>
                <small class="title">Email</small>
                <span class="text">{{ user.email }}</span>
            </router-link>
            <router-link class="btn-list" :to="{ name: 'ecommerce.profile.edit' }">
                <i class="icon-action fa fa-pen"></i>
                <small class="title">Mobile</small>
                <span class="text">{{ user.mobile }}</span>
            </router-link>
        </nav>
        </section>
        
        <bottom-back-button></bottom-back-button>

    </div>
</template>

<script>
import eventBus from './../../../../../event-bus'
export default {
    data() {
        return {
            login: false,
            user: null,
            pp: ' ',
        }
    },
    created() {
        axios.get(window.location.origin+`/api/check-login`).then(res=>{
			this.login = res.data.login
			if (res.data.user) {
				this.user = res.data.user
				this.pp = this.user.img_name ?? ' '
			}
		})
    },
}
</script>