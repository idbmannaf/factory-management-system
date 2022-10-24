<template>
  <div class="card">
    <div class="card-header">
    Shipments for this order 
    </div>
    <div class="card-body">
    <div class="table-responsive">
    <table class="table table-bordered">
    <thead>
    <tr>
    <th>#</th>
    <th>Shipped at</th>
    <th>Items Qty.</th>
    <th></th>
    </tr>
    </thead>
    <tbody>
    <order-shipment-item :agent="agent" :orderId="orderId" v-for="(shipment, index) in shipments" :key="index" :shipment="shipment"></order-shipment-item>
    </tbody>
    </table>
    </div>
    </div>
  </div>
</template>

<script>
export default {
    props:['agent', 'orderId'],
    data() {
        return {
            shipments: [],
        }
    },
    created() {
        this.getShipments()
    },
    methods: {
        getShipments(){
            axios.get(window.location.origin+`/api/agent/${this.agent}/ecommerce/order/${this.orderId}/shipments`).then(res => {
                if (res.status == 200) {
                    this.shipments = res.data
                }else{
                    console.log(res.data)
                }
            })
        }
    },
}
</script>

<style>

</style>
