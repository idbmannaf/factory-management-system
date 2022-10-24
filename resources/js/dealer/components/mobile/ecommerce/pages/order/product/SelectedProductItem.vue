<template>
    <div class="row">
        <div class="col">
            {{ product.id }}
        </div>
        <div class="col">
            &#2547; {{ product.price }}
        </div>
        <div class="col float-right d-flex justify-content-between">
            <input class="w-50 my-1 form-control-" min="1" type="number" v-model="quantity">
            <button class="btn btn-danger btn-xs py-0 px-1"><i class="fa fa-trash"></i></button>
        </div>
    </div>
</template>
<script>
export default {
    props: [
        'product'
    ],
    data() {
        return {
            quantity: 1,
        }
    },
}
</script>
