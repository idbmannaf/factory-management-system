<template>
    <div>
        <div class="row border-bottom">
                <div class="col">
                    <input type="checkbox" id="checkbox"  v-model="checked" v-on:click="selectThisProduct()">
                </div>
                <div class="col">
                    {{ product.id }}
                </div>
                <div class="col">
                    {{ product.name }}
                </div>
                <div class="col">
                    &#2547; {{ product.price }}
                </div>
        </div>
    </div>
</template>
<script>
export default {
    props: [
        'product',
    ],
    data() {
        return {
            checked: false,
        }
    },
    created() {
        
    },
    methods: {
        selectThisProduct(){
            this.checked = !this.checked
            if (this.checked) {
                this.$emit('selectProduct',this.product)
            }else{
                this.$emit('removeProduct',this.product)
            }
        }
    },
}
</script>