<template>
    <div class="item" v-if="productData">
        <router-link  class="product-sm mb-3" :to="{name:'ecommerce.product', params: { productId: productData.id, productSlug: slug }}">
            <div class="img-wrap"> <img :src="productData.feature_img"> </div>
            <div class="text-wrap">
                <p class="title text-truncate">{{ productData.name.en }}</p>
                <div class="price"> <span class="w3-text-red pr-2" v-if="productData.compare_price > 0"><del>&#2547; {{ productData.compare_price }}</del></span> <span class="d-block">&#2547; {{ productData.sale_price }}</span></div> <!-- price-wrap.// -->
            </div>
            </router-link>
    </div>
</template>
<script>
export default {
    props: ['product'],
    data() {
        return {
            productData: null,
            imgUrl: null,
            slug: null,
        }
    },
    created() {
        this.setData()
    },
    methods: {
        setData(){
            this.productData = this.product 
            this.imgUrl = window.location.origin+'/'+this.product.feature_img
            this.slug = this.$options.filters.slug(this.productData.name.en)
        }
    },
}
</script>