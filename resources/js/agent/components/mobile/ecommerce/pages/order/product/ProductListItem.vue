<template>
    <tr>
        <td>
            <input
                type="checkbox"
                id="checkbox"
                v-model="checked"
                v-on:click="selectThisProduct()"
            />
        </td>
        <td>
            {{ product.id }}
        </td>
        <td>
            {{ product.name.en.substring(0, 40) + ".." }}
        </td>
        <td>
            <!--      <img-->
            <!--        class="product-img-thumbnail"-->
            <!--        :src="product.feature_img"-->
            <!--        :alt="product.name.en"-->
            <!--      />-->
            {{ product.unit_value }} {{ product.unit }}
        </td>
        <td>
            <template v-if="product.bonus">
                {{ product.bonus }} for {{ product.pice }}
            </template>
            <template v-else></template>
        </td>

        <!--    <td>{{ product.min_order_quantity }} unit</td>-->
        <td>&#2547; {{ parseFloat(product.sale_price) }}</td>
        <td>
<!--            {{ parseFloat(product.sale_price - shopAmount) }}-->
            {{parseFloat(percentage)}}
        </td>
<!--        <td>{{ parseFloat(percentage) }} %</td>-->
<!--        <td>&#2547; {{shopAmount}}</td>-->
    </tr>
</template>
<style scoped>
.product-img-thumbnail {
    max-width: 60px;
    max-height: 60px;
    margin: auto;
}
</style>
<script>
import eventBus from "./../../../../../../event-bus";

export default {
    props: ["product", "tab", "shop", "agent"],
    data() {
        return {
            checked: false,
            shopAmount: 0,
            percentage: 0,
        };
    },
    mounted() {
        eventBus.$on("removeSelectedItem", (data) => {
            if (this.tab == data.tab && this.product.id == data.productId) {
                this.selectThisProduct();
            }
        });
    },
    created() {
        this.getShopAmount();
    },
    methods: {
        selectThisProduct() {
            this.checked = !this.checked;
            if (this.checked) {
                this.$emit("selectProduct", this.product);
            } else {
                this.$emit("removeProduct", this.product);
            }
        },
        getShopAmount() {
            axios
                .get(
                    window.location.origin +
                    `/api/agent/${this.agent}/ecommerce/shop/${this.shop}/product/${this.product.id}/amount`
                )
                .then((res) => {
                    if (res.status == 200) {
                        this.shopAmount = res.data.data;
                        this.percentage = res.data.commission;
                    }

                });
        },
    },
};
</script>
