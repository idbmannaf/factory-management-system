<template>
    <div>
        <section class="padding-top">
        <h5 class="title-section padding-x">My Shop </h5>
        <nav class="nav-list">
            <router-link class="btn-list text-center" :to="{name: 'ecommerce.sellershop.create'}">
                <span class="text  btn-primary rounded p-2">Create new Shop</span>
            </router-link>
        </nav>
        </section>
        <section class="padding-around">
        <nav class="row">
            <div class="col-6 col-sm-4">
                <a href="#" class="btn-img overlay-gradient" style="background-image: url(../images/posts/1.jpg);">
                    <span  class="text">Shop 1</span>
                </a>
            </div>
            <div class="col-6 col-sm-4">
                <a href="#" class="btn-img overlay-gradient" style="background-image: url(../images/posts/2.jpg);">
                    <span class="text">Shop 2</span>
                </a>
            </div>
            <div class="col-6 col-sm-4">
                <a href="#" class="btn-img overlay-gradient" style="background-image: url(../images/posts/3.jpg);">
                    <span class="text">Shop 3</span>
                </a>
            </div>
            <div class="col-6 col-sm-4">
                <a href="#" class="btn-img overlay-gradient" style="background-image: url(../images/posts/4.jpg);">
                    <span class="text">Shop 4</span>
                </a>
            </div>
        </nav>
        </section> 

    </div>
</template>