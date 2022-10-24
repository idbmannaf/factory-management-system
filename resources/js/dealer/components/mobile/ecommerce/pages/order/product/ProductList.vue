<template>
    <div>
        <div v-for="(product, index) in products" :key="index">
            <ecom-order-create-product-item :product="product" v-on:selectProduct="selectProduct($event)" v-on:removeProduct="removeProduct($event)"></ecom-order-create-product-item>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            products:[],
            selectedProducts:[],
        }
    },
    created() {
        this.getProducts()
    },
    methods: {
        getProducts(){
            this.products = [
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
            ];
        },
        selectProduct(product){
            this.selectedProducts.push(product)
            this.$emit('selectProductShow',this.selectedProducts)
        },
        removeProduct(product){
            var filtered = this.selectedProducts.filter(function(item) {
                return item.id != product.id
                })
            this.selectedProducts = filtered
            this.$emit('selectProductShow',filtered)
        },
    },
}
</script>