<template>
    <div>
        <nav class="nav-bottom">
            <span v-on:click="isActive = 'home'">
                <router-link class="nav-link" :class="{active : isActive == 'home'}" on:click="isActive = 'home'" :to="{ name: 'ecommerce.home'}">
                    <i class="icon fa fa-home"></i><span class="text">Home</span>
                </router-link>
            </span>
            
            <span v-on:click="isActive = 'shop'">
                <router-link class="nav-link"  :class="{active : isActive == 'shop'}" on:click="isActive = 'shop'" :to="{ name: 'ecommerce.shop'}">
                    <i class="icon fa fa-box"></i><span class="text">Shop</span>
                </router-link>
            </span>

            <span v-on:click="isActive = 'category'">
                <router-link class="nav-link"  :class="{active : isActive == 'category'}" on:click="isActive = 'category'" :to="{ name: 'ecommerce.categories'}">
                    <i class="icon fa fa-th"></i><span class="text">Category</span>
                </router-link>
            </span>

            <span v-on:click="isActive = 'cart'">
                <router-link class="nav-link" :class="{active : isActive == 'cart'}"  :to="{ name: 'ecommerce.carts'}">
                <i class="icon fa fa-shopping-cart"></i><span class="text">Cart</span>
                </router-link>
            </span>

            <span v-on:click="isActive = 'profile'" v-if="login">
                <router-link class="nav-link"  :class="{active : isActive == 'profile'}" on:click="isActive = 'profile'" :to="{ name: 'ecommerce.profile'}">
                    <i class="icon fa fa-user"></i><span class="text">Profile</span>
                </router-link>
            </span>
            <span v-on:click="isActive = 'profile'" v-else>
                <a class="nav-link" href="/login">
                    <i class="icon fa fa-user"></i><span class="text">Profile</span>
                </a>
            </span>
        </nav> <!-- nav-bottom -->
    </div>
</template>

<script>
import eventBus from './../../../../event-bus'
export default {
    props : [
        'activeMenu'
    ],
    data() {
        return {
            isActive: this.activeMenu,
            login: false,
            user: {},
        }
    },
    created() {
        this.checkLogin()
    },
    methods: {
        buttonActive(){
            console.log('button')
        },
        checkLogin(){
            axios.get(window.location.origin+`/api/check-login`).then(res=>{
                this.login = res.data.login
                if (res.data.user) {
                    this.user = res.data.user
                }
                eventBus.$emit('checkLogin', res.data)
            })
        },
    },
}
</script>