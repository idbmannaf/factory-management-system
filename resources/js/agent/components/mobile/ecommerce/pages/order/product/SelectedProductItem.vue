<template>
    <div class="row">
        <div class="px-2">
            {{ product.name.en }}
        </div>
        <div class="col">
            &#2547; {{ calculatedPrice() }}
        </div>
        <div class="col float-right d-flex justify-content-between">
                <div class="input-group input-spinner float-right">
                        <div class="input-group-prepend">
                        <button class="btn btn-primary btn-sm" v-on:click="decrementQuantity()" type="button" :disabled="quantity <= product.min_order_quantity"> <i class="fa fa-minus"></i> </button>
                        </div>
                        <input type="number" class="form-control" :class="{'is-invalid w3-red': error.quantity || quantity < product.min_order_quantity}" v-model="quantity" @keypress="updatePrice()">
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-sm" v-on:click="incrementQuantity()" type="button"> <i class="fa fa-plus"></i> </button>
                        </div>
                </div>
            </div>
            <button class="btn btn-danger btn-xs py-0 px-1" @click="removeItem()"><i class="fa fa-trash"></i></button>
        </div>
</template>
<script>
import eventBus from './../../../../../../event-bus'
export default {
    props: [
        'agent',
        'product',
        'index',
        'tab',
        'shop',
    ],
    data() {
        return {
            quantity: 1,
            price: 0,
            error: [],
            shopAmount: 0,

            calculated_price: 0
        }
    },
    watch: {

    },
    created() {
        this.calculatedPrice()
        this.getShopAmount()
        this.quantity = this.product.min_order_quantity
        this.price = parseFloat(this.product.sale_price*this.product.min_order_quantity)
    },
    methods: {
        removeItem(){
            this.$emit('removeItem', this.product.id)
        },
        incrementQuantity(){
            this.quantity++
            this.$emit('upQuanity', this.quantity)
        },
        decrementQuantity(){
            this.quantity--
            this.$emit('upQuanity', this.quantity)
        },
        updatePrice(){
            console.log('a')
            // this.price = this.product.sale_price*this.quantity
        },
        calculatedPrice(){
            this.$emit('upQuanity', this.quantity)
            return parseFloat(this.shopAmount*this.quantity).toFixed(2)
        },
        getShopAmount(){
            axios.get(window.location.origin+`/api/agent/${this.agent}/ecommerce/shop/${this.shop}/product/${this.product.id}/amount`).then(res=>{
                if (res.status == 200) {
                    this.shopAmount = res.data.data
                }
            });
        }
    },
}
</script>
