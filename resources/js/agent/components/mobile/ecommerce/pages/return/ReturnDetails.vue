<template>
  <div class="padding-around">
      <div class="card">
          <div class="card-header h4 w3-deep-orange" v-if="returnData">
              Return # {{ returnData.id }}
          </div>
          <div class="card-body" v-if="returnData">
              <div class="h6">
                  Placed at: {{ returnData.return_at | date }}
              </div>
              <div class="h6">
                  Amount: &#2547;{{ returnData.total_return_price }}
              </div>
              <div class="h6">
                  Total Items: {{ returnData.items.length }}
              </div>
              <div class="h6">
                  <b>Order For:</b> <br>
                  Mobile: {{ returnData.mobile }} <br>
                  Address: {{ returnData.address }} <br>
              </div>
              <div class="h6">
                Status : <span class="badge badge-primary">{{returnData.return_status}}</span>
              </div>
          </div>
      </div>
      <div class="card">
          <div class="card-header h6 w3-blue">
              Return Items
          </div>
          <div class="card-body" v-if="returnData.items.length">
              <div class="table-responsive">
                  <table class="table table-bordered">
                      <tr>
                          <th>Product #</th>
                          <th>Name</th>
                          <th>Return Qty.</th>
                          <th>Return Type</th>
                          <th>Reason</th>
                      </tr>
                      <tr v-for="(item, index) in returnData.items" :key="index">
                          <td>{{item.product_id}}</td>
                          <td>{{item.product_name}}</td>
                          <td>{{item.return_quantity}}</td>
                          <td>
                             <span v-if="item.return_type == 'product'">Product Replacement</span> 
                             <span v-else>Refund Payment</span> 
                          </td>
                          <td>{{item.return_reason}}</td>
                      </tr>
                  </table>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
export default {
    props: ['agent', 'returnId'],
    data() {
        return {
            returnData: null,
        }
    },
    created() {
        this.getReturnData()
    },
    methods: {
        getReturnData(){
            axios.get(window.location.origin+`/api/agent/${this.agent}/ecommerce/shipment/return/${this.returnId}`).then(res=>{
                
                if (res.status == 200) {
                    this.returnData = res.data
                }
            });
        }
    },
}
</script>

<style>

</style>