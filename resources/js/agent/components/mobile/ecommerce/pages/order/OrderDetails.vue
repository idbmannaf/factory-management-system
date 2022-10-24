<template>
    <div>
        <div class="card">
            <div class="card-header h4 w3-deep-orange">
                Order # {{ orderId }} <template v-if="order.order_status == 'pending'">
                Edit
            </template>
            </div>
            <div class="card-body" v-if="order">
                <div class="h6">
                    Placed at: {{ order.created_at | date }}
                </div>
                <div class="h6">
                    Amount: &#2547;{{ order.total_price }}
                    <!--                  Amount: &#2547;{{ order.total_collection_amount }}-->
                </div>
                <div class="h6">
                    Collected Amount: &#2547;{{ order.total_collection_amount }}
                </div>

                <div class="h6">
                    Total Items: {{ order.items.length }}
                </div>
                <div class="h6">
                    <b>Order For:</b> <br>
                    Mobile: {{ order.mobile }} <br>
                    Source: {{ order.order_for_source ? order.order_for_source.name.en : '' }} <br>

                </div>
                <div class="h6">
                    Status : <span class="badge badge-primary">{{ order.order_status }}</span>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header h6 w3-blue">

                Order Items
                <template v-if="order.order_status == 'pending'">
                Edit
            </template>
            </div>
            <div class="card-body" v-if="order">
                <div class="table-responsive">
                    <table class="table table-bordered" style="white-space: nowrap">
                        <tr>
                            <th>Product #</th>
                            <template v-if="order.order_status == 'pending'">
                                <th>Action</th>
                            </template>
                            <th>Name</th>
                            <th>Unit</th>
                            <th>Bonus Qty</th>
                            <th>Qty.</th>
                            <th>Total Qty</th>
                            <th>Price</th>
                            <th>Total Price</th>
                        </tr>
                        <tr v-for="(item, index) in order.items" :key="index">
                            <td>{{ item.product_id }}</td>
                            <template v-if="order.order_status == 'pending'">
                                <td>
                                    <span v-on:click="deleteOrderItem(item.id)" class="text-danger" >Delete</span>
                                </td>
                            </template>
                            <td>{{ item.product_name.en }}</td>
                            <td>{{ item.product.unit_value }} {{ item.product.unit }}</td>
                            <td>{{ item.bonus }}</td>
                            <template v-if="order.order_status == 'pending'">
                                <td>
                                    <div class="input-group input-spinner float-right" style="width: auth !important;">
<!--                                        <div class="input-group-prepend">-->
<!--                                            <button class="btn btn-primary btn-sm" v-on:click="decrementQuantity()"-->
<!--                                                    type="button" :disabled="quantity <= 1"><i class="fa fa-minus"></i>-->
<!--                                            </button>-->
<!--                                        </div>-->

                                        <input type="number" class="form-control" min="1"
                                               @change="updateQuanitity($event,item.id,order.order_for_source.id)"  @keyup="updateQuanitity($event,item.id,order.order_for_source.id)" data-url="data-url"
                                               :value="parseFloat(item.total_quantity)"> <br>
<!--                                        <div class="input-group-append">-->
<!--                                            <button class="btn btn-primary btn-sm" v-on:click="incrementQuantity()"-->
<!--                                                    type="button"><i class="fa fa-plus"></i></button>-->
<!--                                        </div>-->
                                    </div>
                                </td>
                            </template>
                            <template v-else>
                                <td>{{ item.total_quantity }}</td>
                            </template>

                            <td>{{ ((Number(item.total_quantity)) + (Number(item.bonus))) }}</td>
                            <td>{{ item.collection_amount / item.total_quantity }}</td>
                            <td>{{ item.collection_amount }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div v-if="order != null">
            <order-shipment
                v-if="order.order_status == 'shipped' || order.order_status == 'delivered'  || order.order_status == 'collected'"
                :orderId="orderId" :agent="agent"></order-shipment>

        </div>
    </div>
</template>

<script>
export default {
    props: ['agent', 'orderId'],
    data() {
        return {
            order: null,
            quanity: 1,
            message:'',
        }
    },
    created() {
        this.getOrderDetails()

    },
    methods: {
        getOrderDetails() {
            axios.get(window.location.origin + `/api/agent/${this.agent}/ecommerce/order/${this.orderId}/details`).then(res => {
                if (res.status == 200) {
                    this.order = res.data
                } else {
                    console.log(res.data)
                }
            })
        },
        deleteOrderItem(orderItemId) {
            if(confirm("Do you really want to delete?")){
                axios.get(window.location.origin + `/api/agent/${this.agent}/order/${this.orderId}/item/${orderItemId}/delete`).then(res => {

                    if (res.status == 200) {
                        this.getOrderDetails();
                    } else {
                        console.log(res.data)
                    }
                })
            }

        },
        updateQuanitity(e,item_id,source_id) {
            var qty = e.target.value;
            if (qty < 1){
                e.target.value= 1;
                return;
            }
            axios.get(window.location.origin + `/api/agent/${this.agent}/order/${this.orderId}/item/${item_id}/update/qty/${qty}/source/${source_id}`).then(res => {

                if (res.status == 200) {
                    this.getOrderDetails();
                } else {
                    console.log(res.data)
                }
             });


        },

    },
}
</script>

<style>

</style>
