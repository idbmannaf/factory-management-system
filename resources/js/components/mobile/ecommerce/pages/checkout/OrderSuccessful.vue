<template>
    <div>
        <section class="padding-around" v-if="orderData">
            <article class="text-center mt-4">
            <svg width="116px" height="116px" viewBox="0 0 116 116" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g transform="translate(-122.000000, -113.000000)">
                        <g id="check" transform="translate(122.000000, 113.000000)">
                            <circle  fill="#CEFFCF" cx="58" cy="58" r="58"></circle>
                            <circle  fill="#00D803" cx="58" cy="58" r="44"></circle>
                            <g transform="translate(45.000000, 47.000000)" fill="#FFFFFF">
                                <path d="M8.625,17.325 L2.9375,11.6375 C2.30375,11.00375 1.29625,11.00375 0.6625,11.6375 C0.02875,12.27125 0.02875,13.27875 0.6625,13.9125 L7.47125,20.72125 C8.105,21.355 9.12875,21.355 9.7625,20.72125 L26.9875,3.5125 C27.62125,2.87875 27.62125,1.87125 26.9875,1.2375 C26.35375,0.60375 25.34625,0.60375 24.7125,1.2375 L8.625,17.325 Z"></path>
                            </g>
                        </g>
                    </g>
                </g>
            </svg>
            <br><br>
                <h6>Thanks for purchase</h6>
            </article>
            <article class="box bg-light my-4" v-if="payment">
                Please make the <router-link :to="{name: 'customer.checkout.step.third', params:{'orderId': order.id}}">payment</router-link>
            </article>
            <article class="box bg-light my-4">
                    <b>Order ID:</b> {{ orderData.id }} <br>  
                    <!-- <b>Estimate delivery:</b>  <br> -->
                    <b>Total paid:</b> {{ orderData.total_price }}
            </article>

            <table class="table table-bordered text-left">
                <tr v-for="(item, index) in orderData.items" :key="index">
                    <td width="100"><img :src="item.product.feature_img" class="img-md"></td> <td> <p>{{ item.product.name.en }}</p> X {{ parseInt(item.total_quantity) }} = &#2547; {{ item.total_price }}</td> 
                </tr>
            </table>

            <p class="text-center d-flex">
                <router-link class="btn btn-primary w-100 mx-1" :to="{name: 'ecommerce.shop'}"> <i class="fa fa-arrow-left icon"></i> <span class="text">Shop more</span></router-link>
                <router-link class="btn btn-primary w-100 mx-1" :to="{name: 'ecommerce.profile'}"> <span class="text">Profile</span> <i class="fa fa-arrow-right icon"></i> </router-link>
            </p>
        </section> 
    </div>
</template>
<script>
export default {
    props: ['order'],
    data() {
        return {
            orderData: null,
            payment: false,
        }
    },
    created() {
        if (!this.order) {
            this.$router.push({'name': 'ecommerce.carts'})
        }else{
            this.getOrder()
        }
    },
    methods: {
        getOrder(){
            this.orderData = this.order
            if (this.order.payment.payment_type != 'cash') {
                this.payment = true
            }
            // axios.get(window.location.origin+`/api/oder/latest`).then(res=>{
            //     if (res.data.payment.payment_type != 'cash' && res.data.payment.payment_status == 'pending') {
            //         this.payment = true
            //     }
            // })
        }
    },
}
</script>