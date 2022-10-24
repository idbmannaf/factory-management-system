<template>
    <div>
        <dealer-sidebar-left>
            <a href="/dealer"><i class="fa fa-home"></i> Home</a>
            <a href="/dealer/ecommerce"><i class="fa fa-shopping-cart"></i> Ecommerce</a>
        </dealer-sidebar-left>

        <!-- =============== screen-wrap =============== -->
        <div class="screen-wrap">

        <dealer-header-top>
            <h5 class="title-header ml-2">Dealer Dashboard</h5>
            <div class="header-right">  
                <a href="#" class="btn-header"> <i class="fa fa-bell"></i> </a> 
            </div>
        </dealer-header-top>

        <main class="app-content">

            <router-view></router-view>
        
        </main>

        <!-- <nav-bottom :activeMenu="navBottomMenuActive"></nav-bottom> -->


        </div> 
        <!-- =============== screen-wrap end.// =============== -->


    </div>
</template>

<style scoped>
.app-content{
    background-color: #f0f6fb;
    height: 100vh;
}
</style>
<script>
export default {
}
</script>