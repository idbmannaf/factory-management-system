<template>
    <div>
        <section class="section-products padding-around">
            <div v-for="(cartItem, index) in carts" :key="index">
            <ecommerce-cart-item :key="cartItem.id" :cartItem="cartItem"></ecommerce-cart-item>
            </div>
        </section> <!-- section-products  .// -->

        <hr class="divider">

        <section class="padding-around">
            <dl class="dlist-align text-muted">
                <dt>Total price:</dt>
                <dd class="text-right">&#2547; {{ price }}</dd>
            </dl>
            <dl class="dlist-align text-muted">
                <dt>Shipping:</dt>
                <dd class="text-right">Free</dd>
            </dl>
            <dl class="dlist-align">
                <dt><strong><i class="icon fa text-muted fa-money-bill"></i> Total:</strong></dt>
                <dd class="text-right"><strong>&#2547; {{ price }}</strong></dd>
            </dl>
            <p class="d-block  icontext"> <i class="icon fa text-muted fa-truck"></i> <span><b>Delivery: </b> 4-5 days</span></p>

            <button class="btn btn-primary btn-block" disabled v-if="carts.length < 1" > <span class="text"> Order now </span> <i class="fa fa-chevron-right"></i> </button>
            <button class="btn btn-primary btn-block" v-else @click="nextStep()"> <span class="text"> Order now </span> <i class="fa fa-chevron-right"></i> </button>
<br>
            <router-link class="btn btn-success btn-block" :to="{name: 'ecommerce.shop'}" > <i class="fas fa-cart-arrow-down"></i> <span class="text"> Shop More </span> </router-link>
            <!-- <a href="" class="btn btn-primary btn-block"> <span class="text"> Order now </span> <i class="fa fa-chevron-right"></i></a> -->
        </section>
        <bottom-back-button></bottom-back-button>
    </div>
</template>

<script>
import eventBus from './../../../../../event-bus'
export default {
    data() {
        return {
            carts: [],
            price: null,
        }
    },
    mounted() {
        eventBus.$on('reloadCart',(data)=>{
            this.carts=[]
            this.getCarts()
            })
    },
    created() {
        this.getCarts()
    },
    methods: {
        getCarts(){
            axios.get(window.location.origin+`/api/carts/get`).then(res=>{
                this.carts = res.data.carts
                this.price = res.data.total_price
            })
        },
        nextStep(){
            this.$router.push({ name: 'customer.checkout.step.first'})
        },
    },
}
</script>