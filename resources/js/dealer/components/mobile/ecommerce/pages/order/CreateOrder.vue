<template>
    <div>
        <div class="padding-around">
            <div class="card">
                <div class="card-header w3-deep-orange">
                    Place new order
                </div>
            </div>
        <div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" v-for="(tab, index) in tabs" :key="index">
                <a class="nav-link" :class="{ active : index == 0}" id="home-tab" data-toggle="tab" :href="'#orderSheet'+tab.id" role="tab" aria-controls="home" aria-selected="true">
                    Order {{tab.id}}
                </a> 
            </li>
            <li class="float-right">
                <a href="#" v-on:click="addTab()" class="nav-link mx-1 mt-1 py-1 px-2 w3-border rounded"><i class="fa fa-plus"></i></a>
            </li>
        </ul>
        <!-- <div class="card"> // this shloud be used with vuex
            <div class="card-header w3-blue">
                Product List 
            </div>
            <div class="card-body">
                <ecom-order-create-products v-on:selectProductShow="selectProductShow($event)"></ecom-order-create-products>
            </div>
        </div> -->
        <div class="tab-content" id="myTabContent">
            <div v-for="(tabdata, index) in tabs" :key="index" class="tab-pane fade show" :class="{active : index == 0}" :id="'orderSheet'+tabdata.id" role="tabpanel" aria-labelledby="home-tab">
                <div class="card">
                    <div class="card-header w3-blue">
                        Product List | Order Sheet {{ tabdata.id }}
                    </div>
                    <div class="card-body">
                        <ecom-order-create-products v-on:selectProductShow="selectProductShow($event)"></ecom-order-create-products>
                    </div>
                </div>
                <hr class="divider">
                <div class="card">
                    <div class="card-header w3-green">
                        Selected Products | Order Sheet {{ tabdata.id }}
                        <button v-if="tabs.length > 1" class="btn btn-danger p-0 px-2 float-right" v-on:click="removeSheet(tabdata.id)">x</button>
                    </div>
                    <div class="card-body">
                        <ecom-order-selected-products :products="selectedProducts" :totalPrice="totalPrice"></ecom-order-selected-products>
                    </div>
                </div>
            </div>
        </div>

                <!-- <div class="card">
                    <div class="card-body">
                        <ecom-order-create-products v-on:selectProductShow="selectProductShow($event)"></ecom-order-create-products>
                    </div>
                </div>
                <div class="card">
                    <div class="h6">
                        Selected Products
                    </div>
                    <div class="card-body">
                        <ecom-order-selected-products :products="selectedProducts" ></ecom-order-selected-products>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            tabs: [],
            selectedProducts: [],
            totalPrice: 0,
        }
    },
    created() {
        this.tabs = [
            {
                id: 1,
                selectedProducts: [
                    {
                        'id': 1,
                        'name': 'Product 1',
                        'price': '123',
                    },
                    {
                        'id': 2,
                        'name': 'Product 2',
                        'price': '123',
                    },
                    {
                        'id': 3,
                        'name': 'Product 3',
                        'price': '123',
                    },
                    {
                        'id': 4,
                        'name': 'Product 4',
                        'price': '123',
                    },
                ],
            },
            // {
            //     id: 2,
            //     selectedProducts: [
            //         {
            //             'id': 1,
            //             'name': 'Product 1',
            //             'price': '123',
            //         },
            //         {
            //             'id': 4,
            //             'name': 'Product 4',
            //             'price': '123',
            //         },
            //     ],
                
            // },
            // {
            //     id: 3,
            //     selectedProducts: [
            //         {
            //             'id': 4,
            //             'name': 'Product 4',
            //             'price': '123',
            //         },
            //     ],
            // },
        ];
    },
    methods: {
        selectProductShow(products){
            this.selectedProducts = products
            this.totalPrice = 0,
            products.forEach(item =>{
                this.totalPrice += parseInt(item.price)
            })
        },
        addTab(){
            let lasTab = this.tabs[this.tabs.length - 1]
            let newTab = {
                id: lasTab.id+1,
                selectedProducts:[],
            }
            this.tabs.push(newTab)
        },
        removeSheet(tabId){
            let filtered = this.tabs.filter(function(item) {
                return item.id != tabId
                })
            this.tabs = filtered
            this.$forceUpdate();
        },
    },
}
</script>