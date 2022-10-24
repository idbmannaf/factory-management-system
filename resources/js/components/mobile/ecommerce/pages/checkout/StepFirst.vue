<template>
    <div>
        <section class="padding-around">
            <div class="steps-wizard clearfix mb-3">
                <div class="step current" data-step-num="1">
                    <div class="step-icon"> 1 </div>
                    <span class="step-title">Shipping</span>
                </div>
                <div class="step" data-step-num="2">
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
            <!-- <p class="alert alert-success"> Some message is here!</p> -->

            <div class="form-group">
                <input type="text" class="form-control" placeholder="Name" v-model="buyer.name">
            </div>

            <div class="form-group">
                <input type="email" class="form-control" placeholder="Email" v-model="buyer.email">
            </div>

            <!-- <div class="form-group form-row">
                <div class="col-4">
                <select name="" class="form-control">
                    <option value="1">+1 US</option>
                    <option value="1">+7 Ru</option>
                    <option value="1">+998 Uz</option>
                </select>
                </div>
            <div class="col-8">
            </div>
            </div> -->

            <div class="form-group">
                <input type="number" class="form-control" placeholder="Phone" v-model="buyer.mobile">
            </div>

            <!-- <div class="form-group">
                <select class="custom-select form-control">
                <option selected>Region</option>
                    <option>Arizona</option>
                    <option>Washington</option>
                    <option>New York</option>
                </select>
            </div> -->

            <div class="form-group">
                <textarea type="text" class="form-control" placeholder="Shipping Address" v-model="buyer.address"></textarea>
            </div>

            <!-- <div class="form-group">
                <input type="text" class="form-control" placeholder="Zip code">
            </div> -->


                <!-- <label class="custom-control my-4 custom-checkbox">
                <input type="checkbox" checked="" class="custom-control-input">
                <div class="custom-control-label">Save my address</div>
                </label> -->
                <button class="btn btn-block btn-primary" v-if="buyer.address && buyer.mobile" @click="nextStep()">Save and continue </button>
                <button class="btn btn-block btn-primary" disabled v-else>Save and continue </button>
            <!-- <button type="submit" class="btn btn-block btn-primary"> Save and continue </button> -->

            <br><br>

        </section> <!-- section-products  .// -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            buyer: {
                name: null,
                email: null,
                mobile: null,
                address: null,
            },
            price: 0,
        }
    },
    created() {
        this.getUserInfo()
    },
    methods: {
        getUserInfo(){
            axios.get(window.location.origin+`/api/my-info`).then(res=>{
                this.buyer.name     = res.data.name
                this.buyer.email    = res.data.email
                this.buyer.mobile   = res.data.mobile
            });
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
            axios.post(window.location.origin+`/api/oder/place`, this.buyer).then(res=>{
                if(res.status == 200){
                    this.$router.push({ name: 'customer.checkout.step.second'})
                }
            })
        },
    },
}
</script>