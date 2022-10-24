<template>
    <div class="card">
    <!-- <div class="row">
        <div class="col">
            #
        </div>
        <div class="col">
            Name
        </div>
        <div>
            Quantity
        </div>
    </div> -->
        <div class="border-bottom" v-for="(product, index) in products" :key="index">
            <ecom-order-selected-product-item :product="product"></ecom-order-selected-product-item>
        </div>
        <div>
            <div class="text-center h5">
                Total Price: &#2547; {{ totalPrice }}
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: [
        'products',
        'totalPrice',

    ],
    data() {
        return {
        }
    },
    created() {
    },
    methods: {

    },
}
</script>
