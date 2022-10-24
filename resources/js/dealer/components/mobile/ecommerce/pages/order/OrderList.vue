<template>
    <div class="padding-top">
        <div class="card">
            <div class="card-header">
                <div class="h3">
                    Orders  
                    <!-- <router-link class="btn btn-primary btn-sm h6 float-right" :to="{name: 'agent.ecommerce.order.create'}">
                        <i class="fa fa-plus"></i> new
                    </router-link> -->
                </div>
            </div>  
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>a</th>
                                <th>b</th>
                            </tr>
                        </thead>
                        <tbody>
                               <ecommerce-order-list-item v-for="(order, index) in orders" :key="index" :order="order"></ecommerce-order-list-item> 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            orders: [],
        }
    },
    created() {
        this.getOrders()
    },
    methods: {
        getOrders(){
            this.orders = [
                {
                    name: 'Order 1',
                    price: 1231,
                },
                {
                    name: 'Order 2',
                    price: 1231,
                },
                {
                    name: 'Order 3',
                    price: 1231,
                },
            ];
        },
    },
}
</script>