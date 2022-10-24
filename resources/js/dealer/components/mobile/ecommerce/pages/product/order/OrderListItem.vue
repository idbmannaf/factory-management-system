<template>
    <div class="row">
        <div class="col">
            order row
        </div>
        <div class="col">
            <router-link class="btn-link" :to="{name: 'agent.ecom.incoming.order.manage', params: { order: 1 }}">manage</router-link>
        </div>
    </div>
</template>