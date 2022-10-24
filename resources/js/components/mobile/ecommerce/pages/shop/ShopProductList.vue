<template>
    <div>

        <section class="padding-x" id="productItems">
            <div class="row">
                <div class="col-6 col-sm-6 col-md-4" v-for="(product, index) in products" :key="index">
                    <product-item :key="product.id" :product="product"></product-item>
                    <!-- <shop-product-item :productItem="product"></shop-product-item> -->
                </div>
            </div> <!-- row end -->
            <!-- <ul class="pagination table-responsive padding-top" v-if="links.length > 3">
                <li class="page-item" v-for="(page, index) in links" :key="index" :class="{disabled: !page.url, active: page.active}">
                <a class="page-link" v-on:click="getProducts(page.url)" tabindex="-1">
                    <span class="d-flex" v-if="page.label == 'Next &raquo;'">
                        Next <i class="fa fa-arrow-right"></i>
                    </span>
                    <span class="d-flex" v-else-if="page.label == '&laquo; Previous'">
                        <i class="fa fa-arrow-left"></i> Previous
                    </span>
                    <span v-else>
                        {{ page.label }}
                    </span>
                    </a>
                </li>
            </ul> -->
        </section> <!-- section body .// -->
    </div>
</template>
<script>
export default {
    data() {
        return {
            products: [],
            links: [],
            next_page_url : null,
            current_page : 0,
            last_page : 1,
        }
    },
    mounted() {
        this.getMoreProducts()
    },
    created() {
        this.getProducts()
    },
    methods: {
        getProducts(dataUrl = null){
            if (this.current_page < this.last_page) {
                axios.get(dataUrl ? dataUrl : window.location.origin+'/api/products').then(res => {
                    res.data.data.forEach(i =>{
                        this.products.push(i)
                    })
                    this.links = res.data.links
                    this.current_page = res.data.current_page
                    this.last_page = res.data.last_page
                    this.next_page_url = res.data.next_page_url
                })
            }
        },
        getMoreProducts(){
            window.onscroll = () => {
            let bottomOfWindow = document.documentElement.scrollTop + window.innerHeight === document.documentElement.offsetHeight;
            if (bottomOfWindow) {
                this.getProducts(this.next_page_url);
            }
            };
        }
    },
}
</script>