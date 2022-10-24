<template>
    <div class="row">
        <div class="col">
            {{ order.name }}
        </div>
        <div class="col">
            {{ order.price }}
        </div>
        <div class="col">
            <router-link class="btn-link" :to="{ name: 'agent.ecom.order.details', params:{order: order.price}}">Details</router-link>
        </div>
    </div>
</template>
<script>
export default {
    props: [
        'order'
    ],
    data() {
        return {
        }
    },
}
</script>