<template>
  <div>
      <div class="padding-around">
          <div class="card">
              <div class="card-header w3-blue h3">
                  My Orders
              </div>
              <div class="card-body">
                  <div class="table-responsive" v-if="orders.length > 0">
                      <table class="table table-sm table-bordered">
                          <thead>
                              <tr>
                                  <th>Order #</th>
                                  <th>Price</th>
                                  <th>Ordered Date</th>
                                  <th>Status</th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr v-for="(order, index) in orders" :key="index">
                                  <td>{{ order.id }}</td>
                                  <td>&#2547; {{ order.total_price }}</td>
                                  <td>{{ order.created_at | date }}</td>
                                  <td>{{ order.order_status }}</td>
                                  <td>
                                      <router-link :to="{name: 'ecom.myOrder.details', params:{'orderId': order.id}}">manage</router-link>
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
                  <nav v-if="links">
                        <ul class="pagination table-responsive padding-top m-auto" v-if="links.length > 3">
                            <li class="page-item" v-for="(page, index) in links" :key="index" :class="{disabled: !page.url, active: page.active}">
                            <a class="page-link" v-on:click="getMyOrders(page.url)" tabindex="-1">
                                <span class="d-flex" v-if="page.label == 'Next &raquo;'">
                                    Next <i class="fa fa-arrow-right"></i>
                                </span>
                                <span class="d-flex" v-else-if="page.label == '&laquo; Previous'">
                                    <i class="fa fa-arrow-left"></i> Previous
                                </span>
                                <span v-else>
                                    {{ page.label }}
                                </span>
                                </a>
                            </li>
                      </ul>
                  </nav>
              </div>
          </div>
          <bottom-back-button></bottom-back-button>
      </div>
      
  </div>
</template>

<script>
export default {
    data() {
        return {
            orders: [],
            links: null,
        }
    },
    created() {
        this.getMyOrders()
    },
    methods: {
        getMyOrders(dataUrl = null){
            axios.get(dataUrl ? dataUrl : window.location.origin+`/api/my-orders`).then(res=>{
                this.orders = res.data.data
                this.links = res.data.links
            })
        },
    },
}
</script>

<style>

</style>