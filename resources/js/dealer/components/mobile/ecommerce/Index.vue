<template>
    <div>
        <dealer-ecommerce-sidebar-left></dealer-ecommerce-sidebar-left>

        <!-- =============== screen-wrap =============== -->
        <div class="screen-wrap">

        <dealer-ecommerce-header-top></dealer-ecommerce-header-top>

        <main class="app-content">
            <router-view></router-view>
        </main>

        <!-- <nav-bottom :activeMenu="navBottomMenuActive"></nav-bottom> -->

        </div> 
        <!-- =============== screen-wrap end.// =============== -->

    </div>
</template>
<style scoped>
main{
    background-color: #f0f6fb;
    height: 100vh;
}
</style>
<script>
export default {
    data() {
        return {
            navBottomMenuActive: 'home',
        }
    },
    created() {
    },
    methods: {
        navBottomMenuButtonActive(menu){
            this.navBottomMenuActive = menu
        }
    },
}
</script>