<template>
    <div>
        <section class="padding-around">


            <div class="steps-wizard clearfix mb-3">
                <div class="step done" data-step-num="1">
                    <div class="step-icon"> 1 </div>
                    <span class="step-title">Shipping</span>
                </div>
                <div class="step current" data-step-num="2">
                    <div class="step-icon"> 2 </div>
                    <span class="step-title">Payment</span>
                </div>
                <div class="step" data-step-num="3">
                    <div class="step-icon"> 3 </div>
                    <span class="step-title">Confirm</span>
                </div>
            </div>


            <article class="box mb-3 bg-light">
                <dl class="dlist-align text-muted">
                    <dt>Total price:</dt>
                    <dd class="text-right">&#2547; {{ price }}</dd>
                </dl>
                <dl class="dlist-align text-muted">
                    <dt>Shipping:</dt>
                    <dd class="text-right">Free</dd>
                </dl>
                <dl class="dlist-align">
                    <dt><strong> <i class="icon fa text-muted fa-money-bill"></i> Total:</strong></dt>
                    <dd class="text-right"><strong>&#2547; {{ price }}</strong></dd>
                </dl>
                <p class="d-block  icontext"> <i class="icon fa text-muted fa-truck"></i> <span><b>Delivery: </b> 4-5 days</span></p>
            </article>

            <div class="box-selection active">
                <label class="custom-control custom-radio">
                    <input type="radio" v-model="payment_method" value="cash" checked class="custom-control-input">
                    <div class="custom-control-label"> Cash on delivery  <i class="far fa-money-bill-alt float-right fa-2x"></i></div>
                </label>
            </div>

            <div class="box-selection">
                <label class="custom-control custom-radio">
                    <input type="radio" v-model="payment_method" value="bank" class="custom-control-input">
                    <div class="custom-control-label">via Bank <i class="fas fa-university float-right fa-2x"></i> </div>
                </label>
            </div>

            <div class="box-selection">
            <label class="custom-control custom-radio">
                <input type="radio" v-model="payment_method" value="mobile_bank" class="custom-control-input">
                <div class="custom-control-label"> via Mobile Banking <i class="fas fa-mobile-alt float-right fa-2x"></i></div>
            </label>
            </div>
            <div class="box-selection">
            <label class="custom-control custom-radio">
                <input type="radio" v-model="payment_method" value="cheque" class="custom-control-input">
                <div class="custom-control-label"> via Cheque <i class="fas fa-money-check-alt float-right fa-2x"></i></div>
            </label>
            </div>
            <div class="box-selection">
            <label class="custom-control custom-radio">
                <input type="radio" v-model="payment_method" value="online" class="custom-control-input">
                <div class="custom-control-label"> via Online Payment Method <i class="fab fa-cc-visa float-right fa-2x"></i></div>
            </label>
            </div>
            <br>
            <button class="btn btn-primary btn-block" v-if="payment_method" @click="nextStep()"> Continue </button>
            <button class="btn btn-primary btn-block" disabled v-else> Continue </button>
            <!-- <button type="submit" class="btn btn-primary btn-block"> Continue </button> -->


            <br><br>

        </section> <!-- section-products  .// -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            price: 0,
            payment_method: 'cash',
        }
    },
    created() {
        this.getInfo()
    },
    methods: {
        getInfo(){
            axios.get(window.location.origin+`/api/carts/get`).then(res=>{
                // this.carts = res.data.carts
                if (res.data.total_price) {
                    this.price = res.data.total_price
                }else{
                    this.$router.push({ name: 'ecommerce.shop'})
                }
            })
        },
        nextStep(){
            axios.post(window.location.origin+`/api/oder/payment-method`, {'payment_method': this.payment_method}).then(res=>{
                if(res.status == 200){
                        this.$router.push({ name: 'customer.checkout.successful', params:{'order': res.data}})
                    // if (res.data.payment_type == 'cash') {
                    //     this.$router.push({ name: 'customer.checkout.successful'})
                    // }else{
                    //     this.$router.push({ name: 'customer.checkout.step.third'})
                    // }
                }
            })
        },
    },
}
</script>