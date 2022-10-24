<template>
  <section class="scroll-horizontal padding-around w3-white">
                <div class="item-sm">
                    <a @click="loadSaleslistProducts()">
                        <div class="img-wrap">
                            <img class="rounded-circle img-sm" alt="">
                        </div>
                        <div class="text-wrap pt-2 text-center">
                            <p class="text-truncate">All</p>
                        </div>
                    </a>
                </div>
                <div class="item-sm" v-for="(item, index) in salesList" :key="index">
                    <a @click="loadSaleslistProducts(item.id)">
                        <div class="img-wrap">
                            <img class="rounded-circle img-sm" :src="item.img_name" alt="">
                        </div>
                        <div class="text-wrap pt-2 text-center">
                            <p class="text-truncate">{{ item.name.en }}</p>
                        </div>
                    </a>
                </div>
        </section>
</template>

<script>
import eventBus from './../../../../../../event-bus'
export default {
    props: ['agent', 'tab'],
    data() {
        return {
            salesList: [],
        }
    },
    created() {
        this.loadSalesList()
    },
    methods: {
        loadSalesList(){
            axios.get(window.location.origin+`/api/agent/${this.agent}/ecommerce/sales-list/get`).then(res=>{
                if (res.status == 200) {
                    this.salesList = res.data
                }
            });
        },
        loadSaleslistProducts(list = null){
            eventBus.$emit('loadSaleslistProducts', {tab: this.tab, list: list})
        }
    },
}
</script>

<style>

</style>
