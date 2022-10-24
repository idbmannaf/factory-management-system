<template>
    <div>
        <section class="padding-around" v-if="order">
            <!-- <div class="steps-wizard clearfix mb-3">
                <div class="step done" data-step-num="1">
                    <div class="step-icon"> 1 </div>
                    <span class="step-title">Shipping</span>
                </div>
                <div class="step done" data-step-num="2">
                    <div class="step-icon"> 2 </div>
                    <span class="step-title">Payment</span>
                </div>
                <div class="step current" data-step-num="3">
                    <div class="step-icon"> 3 </div>
                    <span class="step-title">Confirm</span>
                </div>
            </div> -->
            
            <div class="h2 bold w3-green text-center">
                Order Payment
            </div>

            <article class="box mb-3 bg-light">
                <dl class="dlist-align text-muted">
                    <dt>Order #:</dt>
                    <dd class="text-right"> </dd>
                </dl>
                <dl class="dlist-align text-muted">
                    <dt>Total price:</dt>
                    <dd class="text-right">&#2547; {{ order.total_price }}</dd>
                </dl>
                <dl class="dlist-align text-muted">
                    <dt>Shipping:</dt>
                    <dd class="text-right">Free</dd>
                </dl>
                <dl class="dlist-align">
                    <dt><strong> <i class="icon fa text-muted fa-money-bill"></i> Total:</strong></dt>
                    <dd class="text-right"><strong>&#2547; {{ order.total_price }}</strong></dd>
                </dl>
                <p class="d-block  icontext"> <i class="icon fa text-muted fa-truck"></i> <span><b>Delivery: </b> 4-5 days</span></p>
            </article>

            <!-- <p class="alert alert-success"> <i class="fa fa-lock"></i> Some secureity information</p> -->
                
                <div class="form-group">
                <label for="username">Bank Name or Service Name</label>
                <input type="text" class="form-control" :class="{'is-invalid' : errors.bank_name}" v-model="payment.bank_name" placeholder="Ex. Janata Bank" required>
                </div> <!-- form-group.// -->
                
                <div class="form-group">
                <label for="cardNumber">Account No. / Mobile Number</label>
                <div class="input-group">
                    <input type="text" class="form-control" :class="{'is-invalid' : errors.account_number}" v-model="payment.account_number" placeholder="">
                </div> <!-- input-group.// -->
                </div> <!-- form-group.// -->

                <div class="form-group">
                <label for="cardNumber">Cheque no. / Transaction Id</label>
                <div class="input-group">
                    <input type="text" class="form-control" :class="{'is-invalid' : errors.cheque_number}" v-model="payment.cheque_number" placeholder="">
                </div> <!-- input-group.// -->
                </div> <!-- form-group.// -->

                <div class="form-group">
                <label for="cardNumber">Paid amount</label>
                <div class="input-group">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            &#2547; 
                        </span>
                    </div>
                    <input type="number" step="0.01" class="form-control" :class="{'is-invalid' : errors.amount}" v-model="payment.amount" placeholder="" required>
                </div> <!-- input-group.// -->
                </div> <!-- form-group.// -->

                <div class="form-group">
                <label for="cardNumber">Note</label>
                <div class="input-group">
                    <textarea type="text" class="form-control" :class="{'is-invalid' : errors.note}" v-model="payment.note" placeholder=""></textarea>
 
                </div> <!-- input-group.// -->
                </div> <!-- form-group.// -->
                
                <!-- <div class="row">
                    <div class="col flex-grow-0">
                        <div class="form-group">
                            <label><span class="hidden-xs">Expiration</span> </label>
                            <div class="form-inline" style="min-width: 220px">
                                <select class="form-control" style="width:100px">
                                <option>MM</option>
                                <option>01 - Janiary</option>
                                <option>02 - February</option>
                                <option>03 - February</option>
                                </select>
                                <span style="width:20px; text-align: center"> / </span>
                                <select class="form-control" style="width:100px">
                                <option>YY</option>
                                <option>2018</option>
                                <option>2019</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>CVV <i class="fa fa-question-circle"></i></label>
                            <input class="form-control" required="" type="text">
                        </div> 
                    </div>
                </div>  -->
                
                <button class="btn btn-primary btn-block" v-if="payment.bank_name && payment.cheque_number && payment.account_number && payment.amount" @click="nextStep()"><i class="fa fa-check"></i> Confirm </button>
                <button class="btn btn-primary btn-block" disabled v-else><i class="fa fa-check"></i> Confirm </button>

                
            <br><br>

        </section> <!-- section-products  .// -->
    </div>
</template>
<script>
export default {
    props: ['orderId'],
    data() {
        return {
            order: null,
            payment: {
                'bank_name' : null,
                'account_number' : null,
                'cheque_number' : null,
                'amount' : null,
                'note' : null,
            },
            isPaid: false,
            errors: {},
        }
    },
    created() {
        if (!this.orderId) {
            this.$router.push({'name': 'ecommerce.carts'})
        }else{
            this.getOrderInfo()
        }
    },
    methods: {
        getOrderInfo(){
            axios.get(window.location.origin+`/api/order/${this.orderId}/details`).then(res=>{
                if (res.status == 200) {
                    this.order = res.data
                    if (res.data.payment.payment_status == 'paid') {
                        this.isPaid = true
                    }
                }
            })
        },
        nextStep(){
        axios.post(window.location.origin+`/api/my-order/${this.order.id}/make-payment`, this.payment).then(res=>{
            if (res.status ==  200) {
                this.$router.push({ name: 'customer.payment.successful',params:{ 'order' : this.order }})
            }else{
                this.errors = res.data
            }
        })
        },
    },
}
</script>