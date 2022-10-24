<template>
    <div>
                
        <hr class="divider my-3">

        <h5 class="title-section">Best deals</h5>
        <section class="scroll-horizontal  padding-x">
            <product-item v-for="(product, index) in products" :key="index" :product="product"></product-item>
        </section> 
    </div>
</template>
<script>
export default {
    data() {
        return {
            products:[],
        }
    },
    created() {
        this.getProducts()
    },
    methods: {
        getProducts(){
            axios.get(window.location.origin+`/api/products/best-deals`).then(res=>{
                if (res.status == 200) {
                    this.products = res.data
                }
            })
        }
    },
}
</script>