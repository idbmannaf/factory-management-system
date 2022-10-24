<template>
  <div>
      <div class="card" v-if="order">
          <div class="card-header h3 w3-blue">
              Order # {{ order.id }}
          </div>
          <div class="card-body">
              <div class="h5">
                  Order Date: <b>{{ order.created_at | date }}</b> <br>
                  Order Status: <b>{{ order.order_status }}</b> <br>
                  No. of Items:  <b>{{ order.items.length }}</b> <br>
                  Order Price: <b> &#2547; {{ order.total_price }}</b> <br>
                  Shipping Charge: <b>Free</b> <br>
                  Payment Status: <b>{{ order.payment.payment_status }}</b> <br>
                  Payment Type: <b>{{ order.payment.payment_type.toUpperCase() }}</b> <br>
              </div>
                <article class="box bg-light my-4" v-if="order.payment.payment_status == 'pending' && order.payment.payment_type != 'cash'">
                    Please make the <router-link :to="{name: 'customer.checkout.step.third', params:{'orderId': order.id}}">payment</router-link>
                </article>

              <div class="py-2">
                <table class="table table-bordered text-left">
                    <tr v-for="(item, index) in order.items" :key="index">
                        <td width="100"><img :src="item.product.feature_img" class="img-md"></td> <td> <p>{{ item.product.name.en }}</p> X {{ parseInt(item.total_quantity) }} = <span class="d-flex">&#2547; {{ item.total_price }}</span></td> 
                    </tr>
                </table>
              </div>
          </div>
          <bottom-back-button></bottom-back-button>
      </div>
  </div>
</template>

<script>
export default {
    props: ['orderId'],
    data() {
        return {
            order: null,
        }
    },
    created() {
        this.getOrderDetails()
    },
    methods: {
        getOrderDetails(){
            axios.get(window.location.origin+`/api/my-order/${this.orderId}`).then(res=>{
                this.order = res.data
            })
        }
    },

}
</script>

<style>

</style>