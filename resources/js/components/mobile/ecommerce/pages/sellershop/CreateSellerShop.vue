<template>
    <div>
        <div class="bg-primary padding-x padding-bottom">
            <h3 class="title-page text-white">Create Your Shop</h3>
        </div>

        <section class="padding-around">
            <form action="" class="p-4">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Shop name">
                </div>
                <router-link class="btn btn-block btn-primary" :to="{name: 'ecommerce.sellershop.create.category'}">Create</router-link>
                <!-- <button class="btn btn-block btn-primary">Create</button> -->
            </form>
        </section>
    </div>
</template>