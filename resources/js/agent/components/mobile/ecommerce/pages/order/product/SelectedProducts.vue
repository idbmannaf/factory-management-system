<template>
    <div class="card">
    <!-- <div class="row">
        <div class="col">
        </div>
        <div class="col">
            Name
        </div>
        <div>
            Quantity
        </div>
    </div> -->
        <div class="border-bottom" v-for="(product, index) in products" :key="index">
            <ecom-order-selected-product-item :product="product" :index="index" :key="product.id" @removeItem="removeItem($event)"
            :tab="tab" :agent="agent" :shop="shop" @upQuanity="quantity($event, index)" @minusPrice="minusPrice($event)">
            </ecom-order-selected-product-item>
        </div>
        <div>
            <div class="text-center h5 pt-2">
                Total Price: &#2547;{{parseFloat(totalOrderPrice).toFixed(2)}}
            </div>
        </div>
        <!-- <div class="border rounded">
            <div class="px-3 h5">Select Order for shop</div>
            <select-source :agent="agent"></select-source>
        </div> -->
        <div>
        </div>
        <div class="text-center padding-around">
            <button class="btn btn-primary btn-sm" :disabled="totalPrice < 1 || !selectedSource" @click="placeOrder()"><i class="fas fa-box"></i> Place order</button>
        </div>

    </div>
</template>
<script>
import eventBus from './../../../../../../event-bus'
export default {
    props: [
        'products',
        'totalPrice',
        'tab',
        'agent',
        'shop',
    ],
    data() {
        return {
            selectedProducts: [],
            selectedUser: null,
            sourceList: [],
            selectedSource: null,
            newSource: false,
            totalOrderPrice: 0,
            shopAmount:0,
            totalPricing:0
        }
    },
    mounted() {
        eventBus.$on('selectSource', (data)=>{
            this.selectedUser = data.user
            this.setSelectedUser()
        });
        eventBus.$on('newUserForm',(data)=>{
            this.activeNewUserForm()
        });
        eventBus.$on('newUserAdded',(data)=>{
            this.selectedUser = data
            this.setSelectedUser()
        });
        eventBus.$on('selectNewSource',(data)=>{
            this.selectNewSource(data)
        });
        eventBus.$on(`selectedProductUpdateTab${this.tab}`,(data)=>{
            this.selectedProducts = data.selectedProducts
        });
    },
    created() {

        this.selectedSource = this.shop
    },
    methods: {
        removeItem(i){
            this.$emit('removeItem', i)
            if (this.products.length == 1) {
                this.totalOrderPrice = 0
            }
        },
        placeOrder(){
            axios.post(window.location.origin+`/api/agent/${this.agent}/ecommerce/order/place`, {'products': this.selectedProducts, 'source': this.selectedSource}).then(res => {
                if (res.status == 200){
                    this.$swal({
                        title: 'Success!',
                        text: 'Order is placed successfully!',
                        icon: 'success',
                        confirmButtonText: 'Ok',
                    });
                    this.$router.push({name: 'agent.ecommerce.order.list'})
                }
            })
        },
        setSelectedUser(){
            this.sourceList = []
            if(this.selectedUser){
                axios.get(window.location.origin+`/api/agent/${this.agent}/ecommerce/product/owner/${this.selectedUser.id}/sources/get`).then(res=>{
                    if (res.data.length > 0) {
                        this.sourceList = res.data
                    }
                })
            }
        },
        activeNewUserForm(){
            this.selectedUser = null
            this.selectedSource = null
        },
        selectNewSource(source){
            this.sourceList.push(source)
            this.selectedSource = source.id
            this.newSource = !this.newSource
        },
        quantity(qty, index){
            console.log("index is: "+index);
            this.products[index].order_quantity = qty
            this.calculateTotalPrice()
        },
        calculateTotalPrice(){

            let amount = 0
            this.products.forEach(pd=>{
                let qty = pd.order_quantity ?? pd.min_order_quantity
                amount += parseFloat(pd.shopPrice * qty)
                console.log( pd.sale_price);
                // axios.get(window.location.origin+`/api/agent/${this.agent}/ecommerce/shop/${this.shop}/product/${pd.id}/amount`).then((res,test)=>{
                //     if (res.status == 200) {
                //         console.log(res.data.data)
                //     }
                // });
                // console.log(qty)
                // amount += parseFloat( (string) (this.shopAmount*qty));
                // console.log(this.shopAmount);

            }
            )
            this.totalOrderPrice = amount
        },
        getShopAmount(productId = 0){
            axios.get(window.location.origin+`/api/agent/${this.agent}/ecommerce/shop/${this.shop}/product/${productId}/amount`).then((res,test)=>{
                if (res.status == 200) {
                    this.shopAmount = res.data
                }
            });
        }
    },
}
</script>
