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
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Action</th>
                                <th>Status</th>
                                <th>Order For</th>
                                <th>Placed on</th>
                                <th>Price</th>
                                <th>Items</th>
                            </tr>
                        </thead>
                        <tbody>
                               <ecommerce-order-list-item v-for="(order, index) in orders" :key="index" :order="order" :agent="agent"></ecommerce-order-list-item> 
                        </tbody>
                    </table>
                </div>
                <nav>
                    <ul class="pagination table-responsive padding-top m-auto" v-if="links.length > 3">
                    <li class="page-item" v-for="(page, index) in links" :key="index" :class="{disabled: !page.url, active: page.active}">
                    <a class="page-link" v-on:click="getOrders(page.url)" tabindex="-1">
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
                    <!-- <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                    </li> -->
                </ul>
            </nav>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['agent'],
    data() {
        return {
            orders: [],
            links: [],
        }
    },
    created() {
        this.getOrders()
    },
    methods: {
        getOrders(dataUrl = null){
            axios.get(dataUrl ? dataUrl : window.location.origin+`/api/agent/${this.agent}/ecommerce/orders`).then(res=>{
                if (res.status == 200) {
                    this.orders = res.data.data
                    this.links = res.data.links
                
                }
            });
        },
    },
}
</script>