<template>
    <div class="container">
        <div class="row">
            <div class="w-50 dashboard-card  w3-animate-zoom">
                <a class="" :href="'/agent/'+agent+'/ecommerce'">
                <div class="w3-card w3-round-large w3-lime">
                    <div class="body">
                        <div class="h4 card-text text-white">
                            <i class="fa fa-shopping-cart"></i> Ecommerce
                        </div>
                    </div>
                </div>
                </a>
            </div>
            <div class="w-50 dashboard-card  w3-animate-zoom">
                <a class="" :href="'/agent/'+agent+'/ecommerce'">
                <div class="w3-card w3-round-large w3-red">
                    <div class="h4 card-text">
                            <i class="fa fa-shopping-cart"></i> Ecommerce
                    </div>
                </div>
                </a>
            </div>
            <div class="w-50 dashboard-card  w3-animate-zoom">
                <a class="" :href="'/agent/'+agent+'/ecommerce'">
                <div class="w3-card w3-round-large w3-blue">
                    <div class="h4 card-text">
                            <i class="fa fa-shopping-cart"></i> Ecommerce
                    </div>
                </div>
                </a>

            </div>
            <div class="w-50 dashboard-card  w3-animate-zoom">
                <a class="" :href="'/agent/'+agent+'/ecommerce'">
                <div class="w3-card w3-round-large w3-green">
                    <div class="h4 card-text">
                            <i class="fa fa-shopping-cart"></i> Ecommerce
                    </div>
                </div>
                </a>

            </div>
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
    props: ['agent'],
    data() {
        return {
            
        }
    },
    created() {
        // console.log(this.agent)
    },
}
</script>