<template>
    <div>
        <div class="padding-around">
            <div class="card">
                <div class="card-header w3-deep-orange">
                    Place new order
                </div>
            </div>
        <div>

        <!-- <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" v-for="(tab, index) in tabs" :key="tab.id">
                <a class="nav-link" :class="{ active : index == activeTab}" id="home-tab" data-toggle="tab" role="tab" aria-controls="home" aria-selected="true" @click="activeTab = index">
                    Order {{tab.id}}
                </a>
            </li>
            <li class="float-right">
                <a v-on:click="addTab()" class="nav-link mx-1 mt-1 py-1 px-2 w3-border rounded"><i class="fa fa-plus"></i></a>
            </li>
        </ul> -->
        <div class="padding-around" v-if="sourceInfo">
            <h5>Order For</h5>
            Shop Name: {{ sourceInfo.name.en }} <br>
            Owner Name: {{ sourceInfo.owner_name }} <br>
            Contact: {{ sourceInfo.mobile }} <br>
        </div>
        <div class="tab-content" id="myTabContent">
            <div v-for="(tabdata, index) in tabs" :key="tabdata.id" class="tab-pane fade show" :class="{active : index == activeTab}" :id="'orderSheet'+tabdata.id" role="tabpanel" aria-labelledby="home-tab">
                <div class="card">
                    <div class="card-header w3-blue">
                        Order Sheet
                    </div>
                    <div class="card-body">
                        <ecom-order-create-products v-if="sourceInfo" :key="tabdata.id"  v-on:selectProductShow="selectProductShow($event, index)"
                        :tab="tabdata.id" :shop="sourceInfo.id" :agent="agent">
                        </ecom-order-create-products>
                        
                    </div>
                </div>
                <hr class="divider">
                    <div class="card">
                    <div class="card-header w3-green ordersheet-header">
                        <a @click="toggle()">
                            <i class="fas fa-shopping-cart"></i> Selected Products ({{ tabdata.selectedProducts.length }})
                        <i class="fas fa-chevron-circle-down"></i><button v-if="tabs.length > 1" class="btn btn-danger p-0 px-2 float-right" v-on:click="removeSheet(tabdata.id, index)">x</button>
                        </a>
                    </div>
                    <div class="collapse show" id="collapseExample">
                        <div class="card-body">
                            <ecom-order-selected-products v-if="sourceInfo" :key="tabdata.id" :products="tabdata.selectedProducts" :totalPrice="tabdata.totalPrice" @removeItem="removeItem($event, index, tabdata.id)" :tab="tabdata.id"  :shop="sourceInfo.id" :agent="agent">
                            </ecom-order-selected-products>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
.ordersheet-header{
    border-bottom: 15px solid white;
}
</style>
<script>
import eventBus from './../../../../../event-bus'
export default {
    props: ['agent', 'shop'],
    data() {
        return {
            tabs: [],
            activeTab: 0,
            selectedProducts: [],
            update: false,
            show: false,
            sourceInfo: null,
        }
    },
    created() {
        this.getSourceInfo()
        this.tabs = [
            {
                id: 1,
                selectedProducts: [],
                totalPrice: 0,
            },
        ];
        $('.collapse').collapse('show')
    },
    methods: {
        selectProductShow(products, tabindex){
            this.tabs[tabindex].selectedProducts = products
            this.tabs[tabindex].totalPrice = 0,
            products.forEach(item =>{
                (this.tabs[tabindex].totalPrice) += parseFloat(item.sale_price)
            })
            eventBus.$emit(`selectedProductUpdateTab${this.tabs[tabindex].id}`, this.tabs[tabindex])
        },
        addTab(){
            let lasTab = this.tabs[this.tabs.length - 1]
            let newTab = {
                id: lasTab.id+1,
                selectedProducts:[],
                totalPrice: 0,
            }
            this.tabs.push(newTab)
            this.activeTab = this.tabs.length-1
            // this.$forceUpdate();
        },
        removeSheet(tabId, tabindex){
            if (tabindex > 0) {
                this.activeTab = tabindex-1
            }else{
                this.activeTab = tabindex
            }
            let filtered = this.tabs.filter(item => item.id != tabId )
            this.tabs = filtered
            eventBus.$emit(`selectedProductUpdateTab${this.tabs[this.activeTab].id}`, this.tabs[this.activeTab])
        },
        removeItem(i, tabindex, tab){
            eventBus.$emit('removeSelectedItem',{tab: tab, productId:i})
        },
        toggle(){
            $('.collapse').collapse('toggle')
        },
        getSourceInfo(){
            if (this.shop) {
                axios.get(window.location.origin+`/api/agent/${this.agent}/ecommerce/shop/${this.shop}/details`).then(res=>{
                    if (res.status == 200) {
                        this.sourceInfo = res.data
                    }else{
                        this.$router.push({ name: 'agent.ecom.source.list'});
                    }
                });
            }else{
                this.$router.push({ name: 'agent.ecom.source.list'});
            }
        },
    },
}
</script>
