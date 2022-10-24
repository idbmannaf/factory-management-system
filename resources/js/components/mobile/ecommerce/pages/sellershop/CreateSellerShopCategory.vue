<template>
    <div>
        <div class="bg-primary padding-x padding-bottom">
            <h3 class="title-page text-white">Create Your Shop</h3>
        </div>

        <section class="padding-around">
            <form action="" class="p-4">
                <div class="form-group">
                    <select class="select2 form-control" name="course_levels[]" id="shopCategory" multiple="multiple" data-placeholder="Select Multiple" style="width: 100%;">  
                        <option value="" >Select Category</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                    </select>
                </div>
                <div class="for m-group">
                </div>
                <router-link class="btn btn-block btn-primary" :to="{name: 'ecommerce.sellershop.create.logo'}">Continue</router-link>
                <!-- <button class="btn btn-block btn-primary">Create</button> -->
            </form>
        </section>
    </div>
</template>
<script>
export default {
    data() {
        return {
            
        }
    },
    created() {
        $(document).ready(function(){
            $('.select2').select2({
                maximumSelectionLength: 3,
                theme: 'bootstrap4',
            });
        });
    },
    mounted() {
    },
}
</script>