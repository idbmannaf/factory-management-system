<template>
  <tr>
  <td>
  {{ index }}
  </td>
  <td>{{ shipment.shipped_at | date}}</td>
  <td>
    <table class="table-sm" v-for="(item, index) in shipment.items" :key="index">
      <tr>
        <td>{{ item.product_id }} | {{ item.product_name }}</td>
        <td>{{ item.shipment_quantity }}</td>
      </tr>
    </table>
  </td>
  <td>
    <button class="btn btn-success m-2 btn-sm" v-if="shipment.order_status == 'shipped'" @click="statusCollected()"><i class="fas fa-parachute-box"></i> Collected</button>
    <button class="btn btn-success m-2 btn-sm" v-if="shipment.order_status == 'collected'" @click="statusDelivered()"><i class="fas fa-people-carry"></i> Delivered</button>
  <router-link v-if="shipment.order_status == 'delivered'" class="btn btn-danger m-2 btn-sm" :to="{name: 'agent.ecom.order.shipment.return', params:{agent: agent , orderId:orderId , shipmentId: shipment.id}}"><i class="fas fa-truck-loading"></i> Return</router-link>
  <!-- <button class="btn btn-danger m-2 btn-sm" v-if="shipment.order_status == 'collected' || shipment.order_status == 'delivered'" @click="returnShipment()"><i class="fas fa-truck-loading"></i> Return</button> -->
  </td>
  </tr>
</template>
<style scoped>
</style>
<script>
export default {
props: ['agent', 'orderId', 'shipment', 'index'],
data() {
  return {
  }
},
created() {
// console.log(this.shipment);
},
methods: {
  returnShipment(){

    axios.post(window.location.origin+`/api/agent/${this.agent}/ecommerce/order/${this.orderId}/shipment/${this.shipment.id}/return`).then(res => {
        if (res.status == 200) {
                

                }else{
                    console.log(res.data)
                }
            });
  },
  
  statusCollected(){
      axios.post(window.location.origin+`/api/agent/${this.agent}/ecommerce/order/${this.orderId}/shipment/${this.shipment.id}/collected`).then(res => {
          if (res.status == 200) {
              this.$swal({
            title: 'Success!',
            text: 'Order Status updated successfully!',
            icon: 'success',
            confirmButtonText: 'Ok',
        });

        this.$router.push({ name: 'agent.ecommerce.order.list'})

          }else{
              console.log(res.data)
          }
      })
  },
  statusDelivered(){
      axios.post(window.location.origin+`/api/agent/${this.agent}/ecommerce/order/${this.orderId}/shipment/${this.shipment.id}/delivered`).then(res => {
          if (res.status == 200) {
              this.$swal({
            title: 'Success!',
            text: 'Order Status updated successfully!',
            icon: 'success',
            confirmButtonText: 'Ok',
        });

        this.$router.push({ name: 'agent.ecommerce.order.list'})

          }else{
              console.log(res.data)
          }
      })
  },
},
}
</script>

<style>

</style>
