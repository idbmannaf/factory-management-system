<template>
    <div class="w-100 dashboard-card  w3-animate-zoom">
        <router-link :to="{name:'agent.projects', params:{'agent': agentship.id}}">
        <div class="padding-around w3-card w3-round-large w3-orange">
            <div class="body">
                <div class="h5 card-text text-center text-white">
                    <i class="fab fa-atlassian"></i>
                    SR ID: {{ agentship.id }} <br>
                    {{ agentship.name.en }}
                </div>
            </div>
        </div>
        </router-link>
    </div>
</template>
<script>
export default {
    props: ['agentship'],
    data() {
        return {

        }
    },
    created() {
    },
}
</script>
