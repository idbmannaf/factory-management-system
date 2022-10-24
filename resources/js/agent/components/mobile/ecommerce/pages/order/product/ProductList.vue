<template>
    <div>
        <div class="padding-bottom">
            <input type="text" class="form-control" placeholder="search..." v-model="searchKey" @keyup="searchItem">
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-sm" style="white-space: nowrap">
                <thead>
                <tr>
                    <td>Select</td>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Unit</td>
                    <td>Bonus</td>
                    <!--            <td>Min Qty</td>-->
                    <td>Rate</td>
                    <td>Commission (%)</td>
<!--                    <th>%</th>-->
<!--                    <td>Order Amount</td>-->
                </tr>
                </thead>
                <tbody>
                <ecom-order-create-product-item v-for="(product) in products" :key="product.id" :product="product"
                                                :agent="agent" :shop="shop" v-on:selectProduct="selectProduct($event)"
                                                v-on:removeProduct="removeProduct($event)"
                                                :tab="tab">
                </ecom-order-create-product-item>
                </tbody>

            </table>
        </div>
        <div class="w-50" v-if="!products.length">
            <marquee direction="left">loading...</marquee>
        </div>
        <nav>
            <ul class="pagination table-responsive padding-top" v-if="links.length > 3">
                <li class="page-item" v-for="(page, index) in links" :key="index"
                    :class="{disabled: !page.url, active: page.active}">
                    <a class="page-link" v-on:click="getProducts(page.url)" tabindex="-1">
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
</template>
<script>
import {log} from '../../../../../../../../../public/cp/plugins/pdfmake/pdfmake';
import eventBus from './../../../../../../event-bus'

export default {
    props: ['tab', 'agent', 'shop'],
    computed: {},
    data() {
        return {
            products: [],
            links: [],
            selectedProducts: [],
            searchKey: null,
        }
    },
    mounted() {
        eventBus.$on('loadSaleslistProducts', (data) => {
            if (data.tab == this.tab) {
                if (data.list) {
                    this.loadProductFromList(data.list)
                } else {
                    this.getProducts()
                }
            }
        });
    },
    created() {
        this.getProducts()
    },
    methods: {
        getProducts(dataUrl = null) {
            axios.get(dataUrl ? dataUrl : window.location.origin + `/api/agent/${this.agent}/ecommerce/shop/${this.shop}/products/published`).then(res => {
                if (res.status == 200) {
                    this.products = res.data.data
                    this.links = res.data.links
                }
            });
        },
        selectProduct(product) {
            this.selectedProducts.push(product)
            this.$emit('selectProductShow', this.selectedProducts)
        },
        removeProduct(product) {
            var filtered = this.selectedProducts.filter(function (item) {
                return item.id != product.id
            });
            this.selectedProducts = filtered
            this.$emit('selectProductShow', filtered)
        },
        loadProductFromList(list) {
            axios.get(window.location.origin + `/api/agent/${this.agent}/ecommerce/sales-list/${list}/products/get`).then(res => {
                if (res.status == 200) {
                    this.products = res.data.data
                    this.links = res.data.links
                }
            });
        },
        searchItem() {
            if (!this.searchKey) {
                this.getProducts()
            } else {
                axios.get(window.location.origin + `/api/agent/${this.agent}/ecommerce/shop/${this.shop}/products/list/search?query=${this.searchKey}`).then(res => {
                    if (res.status == 200) {
                        this.products = res.data.data
                        this.links = res.data.links
                    }
                });
            }
        },
    },
}
</script>
