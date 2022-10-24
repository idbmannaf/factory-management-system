<template>
    <div class="container">
        <div class="row">
            <agentship-item v-for="(agentship, index) in agentShips" :key="index" :agentship="agentship"></agentship-item>
        </div>
    </div>
</template>
<style scoped>
.dashboard-card{
    padding: 10px;
}
.card-text{
    text-align: center;
    padding: 30px 5px 30px 5px;
}
</style>
<script>
export default {
    data() {
        return {
            agentShips: [],
        }
    },
    created() {
        axios.get(window.location.origin+`/api/agent/agentships/get`).then(res=>{
            this.agentShips = res.data
        })
    },
}
</script>