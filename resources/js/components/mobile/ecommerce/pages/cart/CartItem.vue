<template>
    <figure class="itemside item-cart">
        <div class="aside"><img :src="cart.product.feature_img" class="rounded img-md"></div>
        <figcaption class="info align-self-center">
            <router-link :to="{name: 'ecommerce.product', params:{'productId': cart.product.id}}">{{ cart.product.name.en }}</router-link> <br>
            <span class="price"> &#2547; {{cart.product.sale_price}}</span> <small class="text-muted"> / per item</small>
            <div class="row m-0 p-0">
                <div class="col-xs-4">
                    <a href="#" v-on:click="deleteCart()" class="btn-xs btn btn-danger"> <i class="fa fa-trash"></i>   </a>
                </div>
                <div class="col-xs-8">
                    <div class="input-group input-spinner float-right">
                        <div class="input-group-prepend">
                        <button class="btn btn-primary" v-on:click="decrementQuantity()" type="button" :disabled="quantity <= cart.product.min_order_quantity"> <i class="fa fa-minus"></i> </button>
                        </div>
                        <input type="number" class="form-control" :class="{'is-invalid': quantity < cart.product.min_order_quantity}" v-model="quantity" >
                        <div class="input-group-append">
                            <button class="btn btn-primary" v-on:click="incrementQuantity()" type="button"> <i class="fa fa-plus"></i> </button>
                        </div>
                    </div>
                </div>
                <div v-if="quantity < cart.product.min_order_quantity" class="row px-3">
                    Cart quantity should be atleast {{ cart.product.min_order_quantity }}
                </div>
            </div>
        </figcaption>
    </figure>
</template>
<script>
import eventBus from '../../../../../event-bus'
export default {
    props : [
        'cartItem'
    ],
    data() {
        return {
            cart: this.cartItem,
            quantity: this.cartItem.quantity,
        }
    },
    created() {
    },
    methods: {
        updateCart(){
            axios.post(window.location.origin+`/api/cart/add/product/${this.cart.product.id}`, {'quantity': this.quantity}).then(res=>{
                if (res.status == 200) {
                    this.isCarted = true
                    this.quantity = res.data.quantity
                }
            })
        },
        decrementQuantity(){
            this.quantity--;
            this.updateCart()
        },
        incrementQuantity(){
            this.quantity++;
            this.updateCart()
        },
        deleteCart(){
            if (confirm('Are you sure?')) {
                axios.post(window.location.origin+`/api/cart/remove/product/${this.cart.product.id}`)
                // destroy the vue listeners, etc
                this.$destroy();

                // remove the element from the DOM
                this.$el.parentNode.removeChild(this.$el);
                eventBus.$emit('reloadCart')
            }
        },
    },
}
</script>
