<template>
    <div>
        <div class="bg-primary padding-x padding-bottom">
            <h3 class="title-page text-white">Create Your Shop</h3>
        </div>

        <section class="padding-around">
            <form action="" class="p-4">
                <div class="form-group">
                    <div class="shopimage rounded-circle">
                    </div>
                    <div class="custom-file">
                    <input type="file" class="custom-file-input" id="file_pasport" accept="" lang="en">
                    <label class="custom-file-label" for="file_pasport">Shop Logo</label>
                    </div>
                </div>
                <div class="for m-group">
                </div>
                <router-link class="btn btn-block btn-primary" :to="{name: 'ecommerce.sellershop.create.success'}">Upload</router-link>
                <!-- <button class="btn btn-block btn-primary">Create</button> -->
            </form>
            
        </section>
    </div>
</template>
<style scoped>
.shopimage{
    height: 200px;
    width: 100%;
    background-color: teal;
}
</style>
<script>
export default {
    data() {
        return {
            
        }
    },
    mounted() {
    },
}
</script>