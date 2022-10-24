<template>
    <div>
        <section class="padding-top">
        <h5 class="title-section padding-x">Orders <router-link class="btn btn-primary p-0 px-2 float-right" :to="{name: 'ecommerce.myOrders'}">view all</router-link></h5>
        <nav class="nav-list">
            <a class="btn-list" href="#">
                <span class="float-right badge badge-warning">3</span>
                <span class="text">On proccess</span>
            </a>
            <a class="btn-list" href="#">
                <span class="float-right badge badge-success">1</span>
                <span class="text">Shipped</span>
            </a>
            <a class="btn-list" href="#"> 
                <span class="float-right badge badge-secondary">0</span>
                <small class="title"></small>
                <span class="text">Unpaid</span>
            </a>
        </nav>
        </section>
    </div>
</template>