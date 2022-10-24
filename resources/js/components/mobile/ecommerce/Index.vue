<template>
    <div>
        <sidebar-left></sidebar-left>
        <!-- =============== screen-wrap =============== -->
        <div class="screen-wrap">

        <header-top></header-top>

        <main class="app-content">

        <router-view ></router-view>
        </main>

        <nav-bottom :activeMenu="navBottomMenuActive"></nav-bottom>


        </div> 
        <!-- =============== screen-wrap end.// =============== -->


    </div>
</template>

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