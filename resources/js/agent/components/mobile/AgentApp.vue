<template>
    <div>

        <!-- =============== screen-wrap =============== -->
        <div class="screen-wrap">

        <main class="app-content">

        <slot></slot>

        </main>

        <!-- <nav-bottom :activeMenu="navBottomMenuActive"></nav-bottom> -->

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